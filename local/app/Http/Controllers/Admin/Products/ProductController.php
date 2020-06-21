<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Shop\Attributes\Repositories\AttributeRepositoryInterface;
use App\Shop\AttributeValues\Repositories\AttributeValueRepositoryInterface;
use App\Shop\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Shop\ProductAttributes\ProductAttribute;
use App\Shop\Products\Product;
use App\Shop\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Shop\Products\Repositories\ProductRepository;
use App\Shop\Products\Requests\CreateProductRequest;
use App\Shop\Products\Requests\UpdateProductRequest;
use App\Shop\Products\Size;
use App\Shop\Products\Transformations\ProductTransformable;
use App\Shop\Tools\UploadableTrait;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use ProductTransformable, UploadableTrait;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepo;

    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepo;

    /**
     * @var AttributeRepositoryInterface
     */
    private $attributeRepo;

    /**
     * @var AttributeValueRepositoryInterface
     */
    private $attributeValueRepository;

    private $productAttribute;

    /**
     * ProductController constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @param AttributeRepositoryInterface $attributeRepository
     * @param AttributeValueRepositoryInterface $attributeValueRepository
     * @param ProductAttribute $productAttribute
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        AttributeRepositoryInterface $attributeRepository,
        AttributeValueRepositoryInterface $attributeValueRepository,
        ProductAttribute $productAttribute
    ) {
        $this->productRepo = $productRepository;
        $this->categoryRepo = $categoryRepository;
        $this->attributeRepo = $attributeRepository;
        $this->attributeValueRepository = $attributeValueRepository;
        $this->productAttribute = $productAttribute;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (request()->has('q') && request()->input('q') != '') {
            $list =  Product::where('sku', 'like', '%' .request()->input('q'). '%')->get();
        }else{
            $list = $this->productRepo->listProducts('id');
        }

        $products = $list->map(function (Product $item) {
            return $this->transformProduct($item);
        })->all();
        
        return view('admin.products.list', [
            'products' => $this->productRepo->paginateArrayResults($products, 20),
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create', [
            'categories' => $this->categoryRepo->listCategories('name', 'asc')->where('parent_id', 1),
            'selectedIds' => [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        if ($request["type"] != null) {
            $request["type"] = 'off';
        }

        $data = $request->except('_token', '_method');
        $data['slug'] = $request->input('slug');
        $data['construction'] = $request->input('construction');
        $data['sole'] = $request->input('sole');
        $data['color'] = $request->input('color');

        if ($request->hasFile('cover') && $request->file('cover') instanceof UploadedFile) {
            $data['cover'] = $this->productRepo->saveCoverImage($request->file('cover'));
        }

        $product = $this->productRepo->createProduct($data);
        $this->saveProductImages($request, $product);
        for ($i = 1; $i <= 15; $i++) {
            if ($request["size" . $i] == null) {
                $request["size" . $i] = 0;
            }
            $size = new Size([
                'product_id' => $product->id,
                'size' => "size" . $i,
                'value' => $request["size" . $i],
            ]);
            $product->sizes()->save($size);

        }

        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        } else {
            $product->categories()->detach();
        }

        $request->session()->flash('message', 'Create successful');
        return redirect()->route('admin.products.edit', $product->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return view('admin.products.show', ['product' => $this->productRepo->findProductById($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $product = $this->productRepo->findProductById($id);
        $productAttributes = $product->attributes()->get();
        $qty = $productAttributes->map(function ($item) {return $item->quantity;})->sum();

        if (request()->has('delete') && request()->has('pa')) {
            $pa = $productAttributes->where('id', request()->input('pa'))->first();
            $pa->attributesValues()->detach();
            $pa->delete();

            request()->session()->flash('message', 'Delete successful');
            return redirect()->route('admin.products.edit', [$product->id, 'combination' => 1]);
        }

        return view('admin.products.edit', [
            'product' => $product,
            'images' => $product->images()->get(['src']),
            'categories' => $this->categoryRepo->listCategories('name', 'asc')->where('parent_id', 1),
            'selectedIds' => $product->categories()->pluck('category_id')->all(),
            'attributes' => $this->attributeRepo->listAttributes(),
            'productAttributes' => $productAttributes,
            'qty' => $qty,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProductRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, int $id)
    {
        if ($request["type"] != null) {
            $request["type"] = 'off';
        }
        $product = $this->productRepo->findProductById($id);

        if ($request->has('productAttributeQuantity')) {
            $this->saveProductCombinations(
                $product,
                $request->input('productAttributeQuantity'),
                $request->input('productAttributePrice'),
                $request->input('attributeValue')
            );
        }

        $data = $request->except('categories', '_token', '_method');
        $data['slug'] = $request->input('slug');
        $data['construction'] = $request->input('construction');
        $data['sole'] = $request->input('sole');
        $data['color'] = $request->input('color');

        if ($request->hasFile('cover') && $request->file('cover') instanceof UploadedFile) {

            $data['cover'] = $this->productRepo->saveCoverImage($request->file('cover'));
        }
        $this->productRepo->updateProduct($data, $id);

        $this->saveProductImages($request, $product);

        for ($i = 1; $i <= 15; $i++) {
            if ($request["size" . $i] == null) {
                $request["size" . $i] = 0;
            }
            $size = Size::where('product_id', $product->id)->where('size', "size" . $i);
            $size->update(["value" => $request["size" . $i]]);
        }

        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        } else {
            $product->categories()->detach();
        }

        $request->session()->flash('message', 'Update successful');

        $route = [$id];
        if ($request->has('combination')) {
            $route['combination'] = 1;
        }

        return redirect()->route('admin.products.edit', $route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->productRepo->findProductById($id);
        $product->categories()->sync([]);

        $this->productRepo->delete($id);

        request()->session()->flash('message', 'Delete successful');
        return redirect()->route('admin.products.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeImage(Request $request)
    {
        $this->productRepo->deleteFile($request->only('product', 'image'), 'uploads');
        request()->session()->flash('message', 'Image delete successful');
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeThumbnail(Request $request)
    {
        $this->productRepo->deleteThumb($request->input('src'));
        request()->session()->flash('message', 'Image delete successful');
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param Product $product
     */
    private function saveProductImages(Request $request, Product $product)
    {
        if ($request->hasFile('image')) {
            $this->productRepo->saveProductImages(collect($request->file('image')), $product);
        }
    }

    /**
     * @param Product $product
     * @param int $quantity
     * @param $price
     * @param array $attributeValues
     */
    private function saveProductCombinations(Product $product, int $quantity, $price, array $attributeValues)
    {
        $productAttribute = new ProductAttribute(compact('quantity', 'price'));

        $productRepo = new ProductRepository($product);
        $created = $productRepo->saveProductAttributes($productAttribute);

        // save the combinations
        collect($attributeValues)->each(function ($attributeId) use ($productRepo, $created) {
            $productRepo->saveCombination($created, $this->attributeValueRepository->find($attributeId));
        });
    }
    public function reset(UpdateProductRequest $request, int $id)
    {
        if ($request["type"] != null) {
            $request["type"] = 'off';
        }
        $product = $this->productRepo->findProductById($id);

        $data = $request->except('categories', '_token', '_method');
        $data['slug'] = str_slug($request->input('name'));

        $this->productRepo->updateProduct($data, $id);

        for ($i = 1; $i <= 15; $i++) {
            $request["size" . $i] = 0;

        }

        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        } else {
            $product->categories()->detach();
        }

        $request->session()->flash('message', 'Update successful');

        $route = [$id];
        if ($request->has('combination')) {
            $route['combination'] = 1;
        }

        return redirect()->route('admin.products.edit', $route);
    }

    /**
     * Generate order invoice
     *
     * @param int $id
     * @return mixed
     */
    public function FbMarketFile()
    {
        $products = Product::where("status", 1)->get();
        echo "<table border='1'>";
        
        foreach($products as $product){
            echo "<tr><td>".$product->id."*</td><td>".$product->name."*</td><td>".strip_tags($product->description)."*</td><td>available for order*</td><td>new*</td><td>".$product->price." MAD*</td><td>https://www.benson-shoes.com/".$product->slug."*</td><td>https://www.benson-shoes.com/storage/".$product->cover."*</td><td>Benson shoes"."*</td><td> *</td><td> *</td><td>".$product->color."*</td><td>male*</td><td>".$product->sku."*</td><td>";
                
            if(isset($product->categories[1]))
                echo $product->categories[1]->name."*</td><td>";
                
            echo "Construction : ".$product->construction.", Semelle : ".$product->sole."*</td></tr>";
                
        }   
        echo "</table>";
    }
}
