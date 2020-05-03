<?php

namespace App\Http\Controllers\Front;

use App\Shop\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Shop\Products\Transformations\ProductTransformable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    use ProductTransformable;

    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepo;

    /**
     * HomeController constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }
      
    public function currency(Request $request)
    {
        if($request->has('currency')){
            if( $request->input('currency') == "USD" || $request->input('currency') == "MAD"  || $request->input('currency') == "EUR"){
                Session::put('currency',$request->input('currency'));
                return Session::get('currency');
              }
        }
       
    }

    public function isMobileDevice() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        
        $currency = "MAD";
        $currency_diff = 1;
        if(Session::get('currency') == "USD" || Session::get('currency') == "EUR"){
            $currency_diff = file_get_contents('http://free.currencyconverterapi.com/api/v5/convert?q=MAD_'. Session::get('currency') .'&compact=y');
            $currency_diff = explode("}",explode(":",$currency_diff)[2])[0];
             $currency = Session::get('currency');
        }else{
            Session::get('currency',"MAD");
        }
       
        
        $category3 = $this->categoryRepo->findCategoryById(34);
        
        $accessories = $this->categoryRepo->findCategoryById(12);
        
        $features = $category3->products;

        $isMobile = $this->isMobileDevice();    

        return view('front.index', compact('features', 'category3','accessories', 'currency_diff' , 'currency','isMobile'));
    }

    public function terms()
    {
        return view('layouts.front.terms');
    }

    public function test()
    {
        return view('layouts.front.test');
    }
}
