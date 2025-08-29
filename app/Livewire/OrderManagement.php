<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderManagement extends Component
{
    use WithPagination, WithFileUploads;

    public $showModal = false;
    public $showViewModal = false;
    public $viewingOrder = null;
    public $editingOrder = null;
    public $showDeliveryModal = false;
    public $deliveryOrder = null;
    public $deliveryStatus = '';
    public $deliveryNotes = '';
    public $actualDeliveryDate = '';
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $statusFilter = '';
    public $perPage = 10;
    public $currentStep = 1; // Track current step in multi-step modal
    public $selectedOrders = [];
    public $selectAll = false;
    
    // KPI data
    public $totalOrders = 0;
    public $totalRevenue = 0;
    public $pendingDeliveries = 0;
    public $weeklyOrders = 0;
    public $urgentOrders = 0;
    public $deliveryRate = 0;

    // Order form fields
    public $code = '';
    public $firm = '';
    public $ville = '';
    public $telephone = '';
    public $livraison = '';
    public $transporteur = '';
    public $boite = '';
    public $logo;
    public $logo1;
    public $notes = '';
    public $transort = '';

    // Product selection fields
    public $selectedArticle = '';
    public $selectedForme = '';
    public $selectedSemelle = '';
    public $selectedCuir = '';
    public $selectedSupplement = '';
    public $selectedDoublure = '';
    public $selectedConstruction = '';
    public $productPrice = 0;
    public $sizesQuantity = [];

    // Order line fields
    public $orderLines = [];
    public $currentLine = [
        'article' => '',
        'forme' => '',
        'client' => '',
        'semelle' => '',
        'construction' => '',
        'cuir' => '',
        'doublure' => '',
        'supplement' => '',
        'p5' => 0, 'p5x' => 0, 'p6' => 0, 'p6x' => 0,
        'p7' => 0, 'p7x' => 0, 'p8' => 0, 'p8x' => 0,
        'p9' => 0, 'p9x' => 0, 'p10' => 0, 'p10x' => 0,
        'p11' => 0, 'p11x' => 0, 'p12' => 0, 'p13' => 0,
        'prix' => 0,
        'devise' => 'EUR',
        'genre' => 'homme',
        'langue' => 'français',
        'talon' => '',
        'finition' => '',
        'lacet' => '',
        'lacetx' => 0,
        'perforation' => false,
        'fleur' => false,
        'dentlage' => false
    ];
    
    // Additional form fields
    public $currentGenre = 'homme';
    public $currentTalon = '';
    public $currentFinition = '';
    public $currentLacet = '';
    public $currentLacetLength = '';
    public $currentPerforation = '';
    public $currentTrepointe = '';
    public $currentFleur = false;
    public $currentDentlage = false;
    
    // Custom "autre" values
    public $customTalon = '';
    public $customFinition = '';
    public $customLacet = '';
    public $customLacetLength = '';
    public $customTrepointe = '';
    
    // Order line editing
    public $editingLineIndex = null;
    public $showLineEditModal = false;
    
    // Hardcoded options - matching legacy form exactly
    public $talonOptions = ['Synderme', 'Cuir', 'autre', 'vide'];
    public $finitionOptions = ['Antique', 'Brut', 'Fumé', 'Patiné', 'Standard', 'autre'];
    public $lacetOptions = ['Plat Marron', 'Plat Noir', 'Plat Bleu', 'Rond Marron', 'Rond Noir', 'Rond Bleu', 'autre', 'Sans'];
    public $lacetLengthOptions = ['75', '85', '115', 'autre', 'Sans'];
    public $perforationOptions = ['Sans', 'Avec perforation'];
    public $trepointeOptions = ['Plat marron', 'Plat naturelle', 'Stormwelt marron', 'Stormwelt naturelle', 'autre', 'vide'];

    // Item collections for dropdowns
    public $articles = [];
    public $formes = [];
    public $semelles = [];
    public $cuirs = [];
    public $doublures = [];
    public $constructions = [];

    protected $rules = [
        'code' => 'required|string|max:100',
        'firm' => 'nullable|string|max:100',
        'ville' => 'nullable|string|max:100',
        'telephone' => 'nullable|string|max:20',
        'livraison' => 'required|date',
    ];

    public function mount()
    {
        $this->livraison = now()->addDays(30)->format('Y-m-d');
        $this->calculateKPIs();
        $this->loadItemCollections();
    }

    private function loadItemCollections()
    {
        $this->articles = Item::where('type', 'article')->get();
        $this->formes = Item::where('type', 'forme')->get();
        $this->semelles = Item::where('type', 'semelle')->get();
        $this->cuirs = Item::where('type', 'cuir')->get();
        $this->doublures = Item::where('type', 'doublure')->get();
        $this->constructions = Item::where('type', 'construction')->get();
    }

    private function getItemNameById($id, $type)
    {
        if (empty($id)) return '';
        
        $item = Item::where('type', $type)->where('id', $id)->first();
        return $item ? $item->nom : $id; // Return original value if not found
    }
    
    public function getSizeMapping()
    {
        // Returns size mappings based on gender
        if ($this->currentGenre === 'femme') {
            return [
                '36' => ['eu' => '36', 'us' => '5.5', 'fr' => '37'],
                '36.5' => ['eu' => '36.5', 'us' => '6', 'fr' => '37.5'],
                '37' => ['eu' => '37', 'us' => '6.5', 'fr' => '38'],
                '37.5' => ['eu' => '37.5', 'us' => '7', 'fr' => '38.5'],
                '38' => ['eu' => '38', 'us' => '7.5', 'fr' => '39'],
                '38.5' => ['eu' => '38.5', 'us' => '8', 'fr' => '39.5'],
                '39' => ['eu' => '39', 'us' => '8.5', 'fr' => '40'],
                '39.5' => ['eu' => '39.5', 'us' => '9', 'fr' => '40.5'],
                '40' => ['eu' => '40', 'us' => '9.5', 'fr' => '41'],
                '40.5' => ['eu' => '40.5', 'us' => '10', 'fr' => '41.5'],
                '41' => ['eu' => '41', 'us' => '10.5', 'fr' => '42'],
                '41.5' => ['eu' => '41.5', 'us' => '11', 'fr' => '42.5'],
                '42' => ['eu' => '42', 'us' => '11.5', 'fr' => '43'],
            ];
        } else {
            // Men's sizes - full range with new database columns
            return [
                '39' => ['eu' => '39', 'us' => '6', 'fr' => '40'],
                '39.5' => ['eu' => '39.5', 'us' => '6.5', 'fr' => '40.5'],
                '40' => ['eu' => '40', 'us' => '7', 'fr' => '41'],
                '40.5' => ['eu' => '40.5', 'us' => '7.5', 'fr' => '41.5'],
                '41' => ['eu' => '41', 'us' => '8', 'fr' => '42'],
                '41.5' => ['eu' => '41.5', 'us' => '8.5', 'fr' => '42.5'],
                '42' => ['eu' => '42', 'us' => '9', 'fr' => '43'],
                '42.5' => ['eu' => '42.5', 'us' => '9.5', 'fr' => '43.5'],
                '43' => ['eu' => '43', 'us' => '10', 'fr' => '44'],
                '43.5' => ['eu' => '43.5', 'us' => '10.5', 'fr' => '44.5'],
                '44' => ['eu' => '44', 'us' => '11', 'fr' => '45'],
                '44.5' => ['eu' => '44.5', 'us' => '11.5', 'fr' => '45.5'],
                '45' => ['eu' => '45', 'us' => '12', 'fr' => '46'],
                '45.5' => ['eu' => '45.5', 'us' => '12.5', 'fr' => '46.5'],
                '46' => ['eu' => '46', 'us' => '13', 'fr' => '47'],
                '47' => ['eu' => '47', 'us' => '14', 'fr' => '48'],
            ];
        }
    }
    
    public function mapSizeToDb($euSize)
    {
        // Maps EU size to database column name
        // Database now has: p5, p5x, p6, p6x, p7, p7x, p8, p8x, p9, p9x, p10, p10x, p11, p11x, p12, p12x, p13, p13x, p14, p14x, p15, p16, p17
        $sizeMap = [
            '36' => 'p5', '36.5' => 'p5x',
            '37' => 'p6', '37.5' => 'p6x', 
            '38' => 'p7', '38.5' => 'p7x',
            '39' => 'p8', '39.5' => 'p8x',
            '40' => 'p9', '40.5' => 'p9x',
            '41' => 'p10', '41.5' => 'p10x',
            '42' => 'p11', '42.5' => 'p11x',
            '43' => 'p12', '43.5' => 'p12x',
            '44' => 'p13', '44.5' => 'p13x',
            '45' => 'p14', '45.5' => 'p14x',
            '46' => 'p15',
            '47' => 'p16'
        ];
        
        return $sizeMap[$euSize] ?? null;
    }

    private function calculateKPIs()
    {
        $this->totalOrders = Order::count();
        $this->totalRevenue = Order::sum('total_amount') ?: 0;
        $this->pendingDeliveries = Order::whereIn('status', ['confirmed', 'in_production'])
            ->where('livraison', '>=', now())
            ->count();
        
        $this->weeklyOrders = Order::whereBetween('created_at', [
            now()->subDays(30),
            now()
        ])->count();
        
        $this->urgentOrders = Order::where('is_urgent', true)
            ->whereIn('status', ['draft', 'confirmed', 'in_production'])
            ->count();
        
        $deliveredCount = Order::where('status', 'delivered')->count();
        $this->deliveryRate = $this->totalOrders > 0 
            ? round(($deliveredCount / $this->totalOrders) * 100, 1) 
            : 0;
    }

    public function render()
    {
        $query = Order::with('orderLines');
        
        // Search
        if ($this->search) {
            $query->where(function($q) {
                $q->where('code', 'like', '%' . $this->search . '%')
                  ->orWhere('firm', 'like', '%' . $this->search . '%')
                  ->orWhere('ville', 'like', '%' . $this->search . '%');
            });
        }
        
        // Status filter
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }
        
        // Sorting
        $query->orderBy($this->sortField, $this->sortDirection);
        
        $orders = $query->paginate($this->perPage);

        return view('livewire.order-management', [
            'orders' => $orders,
            'cuirs' => Item::where('type', 'cuir')->get(),
            'semelles' => Item::where('type', 'semelle')->get(),
            'constructions' => Item::where('type', 'construction')->get(),
            'supplements' => Item::where('type', 'supplement')->get(),
            'doublures' => Item::where('type', 'doublure')->get(),
        ])->layout('layouts.app');
    }

    public function createOrder()
    {
        $this->resetOrderForm();
        $this->loadItemCollections();
        $this->currentStep = 1;
        $this->showModal = true;
    }

    public function editOrder($orderId)
    {
        $this->editingOrder = Order::with('orderLines')->find($orderId);
        if ($this->editingOrder) {
            $this->code = $this->editingOrder->code;
            $this->firm = $this->editingOrder->firm;
            $this->ville = $this->editingOrder->ville;
            $this->telephone = $this->editingOrder->telephone;
            $this->livraison = $this->editingOrder->livraison ? $this->editingOrder->livraison->format('Y-m-d') : '';
            $this->notes = $this->editingOrder->notes;
            $this->logo = $this->editingOrder->logo;
            $this->logo1 = $this->editingOrder->logo1;
            $this->loadItemCollections();
            
            // Load existing order lines
            $this->orderLines = [];
            foreach ($this->editingOrder->orderLines as $line) {
                // Calculate total quantity from all size columns
                $totalQuantity = $line->p5 + $line->p5x + $line->p6 + $line->p6x +
                                $line->p7 + $line->p7x + $line->p8 + $line->p8x +
                                $line->p9 + $line->p9x + $line->p10 + $line->p10x +
                                $line->p11 + $line->p11x + $line->p12 + $line->p13;
                
                $totalAmount = $line->prix * $totalQuantity;
                
                $this->orderLines[] = [
                    'article' => $line->article,
                    'forme' => $line->forme,
                    'semelle' => $line->semelle,
                    'cuir' => $line->cuir,
                    'doublure' => $line->doublure,
                    'construction' => $line->construction,
                    'talon' => $line->talon,
                    'finition' => $line->finition,
                    'lacet' => $line->lacet,
                    'perforation' => $line->perforation,
                    'trepointe' => $line->trepointe,
                    'fleur' => $line->fleur,
                    'genre' => $line->genre,
                    'price' => $line->prix,
                    'p5' => $line->p5,
                    'p5x' => $line->p5x,
                    'p6' => $line->p6,
                    'p6x' => $line->p6x,
                    'p7' => $line->p7,
                    'p7x' => $line->p7x,
                    'p8' => $line->p8,
                    'p8x' => $line->p8x,
                    'p9' => $line->p9,
                    'p9x' => $line->p9x,
                    'p10' => $line->p10,
                    'p10x' => $line->p10x,
                    'p11' => $line->p11,
                    'p11x' => $line->p11x,
                    'p12' => $line->p12,
                    'p13' => $line->p13,
                    'total_quantity' => $totalQuantity,
                    'total_amount' => $totalAmount,
                    // Store original line ID for reference
                    'line_id' => $line->id,
                ];
            }
            
            $this->currentStep = 1;
            $this->showModal = true;
        }
    }
    
    public function nextStep()
    {
        // Validate current step before proceeding
        if ($this->currentStep === 1) {
            $this->validate([
                'code' => 'required|string|max:255',
                'firm' => 'nullable|string|max:255',
                'ville' => 'nullable|string|max:255',
                'telephone' => 'nullable|string|max:255',
                'livraison' => 'required|date',
            ]);
        }
        
        $this->currentStep++;
    }
    
    public function previousStep()
    {
        $this->currentStep--;
    }
    
    public function addOrderLine()
    {
        // Validate required fields
        $this->validate([
            'selectedArticle' => 'required',
            'productPrice' => 'required|numeric|min:0',
        ]);
        
        // Calculate total quantity from currentLine sizes
        $totalQuantity = $this->currentLine['p5'] + $this->currentLine['p5x'] + 
                        $this->currentLine['p6'] + $this->currentLine['p6x'] +
                        $this->currentLine['p7'] + $this->currentLine['p7x'] +
                        $this->currentLine['p8'] + $this->currentLine['p8x'] +
                        $this->currentLine['p9'] + $this->currentLine['p9x'] +
                        $this->currentLine['p10'] + $this->currentLine['p10x'] +
                        $this->currentLine['p11'] + $this->currentLine['p11x'] +
                        $this->currentLine['p12'] + $this->currentLine['p13'];
        
        if ($totalQuantity == 0) {
            session()->flash('error', 'Veuillez sélectionner au moins une taille');
            return;
        }
        
        $this->orderLines[] = [
            'article' => $this->selectedArticle,
            'forme' => $this->selectedForme,
            'semelle' => $this->selectedSemelle,
            'cuir' => $this->selectedCuir,
            'supplement' => $this->selectedSupplement,
            'doublure' => $this->selectedDoublure,
            'construction' => $this->selectedConstruction,
            'talon' => $this->currentTalon === 'autre' ? $this->customTalon : $this->currentTalon,
            'finition' => $this->currentFinition === 'autre' ? $this->customFinition : $this->currentFinition,
            'lacet' => $this->currentLacet === 'autre' ? $this->customLacet : $this->currentLacet,
            'lacetx' => $this->currentLacetLength === 'autre' ? $this->customLacetLength : $this->currentLacetLength,
            'perforation' => $this->currentPerforation,
            'trepointe' => $this->currentTrepointe === 'autre' ? $this->customTrepointe : $this->currentTrepointe,
            'fleur' => $this->currentFleur,
            'dentlage' => $this->currentDentlage,
            'genre' => $this->currentGenre,
            'price' => $this->productPrice,
            'p5' => $this->currentLine['p5'],
            'p5x' => $this->currentLine['p5x'],
            'p6' => $this->currentLine['p6'],
            'p6x' => $this->currentLine['p6x'],
            'p7' => $this->currentLine['p7'],
            'p7x' => $this->currentLine['p7x'],
            'p8' => $this->currentLine['p8'],
            'p8x' => $this->currentLine['p8x'],
            'p9' => $this->currentLine['p9'],
            'p9x' => $this->currentLine['p9x'],
            'p10' => $this->currentLine['p10'],
            'p10x' => $this->currentLine['p10x'],
            'p11' => $this->currentLine['p11'],
            'p11x' => $this->currentLine['p11x'],
            'p12' => $this->currentLine['p12'],
            'p13' => $this->currentLine['p13'],
            'total_quantity' => $totalQuantity,
            'total_amount' => $totalQuantity * $this->productPrice,
        ];
        
        // Reset product selection
        $this->resetProductSelection();
        
        session()->flash('success', 'Article ajouté avec succès');
    }
    
    public function removeOrderLine($index)
    {
        $this->currentFleur = false;
        $this->productPrice = 0;
        $this->currentLine = [
            'article' => '',
            'forme' => '',
            'client' => '',
            'semelle' => '',
            'construction' => '',
            'cuir' => '',
            'doublure' => '',
            'supplement' => '',
            'p5' => 0, 'p5x' => 0, 'p6' => 0, 'p6x' => 0,
            'p7' => 0, 'p7x' => 0, 'p8' => 0, 'p8x' => 0,
            'p9' => 0, 'p9x' => 0, 'p10' => 0, 'p10x' => 0,
            'p11' => 0, 'p11x' => 0, 'p12' => 0, 'p13' => 0,
            'prix' => 0,
            'devise' => 'EUR',
            'genre' => $this->currentGenre,
            'langue' => 'français',
            'talon' => '',
            'finition' => '',
            'lacet' => '',
            'lacetx' => 0,
            'perforation' => '',
            'fleur' => false
        ];
    }

    public function saveOrder()
    {
        $this->validate();

        // Handle logo uploads
        $logoPath = null;
        if ($this->logo && !is_string($this->logo)) {
            $logoPath = $this->logo->store('logos', 'public');
        } elseif ($this->editingOrder && !$this->logo) {
            // Keep existing logo if no new upload
            $logoPath = $this->editingOrder->logo;
        } elseif (is_string($this->logo)) {
            // Keep existing logo path if it's a string
            $logoPath = $this->logo;
        }

        $logo1Path = null;
        if ($this->logo1 && !is_string($this->logo1)) {
            $logo1Path = $this->logo1->store('logos', 'public');
        } elseif ($this->editingOrder && !$this->logo1) {
            // Keep existing logo1 if no new upload
            $logo1Path = $this->editingOrder->logo1;
        } elseif (is_string($this->logo1)) {
            // Keep existing logo1 path if it's a string
            $logo1Path = $this->logo1;
        }

        $orderData = [
            'code' => $this->code,
            'firm' => $this->firm,
            'ville' => $this->ville,
            'telephone' => $this->telephone,
            'livraison' => $this->livraison,
            'logo' => $logoPath,
            'logo1' => $logo1Path,
            'notes' => $this->notes,
            'status' => 'draft',
            'total_quantity' => array_sum(array_column($this->orderLines, 'total_quantity')),
            'total_amount' => array_sum(array_column($this->orderLines, 'total_amount')),
        ];

        if ($this->editingOrder) {
            $this->editingOrder->update($orderData);
            $order = $this->editingOrder;
            // Delete existing lines when editing
            $order->orderLines()->delete();
        } else {
            $order = Order::create($orderData);
        }

        // Save order lines
        foreach ($this->orderLines as $line) {
            $order->orderLines()->create([
                'article' => $line['article'],
                'forme' => !empty($line['forme']) ? $line['forme'] : null,
                'semelle' => !empty($line['semelle']) ? $line['semelle'] : null,
                'cuir' => !empty($line['cuir']) ? $line['cuir'] : null,
                'doublure' => !empty($line['doublure']) ? $line['doublure'] : null,
                'supplement' => !empty($line['supplement']) ? $line['supplement'] : null,
                'construction' => !empty($line['construction']) ? $line['construction'] : null,
                'talon' => !empty($line['talon']) ? $line['talon'] : null,
                'finition' => !empty($line['finition']) ? $line['finition'] : null,
                'lacet' => !empty($line['lacet']) ? $line['lacet'] : null,
                'perforation' => !empty($line['perforation']) ? $line['perforation'] : null,
                'trepointe' => !empty($line['trepointe']) ? $line['trepointe'] : null,
                'fleur' => $line['fleur'] ?? false,
                'genre' => $line['genre'] ?? 'homme',
                'prix' => $line['price'],
                // Store size quantities directly in their columns
                'p5' => $line['p5'] ?? 0,
                'p5x' => $line['p5x'] ?? 0,
                'p6' => $line['p6'] ?? 0,
                'p6x' => $line['p6x'] ?? 0,
                'p7' => $line['p7'] ?? 0,
                'p7x' => $line['p7x'] ?? 0,
                'p8' => $line['p8'] ?? 0,
                'p8x' => $line['p8x'] ?? 0,
                'p9' => $line['p9'] ?? 0,
                'p9x' => $line['p9x'] ?? 0,
                'p10' => $line['p10'] ?? 0,
                'p10x' => $line['p10x'] ?? 0,
                'p11' => $line['p11'] ?? 0,
                'p11x' => $line['p11x'] ?? 0,
                'p12' => $line['p12'] ?? 0,
                'p13' => $line['p13'] ?? 0,
            ]);
        }

        $this->closeModal();
        $this->calculateKPIs();
        session()->flash('message', 'Commande sauvegardée avec succès!');
    }

    public function deleteOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->orderLines()->delete();
        $order->delete();
        $this->calculateKPIs();
        session()->flash('message', 'Commande supprimée avec succès!');
    }

    public function resetOrderForm()
    {
        $this->code = '';
        $this->firm = '';
        $this->ville = '';
        $this->telephone = '';
        $this->livraison = '';
        $this->notes = '';
        $this->editingOrder = null;
        $this->currentStep = 1;
        $this->orderLines = [];
        $this->resetProductSelection();
    }

    public function removeLogo()
    {
        $this->logo = null;
    }

    public function removeLogo1()
    {
        $this->logo1 = null;
    }

    public function editOrderLine($index)
    {
        $this->editingLineIndex = $index;
        $line = $this->orderLines[$index];
        
        // Load item collections first
        $this->loadItemCollections();
        
        // Convert IDs back to names for dropdowns
        $this->selectedArticle = $line['article'];
        $this->selectedForme = $this->getItemNameById($line['forme'], 'forme');
        $this->selectedSemelle = $this->getItemNameById($line['semelle'], 'semelle');
        $this->selectedCuir = $this->getItemNameById($line['cuir'], 'cuir');
        $this->selectedDoublure = $this->getItemNameById($line['doublure'], 'doublure');
        $this->selectedConstruction = $this->getItemNameById($line['construction'], 'construction');
        // Handle 'autre' values - check if stored value is a custom one
        $this->currentTalon = $this->isCustomValue($line['talon'] ?? '', $this->talonOptions) ? 'autre' : ($line['talon'] ?? '');
        $this->customTalon = $this->isCustomValue($line['talon'] ?? '', $this->talonOptions) ? ($line['talon'] ?? '') : '';
        
        $this->currentFinition = $this->isCustomValue($line['finition'] ?? '', $this->finitionOptions) ? 'autre' : ($line['finition'] ?? '');
        $this->customFinition = $this->isCustomValue($line['finition'] ?? '', $this->finitionOptions) ? ($line['finition'] ?? '') : '';
        
        $this->currentLacet = $this->isCustomValue($line['lacet'] ?? '', $this->lacetOptions) ? 'autre' : ($line['lacet'] ?? '');
        $this->customLacet = $this->isCustomValue($line['lacet'] ?? '', $this->lacetOptions) ? ($line['lacet'] ?? '') : '';
        
        $this->currentLacetLength = $this->isCustomValue($line['lacetx'] ?? '', $this->lacetLengthOptions) ? 'autre' : ($line['lacetx'] ?? '');
        $this->customLacetLength = $this->isCustomValue($line['lacetx'] ?? '', $this->lacetLengthOptions) ? ($line['lacetx'] ?? '') : '';
        
        $this->currentTrepointe = $this->isCustomValue($line['trepointe'] ?? '', $this->trepointeOptions) ? 'autre' : ($line['trepointe'] ?? '');
        $this->customTrepointe = $this->isCustomValue($line['trepointe'] ?? '', $this->trepointeOptions) ? ($line['trepointe'] ?? '') : '';
        
        $this->currentPerforation = $line['perforation'] ?? '';
        $this->currentFleur = $line['fleur'] ?? false;
        $this->currentDentlage = $line['dentlage'] ?? false;
        $this->currentGenre = $line['genre'] ?? 'homme';
        $this->productPrice = $line['price'];
        
        // Load size quantities into currentLine
        $this->currentLine = [
            'article' => $line['article'],
            'forme' => $line['forme'] ?? '',
            'client' => '',
            'semelle' => $line['semelle'] ?? '',
            'construction' => $line['construction'] ?? '',
            'cuir' => $line['cuir'] ?? '',
            'doublure' => $line['doublure'] ?? '',
            'supplement' => '',
            'p5' => $line['p5'] ?? 0,
            'p5x' => $line['p5x'] ?? 0,
            'p6' => $line['p6'] ?? 0,
            'p6x' => $line['p6x'] ?? 0,
            'p7' => $line['p7'] ?? 0,
            'p7x' => $line['p7x'] ?? 0,
            'p8' => $line['p8'] ?? 0,
            'p8x' => $line['p8x'] ?? 0,
            'p9' => $line['p9'] ?? 0,
            'p9x' => $line['p9x'] ?? 0,
            'p10' => $line['p10'] ?? 0,
            'p10x' => $line['p10x'] ?? 0,
            'p11' => $line['p11'] ?? 0,
            'p11x' => $line['p11x'] ?? 0,
            'p12' => $line['p12'] ?? 0,
            'p12x' => $line['p12x'] ?? 0,
            'p13' => $line['p13'] ?? 0,
            'p13x' => $line['p13x'] ?? 0,
            'p14' => $line['p14'] ?? 0,
            'p14x' => $line['p14x'] ?? 0,
            'p15' => $line['p15'] ?? 0,
            'p16' => $line['p16'] ?? 0,
            'prix' => $line['price'],
            'devise' => 'EUR',
            'genre' => $line['genre'] ?? 'homme',
            'langue' => 'français',
            'talon' => $line['talon'] ?? '',
            'finition' => $line['finition'] ?? '',
            'lacet' => $line['lacet'] ?? '',
            'lacetx' => 0,
            'perforation' => $line['perforation'] ?? '',
            'fleur' => $line['fleur'] ?? false
        ];
        
        $this->showLineEditModal = true;
    }
    
    private function isCustomValue($value, $options)
    {
        return !empty($value) && !in_array($value, $options);
    }

    public function updateOrderLine()
    {
        // Validate required fields
        $this->validate([
            'selectedArticle' => 'required',
            'productPrice' => 'required|numeric|min:0',
        ]);
        
        // Calculate total quantity from currentLine sizes including new columns
        $totalQuantity = $this->currentLine['p5'] + $this->currentLine['p5x'] + 
                        $this->currentLine['p6'] + $this->currentLine['p6x'] +
                        $this->currentLine['p7'] + $this->currentLine['p7x'] +
                        $this->currentLine['p8'] + $this->currentLine['p8x'] +
                        $this->currentLine['p9'] + $this->currentLine['p9x'] +
                        $this->currentLine['p10'] + $this->currentLine['p10x'] +
                        $this->currentLine['p11'] + $this->currentLine['p11x'] +
                        $this->currentLine['p12'] + ($this->currentLine['p12x'] ?? 0) +
                        $this->currentLine['p13'] + ($this->currentLine['p13x'] ?? 0) +
                        ($this->currentLine['p14'] ?? 0) + ($this->currentLine['p14x'] ?? 0) +
                        ($this->currentLine['p15'] ?? 0) + ($this->currentLine['p16'] ?? 0);
        
        if ($totalQuantity == 0) {
            session()->flash('error', 'Veuillez sélectionner au moins une taille');
            return;
        }
        
        // Update the order line in memory
        $this->orderLines[$this->editingLineIndex] = [
            'article' => $this->selectedArticle,
            'forme' => $this->selectedForme,
            'semelle' => $this->selectedSemelle,
            'cuir' => $this->selectedCuir,
            'doublure' => $this->selectedDoublure,
            'supplement' => $this->selectedSupplement,
            'construction' => $this->selectedConstruction,
            'talon' => $this->currentTalon === 'autre' ? $this->customTalon : $this->currentTalon,
            'finition' => $this->currentFinition === 'autre' ? $this->customFinition : $this->currentFinition,
            'lacet' => $this->currentLacet === 'autre' ? $this->customLacet : $this->currentLacet,
            'lacetx' => $this->currentLacetLength === 'autre' ? $this->customLacetLength : $this->currentLacetLength,
            'perforation' => $this->currentPerforation,
            'trepointe' => $this->currentTrepointe === 'autre' ? $this->customTrepointe : $this->currentTrepointe,
            'fleur' => $this->currentFleur,
            'dentlage' => $this->currentDentlage,
            'genre' => $this->currentGenre,
            'price' => $this->productPrice,
            'p5' => $this->currentLine['p5'],
            'p5x' => $this->currentLine['p5x'],
            'p6' => $this->currentLine['p6'],
            'p6x' => $this->currentLine['p6x'],
            'p7' => $this->currentLine['p7'],
            'p7x' => $this->currentLine['p7x'],
            'p8' => $this->currentLine['p8'],
            'p8x' => $this->currentLine['p8x'],
            'p9' => $this->currentLine['p9'],
            'p9x' => $this->currentLine['p9x'],
            'p10' => $this->currentLine['p10'],
            'p10x' => $this->currentLine['p10x'],
            'p11' => $this->currentLine['p11'],
            'p11x' => $this->currentLine['p11x'],
            'p12' => $this->currentLine['p12'],
            'p12x' => $this->currentLine['p12x'] ?? 0,
            'p13' => $this->currentLine['p13'],
            'p13x' => $this->currentLine['p13x'] ?? 0,
            'p14' => $this->currentLine['p14'] ?? 0,
            'p14x' => $this->currentLine['p14x'] ?? 0,
            'p15' => $this->currentLine['p15'] ?? 0,
            'p16' => $this->currentLine['p16'] ?? 0,
            'total_quantity' => $totalQuantity,
            'total_amount' => $totalQuantity * $this->productPrice,
        ];
        
        // Update the database if this is an existing order line
        if (isset($this->orderLines[$this->editingLineIndex]['id'])) {
            $orderLineId = $this->orderLines[$this->editingLineIndex]['id'];
            $orderLine = OrderLine::find($orderLineId);
            
            if ($orderLine) {
                $orderLine->update([
                    'article' => $this->selectedArticle,
                    'forme' => $this->selectedForme,
                    'semelle' => $this->selectedSemelle,
                    'cuir' => $this->selectedCuir,
                    'doublure' => $this->selectedDoublure,
                    'construction' => $this->selectedConstruction,
                    'talon' => $this->currentTalon,
                    'finition' => $this->currentFinition,
                    'lacet' => $this->currentLacet,
                    'perforation' => $this->currentPerforation,
                    'trepointe' => $this->currentTrepointe,
                    'fleur' => $this->currentFleur,
                    'genre' => $this->currentGenre,
                    'price' => $this->productPrice,
                    'p5' => $this->currentLine['p5'],
                    'p5x' => $this->currentLine['p5x'],
                    'p6' => $this->currentLine['p6'],
                    'p6x' => $this->currentLine['p6x'],
                    'p7' => $this->currentLine['p7'],
                    'p7x' => $this->currentLine['p7x'],
                    'p8' => $this->currentLine['p8'],
                    'p8x' => $this->currentLine['p8x'],
                    'p9' => $this->currentLine['p9'],
                    'p9x' => $this->currentLine['p9x'],
                    'p10' => $this->currentLine['p10'],
                    'p10x' => $this->currentLine['p10x'],
                    'p11' => $this->currentLine['p11'],
                    'p11x' => $this->currentLine['p11x'],
                    'p12' => $this->currentLine['p12'],
                    'p12x' => $this->currentLine['p12x'] ?? 0,
                    'p13' => $this->currentLine['p13'],
                    'p13x' => $this->currentLine['p13x'] ?? 0,
                    'p14' => $this->currentLine['p14'] ?? 0,
                    'p14x' => $this->currentLine['p14x'] ?? 0,
                    'p15' => $this->currentLine['p15'] ?? 0,
                    'p16' => $this->currentLine['p16'] ?? 0,
                    'total_quantity' => $totalQuantity,
                    'total_amount' => $totalQuantity * $this->productPrice,
                ]);
                
                // Update the order line ID in memory
                $this->orderLines[$this->editingLineIndex]['id'] = $orderLineId;
            }
        }
        
        $this->closeLineEditModal();
        session()->flash('success', 'Ligne de commande mise à jour avec succès');
    }

    public function closeLineEditModal()
    {
        $this->showLineEditModal = false;
        $this->editingLineIndex = null;
        $this->resetProductSelection();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetOrderForm();
    }

    public function viewOrder($orderId)
    {
        $this->viewingOrder = Order::with('orderLines')->find($orderId);
        $this->showViewModal = true;
    }

    public function closeViewModal()
    {
        $this->showViewModal = false;
        $this->viewingOrder = null;
    }

    public function printOrder($orderId)
    {
        $this->viewingOrder = Order::with('orderLines')->find($orderId);
        
        $this->dispatch('print-order');
    }

    public function openDeliveryModal($orderId)
    {
        $this->deliveryOrder = Order::find($orderId);
        if ($this->deliveryOrder) {
            $this->deliveryStatus = $this->deliveryOrder->status;
            $this->deliveryNotes = $this->deliveryOrder->delivery_notes ?? '';
            $this->actualDeliveryDate = $this->deliveryOrder->actual_delivery_date ?? '';
            $this->showDeliveryModal = true;
        }
    }

    public function updateDeliveryStatus()
    {
        $this->validate([
            'deliveryStatus' => 'required|in:draft,confirmed,in_production,delivered,cancelled',
            'deliveryNotes' => 'nullable|string|max:1000'
        ]);

        if ($this->deliveryOrder) {
            $this->deliveryOrder->update([
                'status' => $this->deliveryStatus,
                'delivery_notes' => $this->deliveryNotes
            ]);

            session()->flash('message', 'Statut de livraison mis à jour avec succès');
            $this->closeDeliveryModal();
        }
    }

    public function closeDeliveryModal()
    {
        $this->showDeliveryModal = false;
        $this->deliveryOrder = null;
        $this->deliveryStatus = '';
        $this->deliveryNotes = '';
        $this->actualDeliveryDate = '';
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedOrders = $this->getFilteredOrders()->pluck('id')->toArray();
        } else {
            $this->selectedOrders = [];
        }
    }

    public function bulkDelete()
    {
        if (empty($this->selectedOrders)) {
            return;
        }

        $count = count($this->selectedOrders);
        Order::whereIn('id', $this->selectedOrders)->delete();
        $this->selectedOrders = [];
        $this->selectAll = false;
        session()->flash('message', $count . ' commande(s) supprimée(s) avec succès');
    }

    public function exportSelected()
    {
        if (empty($this->selectedOrders)) {
            $orders = $this->getFilteredOrders()->get();
        } else {
            $orders = Order::whereIn('id', $this->selectedOrders)->get();
        }

        $csv = "Code,Entreprise,Ville,Téléphone,Date Livraison,Statut,Total\n";
        foreach ($orders as $order) {
            $csv .= "\"{$order->code}\",\"{$order->firm}\",\"{$order->ville}\",\"{$order->telephone}\",\"{$order->livraison}\",\"{$order->status}\",\"{$order->total_amount}\"\n";
        }

        return response()->streamDownload(function () use ($csv) {
            echo $csv;
        }, 'commandes_' . date('Y-m-d') . '.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }

    private function getFilteredOrders()
    {
        return Order::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('code', 'like', '%' . $this->search . '%')
                      ->orWhere('firm', 'like', '%' . $this->search . '%')
                      ->orWhere('ville', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    private function resetForm()
    {
        $this->editingOrder = null;
        $this->code = '';
        $this->firm = '';
        $this->ville = '';
        $this->telephone = '';
        $this->livraison = now()->addDays(30)->format('Y-m-d');
        $this->transporteur = '';
        $this->boite = '';
        $this->logo = null;
        $this->logo1 = null;
        $this->notes = '';
        $this->transort = '';
        $this->orderLines = [];
        $this->resetCurrentLine();
    }

    private function resetCurrentLine()
    {
        $this->currentLine = [
            'article' => '',
            'forme' => '',
            'client' => '',
            'semelle' => '',
            'construction' => '',
            'cuir' => '',
            'doublure' => '',
            'supplement' => '',
            'p5' => 0, 'p5x' => 0, 'p6' => 0, 'p6x' => 0,
            'p7' => 0, 'p7x' => 0, 'p8' => 0, 'p8x' => 0,
            'p9' => 0, 'p9x' => 0, 'p10' => 0, 'p10x' => 0,
            'p11' => 0, 'p11x' => 0, 'p12' => 0, 'p13' => 0,
            'prix' => 0,
            'devise' => '€',
            'genre' => 'homme',
            'langue' => 'français'
        ];
    }
    
    private function resetProductSelection()
    {
        $this->selectedArticle = '';
        $this->selectedForme = '';
        $this->selectedSemelle = '';
        $this->selectedCuir = '';
        $this->selectedSupplement = '';
        $this->selectedDoublure = '';
        $this->selectedConstruction = '';
        $this->currentTalon = '';
        $this->currentFinition = '';
        $this->currentLacet = '';
        $this->currentPerforation = '';
        $this->currentTrepointe = '';
        $this->currentFleur = false;
        $this->currentLacetLength = '';
        $this->currentDentlage = false;
        $this->customTalon = '';
        $this->customFinition = '';
        $this->customLacet = '';
        $this->customLacetLength = '';
        $this->customTrepointe = '';
        $this->productPrice = 0;
        $this->currentLine = [
            'article' => '',
            'forme' => '',
            'client' => '',
            'semelle' => '',
            'construction' => '',
            'cuir' => '',
            'doublure' => '',
            'supplement' => '',
            'p5' => 0, 'p5x' => 0, 'p6' => 0, 'p6x' => 0,
            'p7' => 0, 'p7x' => 0, 'p8' => 0, 'p8x' => 0,
            'p9' => 0, 'p9x' => 0, 'p10' => 0, 'p10x' => 0,
            'p11' => 0, 'p11x' => 0, 'p12' => 0, 'p13' => 0,
            'prix' => 0,
            'devise' => 'EUR',
            'genre' => $this->currentGenre,
            'langue' => 'français',
            'talon' => '',
            'finition' => '',
            'lacet' => '',
            'lacetx' => 0,
            'perforation' => false,
            'fleur' => false,
            'dentlage' => false
        ];
    }
}
