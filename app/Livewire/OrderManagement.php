<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class OrderManagement extends Component
{
    use WithPagination, WithFileUploads;

    // Modal states
    public $showModal = false;
    public $showViewModal = false;
    public $showDeliveryModal = false;
    public $showLineEditModal = false;
    
    // Current objects
    public $editingOrder = null;
    public $viewingOrder = null;
    public $deliveryOrder = null;
    public $editingLineIndex = null;
    
    // Search and filters
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $statusFilter = '';
    public $perPage = 10;
    public $selectedOrders = [];
    public $selectAll = false;
    
    // Multi-step form
    public $currentStep = 1;
    
    // KPI data
    public $totalOrders = 0;
    public $totalRevenue = 0;
    public $pendingDeliveries = 0;
    public $weeklyOrders = 0;
    public $urgentOrders = 0;
    public $deliveryRate = 0;

    // Order form fields
    public $orderId = null;
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

    // Order lines array
    public $orderLines = [];
    
    // Current line being edited/added
    public $currentLine = [];
    
    // Product selection fields
    public $selectedArticle = '';
    public $selectedForme = '';
    public $selectedSemelle = '';
    public $selectedCuir = '';
    public $selectedSupplement = '';
    public $selectedDoublure = '';
    public $selectedConstruction = '';
    public $productPrice = 0;
    
    // Additional form fields
    public $currentGenre = 'homme';
    public $currentTalon = '';
    public $currentFinition = '';
    public $currentLacet = '';
    public $currentLacetLength = '';
    public $currentPerforation = 0;
    public $currentTrepointe = '';
    public $currentFleur = false;
    public $currentDentlage = false;
    
    // Custom "autre" values
    public $customTalon = '';
    public $customFinition = '';
    public $customLacet = '';
    public $customLacetLength = '';
    public $customTrepointe = '';
    
    // Delivery modal fields
    public $deliveryStatus = '';
    
    // Hardcoded options
    public $talonOptions = ['Synderme', 'Cuir', 'autre', 'vide'];
    public $finitionOptions = ['Antique', 'Brut', 'Fumé', 'Patiné', 'Standard', 'autre'];
    public $lacetOptions = ['Plat Marron', 'Plat Noir', 'Plat Bleu', 'Rond Marron', 'Rond Noir', 'Rond Bleu', 'autre', 'Sans'];
    public $lacetLengthOptions = ['75', '85', '115', 'autre', 'Sans'];
    public $perforationOptions = ['Sans', 'Avec perforation'];
    public $trepointeOptions = ['Plat marron', 'Plat naturelle', 'Stormwelt marron', 'Stormwelt naturelle', 'autre', 'vide'];

    // Item collections
    public $articles = [];
    public $formes = [];
    public $semelles = [];
    public $cuirs = [];
    public $doublures = [];
    public $constructions = [];
    public $supplements = [];

    protected $rules = [
        'code' => 'required|string|max:100',
        'firm' => 'nullable|string|max:100',
        'ville' => 'nullable|string|max:100',
        'telephone' => 'nullable|string|max:20',
        'livraison' => 'required|date',
    ];

    public function mount()
    {
        $this->initializeComponent();
    }
    
    private function initializeComponent()
    {
        $this->livraison = now()->addDays(30)->format('Y-m-d');
        $this->calculateKPIs();
        $this->loadItemCollections();
        $this->initializeCurrentLine();
    }
    
    private function initializeCurrentLine()
    {
        $this->currentLine = [];
        foreach (OrderLine::SIZE_COLUMNS as $column) {
            $this->currentLine[$column] = 0;
        }
        
        $this->currentLine['article'] = '';
        $this->currentLine['forme'] = '';
        $this->currentLine['client'] = '';
        $this->currentLine['semelle'] = '';
        $this->currentLine['construction'] = '';
        $this->currentLine['cuir'] = '';
        $this->currentLine['doublure'] = '';
        $this->currentLine['supplement'] = '';
        $this->currentLine['prix'] = 0;
        $this->currentLine['devise'] = 'EUR';
        $this->currentLine['genre'] = 'homme';
        $this->currentLine['langue'] = 'français';
        $this->currentLine['talon'] = '';
        $this->currentLine['finition'] = '';
        $this->currentLine['lacet'] = '';
        $this->currentLine['lacetx'] = 0;
        $this->currentLine['perforation'] = 0;
        $this->currentLine['fleur'] = false;
        $this->currentLine['dentlage'] = false;
        $this->currentLine['trepointe'] = '';
    }

    private function loadItemCollections()
    {
        $this->articles = Item::where('type', 'article')->get();
        $this->formes = Item::where('type', 'forme')->get();
        $this->semelles = Item::where('type', 'semelle')->get();
        $this->cuirs = Item::where('type', 'cuir')->get();
        $this->doublures = Item::where('type', 'doublure')->get();
        $this->constructions = Item::where('type', 'construction')->get();
        $this->supplements = Item::where('type', 'supplement')->get();
    }

    private function calculateKPIs()
    {
        $this->totalOrders = Order::count();
        $this->totalRevenue = Order::sum('total_amount') ?: 0;
        $this->pendingDeliveries = Order::pending()
            ->where('livraison', '>=', now())
            ->count();
        
        $this->weeklyOrders = Order::whereBetween('created_at', [
            now()->subDays(30),
            now()
        ])->count();
        
        $this->urgentOrders = Order::urgent()
            ->pending()
            ->count();
        
        $deliveredCount = Order::delivered()->count();
        $this->deliveryRate = $this->totalOrders > 0 
            ? round(($deliveredCount / $this->totalOrders) * 100, 1) 
            : 0;
    }

    public function render()
    {
        $query = Order::with('orderLines');
        
        if ($this->search) {
            $query->where(function($q) {
                $q->where('code', 'like', '%' . $this->search . '%')
                  ->orWhere('firm', 'like', '%' . $this->search . '%')
                  ->orWhere('ville', 'like', '%' . $this->search . '%');
            });
        }
        
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }
        
        $query->orderBy($this->sortField, $this->sortDirection);
        
        $orders = $query->paginate($this->perPage);

        return view('livewire.order-management', [
            'orders' => $orders,
        ])->layout('layouts.app');
    }

    /**
     * Open modal for creating or editing an order
     */
    public function openOrderModal($orderId = null)
    {
        $this->resetOrderForm();
        $this->loadItemCollections();
        
        if ($orderId) {
            $this->loadOrder($orderId);
        } else {
            $this->livraison = now()->addDays(30)->format('Y-m-d');
        }
        
        $this->currentStep = 1;
        $this->showModal = true;
    }
    
    /**
     * Load order data for editing
     */
    private function loadOrder($orderId)
    {
        $order = Order::with('orderLines')->find($orderId);
        
        if (!$order) {
            session()->flash('error', 'Commande introuvable');
            return;
        }
        
        $this->editingOrder = $order;
        $this->orderId = $order->id;
        $this->code = $order->code;
        $this->firm = $order->firm;
        $this->ville = $order->ville;
        $this->telephone = $order->telephone;
        $this->livraison = $order->livraison ? $order->livraison->format('Y-m-d') : '';
        $this->notes = $order->notes;
        $this->logo = $order->logo;
        $this->logo1 = $order->logo1;
        $this->transporteur = $order->transporteur;
        $this->boite = $order->boite;
        $this->transort = $order->transort;
        
        // Load order lines
        $this->orderLines = [];
        foreach ($order->orderLines as $line) {
            $lineData = $line->toArray();
            $lineData['price'] = $line->prix;
            $lineData['total_quantity'] = $line->total_quantity;
            $lineData['total_amount'] = $line->total_amount;
            $lineData['line_id'] = $line->id;
            
            $this->orderLines[] = $lineData;
        }
    }

    /**
     * Save or update order (unified method)
     */
    public function saveOrder()
    {
        $this->validate();

        DB::beginTransaction();
        
        try {
            // Handle logo uploads
            $logoPath = $this->processLogoUpload('logo', $this->logo);
            $logo1Path = $this->processLogoUpload('logo1', $this->logo1);

            // Prepare order data
            $orderData = [
                'code' => $this->code,
                'firm' => $this->firm,
                'ville' => $this->ville,
                'telephone' => $this->telephone,
                'livraison' => $this->livraison,
                'logo' => $logoPath,
                'logo1' => $logo1Path,
                'notes' => $this->notes,
                'transporteur' => $this->transporteur,
                'boite' => $this->boite,
                'transort' => $this->transort,
                'status' => $this->editingOrder->status ?? 'draft',
            ];

            // Create or update order
            if ($this->orderId) {
                $order = Order::find($this->orderId);
                $order->update($orderData);
            } else {
                $order = Order::create($orderData);
            }

            // Sync order lines
            $this->syncOrderLines($order);
            
            // Recalculate totals
            $order->recalculateTotals()->save();
            
            DB::commit();
            
            $this->closeModal();
            $this->calculateKPIs();
            
            $message = $this->orderId ? 'Commande mise à jour avec succès!' : 'Commande créée avec succès!';
            session()->flash('message', $message);
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Erreur lors de la sauvegarde: ' . $e->getMessage());
        }
    }
    
    /**
     * Process logo upload
     */
    private function processLogoUpload($field, $value)
    {
        if ($value && !is_string($value)) {
            return $value->store('logos', 'public');
        } elseif ($this->editingOrder && !$value) {
            return $this->editingOrder->{$field};
        } elseif (is_string($value)) {
            return $value;
        }
        return null;
    }
    
    /**
     * Sync order lines with database
     */
    private function syncOrderLines($order)
    {
        $existingLineIds = [];
        
        foreach ($this->orderLines as $lineData) {
            $sanitizedData = $this->sanitizeOrderLineData($lineData);
            
            if (isset($lineData['line_id'])) {
                // Update existing line
                $line = OrderLine::find($lineData['line_id']);
                if ($line) {
                    $line->update($sanitizedData);
                    $existingLineIds[] = $line->id;
                }
            } else {
                // Create new line
                $line = $order->orderLines()->create($sanitizedData);
                $existingLineIds[] = $line->id;
            }
        }
        
        // Delete removed lines
        $order->orderLines()->whereNotIn('id', $existingLineIds)->delete();
    }

    /**
     * Add or update order line in memory
     */
    public function saveOrderLine()
    {
        // Validate required fields
        $this->validate([
            'selectedArticle' => 'required',
            'productPrice' => 'required|numeric|min:0',
        ]);
        
        // Calculate total quantity
        $totalQuantity = 0;
        foreach (OrderLine::SIZE_COLUMNS as $column) {
            $value = $this->currentLine[$column] ?? 0;
            // Filter and convert to int
            $totalQuantity += filter_var($value, FILTER_VALIDATE_INT) !== false 
                ? (int)$value 
                : 0;
        }
        
        if ($totalQuantity == 0) {
            session()->flash('error', 'Veuillez sélectionner au moins une taille');
            return;
        }
        
        // Prepare line data
        $lineData = $this->prepareOrderLineData();
        $lineData['total_quantity'] = $totalQuantity;
        $lineData['total_amount'] = $totalQuantity * $this->productPrice;
        
        // If editing an existing order, save to database immediately
        if ($this->orderId) {
            DB::beginTransaction();
            try {
                $order = Order::find($this->orderId);
                $sanitizedData = $this->sanitizeOrderLineData($lineData);
                
                if ($this->editingLineIndex !== null && isset($this->orderLines[$this->editingLineIndex]['line_id'])) {
                    // Update existing line in database
                    $line = OrderLine::find($this->orderLines[$this->editingLineIndex]['line_id']);
                    if ($line) {
                        $line->update($sanitizedData);
                        $lineData['line_id'] = $line->id;
                        $this->orderLines[$this->editingLineIndex] = $lineData;
                        $message = 'Ligne mise à jour avec succès';
                    }
                } else {
                    // Create new line in database
                    $line = $order->orderLines()->create($sanitizedData);
                    $lineData['line_id'] = $line->id;
                    $this->orderLines[] = $lineData;
                    $message = 'Ligne ajoutée avec succès';
                }
                
                // Recalculate order totals
                $order->recalculateTotals()->save();
                
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                session()->flash('error', 'Erreur lors de la sauvegarde: ' . $e->getMessage());
                return;
            }
        } else {
            // For new orders, just add to array (will be saved when order is created)
            if ($this->editingLineIndex !== null) {
                if (isset($this->orderLines[$this->editingLineIndex]['line_id'])) {
                    $lineData['line_id'] = $this->orderLines[$this->editingLineIndex]['line_id'];
                }
                $this->orderLines[$this->editingLineIndex] = $lineData;
                $message = 'Ligne mise à jour avec succès';
            } else {
                $this->orderLines[] = $lineData;
                $message = 'Ligne ajoutée avec succès';
            }
        }
        
        $this->resetLineForm();
        $this->showLineEditModal = false;
        session()->flash('message', $message);
    }
    
    /**
     * Prepare order line data from form inputs
     */
    private function prepareOrderLineData()
    {
        $lineData = [
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
        ];
        
        // Add all size columns
        foreach (OrderLine::SIZE_COLUMNS as $column) {
            $lineData[$column] = $this->currentLine[$column] ?? 0;
        }
        
        return $lineData;
    }

    /**
     * Edit order line
     */
    public function editOrderLine($index)
    {
        $this->editingLineIndex = $index;
        $line = $this->orderLines[$index];
        
        $this->loadItemCollections();
        $this->loadLineDataIntoForm($line);
        
        $this->showLineEditModal = true;
    }
    
    /**
     * Load line data into form fields
     */
    private function loadLineDataIntoForm($line)
    {
        $this->selectedArticle = $line['article'] ?? '';
        $this->selectedForme = $line['forme'] ?? '';
        $this->selectedSemelle = $line['semelle'] ?? '';
        $this->selectedCuir = $line['cuir'] ?? '';
        $this->selectedDoublure = $line['doublure'] ?? '';
        $this->selectedSupplement = $line['supplement'] ?? '';
        $this->selectedConstruction = $line['construction'] ?? '';
        
        // Handle custom values
        $this->loadCustomValue('talon', $line['talon'] ?? '', $this->talonOptions);
        $this->loadCustomValue('finition', $line['finition'] ?? '', $this->finitionOptions);
        $this->loadCustomValue('lacet', $line['lacet'] ?? '', $this->lacetOptions);
        $this->loadCustomValue('lacetLength', $line['lacetx'] ?? '', $this->lacetLengthOptions);
        $this->loadCustomValue('trepointe', $line['trepointe'] ?? '', $this->trepointeOptions);
        
        $this->currentPerforation = $line['perforation'] ?? 0;
        $this->currentFleur = $line['fleur'] ?? false;
        $this->currentDentlage = $line['dentlage'] ?? false;
        $this->currentGenre = $line['genre'] ?? 'homme';
        $this->productPrice = $line['price'] ?? $line['prix'] ?? 0;
        
        // Load size quantities
        foreach (OrderLine::SIZE_COLUMNS as $column) {
            $this->currentLine[$column] = $line[$column] ?? 0;
        }
    }
    
    /**
     * Load custom value and set appropriate field
     */
    private function loadCustomValue($fieldPrefix, $value, $options)
    {
        $currentField = 'current' . ucfirst($fieldPrefix);
        $customField = 'custom' . ucfirst($fieldPrefix);
        
        if ($this->isCustomValue($value, $options)) {
            $this->{$currentField} = 'autre';
            $this->{$customField} = $value;
        } else {
            $this->{$currentField} = $value;
            $this->{$customField} = '';
        }
    }
    
    /**
     * Check if value is custom (not in options)
     */
    private function isCustomValue($value, $options)
    {
        return !empty($value) && !in_array($value, $options);
    }

    /**
     * Remove order line
     */
    public function removeOrderLine($index)
    {
        // If editing an existing order and line has an ID, delete from database
        if ($this->orderId && isset($this->orderLines[$index]['line_id'])) {
            DB::beginTransaction();
            try {
                $lineId = $this->orderLines[$index]['line_id'];
                OrderLine::find($lineId)?->delete();
                
                // Recalculate order totals
                $order = Order::find($this->orderId);
                if ($order) {
                    $order->recalculateTotals()->save();
                }
                
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                session()->flash('error', 'Erreur lors de la suppression: ' . $e->getMessage());
                return;
            }
        }
        
        unset($this->orderLines[$index]);
        $this->orderLines = array_values($this->orderLines);
        session()->flash('message', 'Ligne supprimée');
    }

    /**
     * Delete order
     */
    public function deleteOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->orderLines()->delete();
        $order->delete();
        $this->calculateKPIs();
        session()->flash('message', 'Commande supprimée avec succès!');
    }

    /**
     * View order details
     */
    public function viewOrder($orderId)
    {
        $this->viewingOrder = Order::with('orderLines')->find($orderId);
        $this->showViewModal = true;
    }

    /**
     * Open delivery modal
     */
    public function openDeliveryModal($orderId)
    {
        $this->deliveryOrder = Order::find($orderId);
        if ($this->deliveryOrder) {
            $this->deliveryStatus = $this->deliveryOrder->status;
            $this->showDeliveryModal = true;
        }
    }

    /**
     * Update delivery status
     */
    public function updateDeliveryStatus()
    {
        $this->validate([
            'deliveryStatus' => 'required|in:draft,confirmed,in_production,delivered,cancelled',
        ]);

        if ($this->deliveryOrder) {
            $updateData = [
                'status' => $this->deliveryStatus,
            ];
            
            $this->deliveryOrder->update($updateData);
            
            session()->flash('message', 'Statut de livraison mis à jour avec succès');
            $this->closeDeliveryModal();
            $this->calculateKPIs();
        }
    }

    /**
     * Sanitize order line data for database
     */
    private function sanitizeOrderLineData($line)
    {
        $sanitized = [
            'article' => $line['article'] ?? '',
            'forme' => !empty($line['forme']) ? $line['forme'] : null,
            'semelle' => !empty($line['semelle']) ? $line['semelle'] : null,
            'cuir' => !empty($line['cuir']) ? $line['cuir'] : null,
            'doublure' => !empty($line['doublure']) ? $line['doublure'] : null,
            'supplement' => !empty($line['supplement']) ? $line['supplement'] : null,
            'construction' => !empty($line['construction']) ? $line['construction'] : null,
            'talon' => !empty($line['talon']) ? $line['talon'] : null,
            'finition' => !empty($line['finition']) ? $line['finition'] : null,
            'lacet' => !empty($line['lacet']) ? $line['lacet'] : null,
            'perforation' => $this->convertToInt($line['perforation'] ?? 0),
            'trepointe' => !empty($line['trepointe']) ? $line['trepointe'] : null,
            'fleur' => $this->convertToBoolean($line['fleur'] ?? false),
            'dentlage' => $this->convertToBoolean($line['dentlage'] ?? false),
            'genre' => $line['genre'] ?? 'homme',
            'prix' => $this->convertToDecimal($line['price'] ?? $line['prix'] ?? 0),
            'lacetx' => $this->convertLacetxToDecimal($line['lacetx'] ?? null),
        ];
        
        // Add all size columns
        foreach (OrderLine::SIZE_COLUMNS as $column) {
            $sanitized[$column] = $this->convertToInt($line[$column] ?? 0);
        }
        
        return $sanitized;
    }

    /**
     * Type conversion helpers
     */
    private function convertToInt($value)
    {
        return is_numeric($value) ? (int) $value : 0;
    }
    
    private function convertToDecimal($value)
    {
        return is_numeric($value) ? (float) $value : 0;
    }
    
    private function convertToBoolean($value)
    {
        if (is_bool($value)) return $value ? 1 : 0;
        if (is_string($value)) return in_array($value, ['1', 'true', 'on']) ? 1 : 0;
        return 0;
    }
    
    private function convertLacetxToDecimal($value)
    {
        if (is_string($value) && ($value === '' || $value === 'Sans')) {
            return null;
        }
        return is_numeric($value) ? (float) $value : null;
    }

    /**
     * Get size mapping based on gender
     */
    public function getSizeMapping()
    {
        if ($this->currentGenre === 'femme') {
            // Women's sizes: 35-43 (EU/FR)
            return [
                '35' => ['eu' => '35', 'us' => '5', 'fr' => '35', 'db' => 'p5'],
                '35.5' => ['eu' => '35.5', 'us' => '5.5', 'fr' => '35.5', 'db' => 'p5x'],
                '36' => ['eu' => '36', 'us' => '6', 'fr' => '36', 'db' => 'p6'],
                '36.5' => ['eu' => '36.5', 'us' => '6.5', 'fr' => '36.5', 'db' => 'p6x'],
                '37' => ['eu' => '37', 'us' => '7', 'fr' => '37', 'db' => 'p7'],
                '37.5' => ['eu' => '37.5', 'us' => '7.5', 'fr' => '37.5', 'db' => 'p7x'],
                '38' => ['eu' => '38', 'us' => '8', 'fr' => '38', 'db' => 'p8'],
                '38.5' => ['eu' => '38.5', 'us' => '8.5', 'fr' => '38.5', 'db' => 'p8x'],
                '39' => ['eu' => '39', 'us' => '9', 'fr' => '39', 'db' => 'p9'],
                '39.5' => ['eu' => '39.5', 'us' => '9.5', 'fr' => '39.5', 'db' => 'p9x'],
                '40' => ['eu' => '40', 'us' => '10', 'fr' => '40', 'db' => 'p10'],
                '40.5' => ['eu' => '40.5', 'us' => '10.5', 'fr' => '40.5', 'db' => 'p10x'],
                '41' => ['eu' => '41', 'us' => '11', 'fr' => '41', 'db' => 'p11'],
                '41.5' => ['eu' => '41.5', 'us' => '11.5', 'fr' => '41.5', 'db' => 'p11x'],
                '42' => ['eu' => '42', 'us' => '12', 'fr' => '42', 'db' => 'p12'],
                '42.5' => ['eu' => '42.5', 'us' => '12.5', 'fr' => '42.5', 'db' => 'p12x'],
                '43' => ['eu' => '43', 'us' => '13', 'fr' => '43', 'db' => 'p13'],
                '44' => ['eu' => '44', 'us' => '14', 'fr' => '44', 'db' => 'p14'],
            ];
        } else {
            // Men's sizes: 38-47 (EU/FR)
            return [
                '38' => ['eu' => '38', 'us' => '4', 'fr' => '38', 'db' => 'p8'],
                '38.5' => ['eu' => '38.5', 'us' => '4.5', 'fr' => '38.5', 'db' => 'p8x'],
                '39' => ['eu' => '39', 'us' => '5', 'fr' => '39', 'db' => 'p9'],
                '39.5' => ['eu' => '39.5', 'us' => '5.5', 'fr' => '39.5', 'db' => 'p9x'],
                '40' => ['eu' => '40', 'us' => '6', 'fr' => '40', 'db' => 'p10'],
                '40.5' => ['eu' => '40.5', 'us' => '6.5', 'fr' => '40.5', 'db' => 'p10x'],
                '41' => ['eu' => '41', 'us' => '7', 'fr' => '41', 'db' => 'p11'],
                '41.5' => ['eu' => '41.5', 'us' => '7.5', 'fr' => '41.5', 'db' => 'p11x'],
                '42' => ['eu' => '42', 'us' => '8', 'fr' => '42', 'db' => 'p12'],
                '42.5' => ['eu' => '42.5', 'us' => '8.5', 'fr' => '42.5', 'db' => 'p12x'],
                '43' => ['eu' => '43', 'us' => '9', 'fr' => '43', 'db' => 'p13'],
                '43.5' => ['eu' => '43.5', 'us' => '9.5', 'fr' => '43.5', 'db' => 'p13x'],
                '44' => ['eu' => '44', 'us' => '10', 'fr' => '44', 'db' => 'p14'],
                '44.5' => ['eu' => '44.5', 'us' => '10.5', 'fr' => '44.5', 'db' => 'p14x'],
                '45' => ['eu' => '45', 'us' => '11', 'fr' => '45', 'db' => 'p15'],
                '45.5' => ['eu' => '45.5', 'us' => '11.5', 'fr' => '45.5', 'db' => 'p15x'],
                '46' => ['eu' => '46', 'us' => '12', 'fr' => '46', 'db' => 'p16'],
                '47' => ['eu' => '47', 'us' => '13', 'fr' => '47', 'db' => 'p17'],
            ];
        }
    }

    /**
     * Sort table by field
     */
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    /**
     * Handle bulk selection
     */
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedOrders = $this->getFilteredOrders()->pluck('id')->toArray();
        } else {
            $this->selectedOrders = [];
        }
    }

    /**
     * Bulk delete selected orders
     */
    public function bulkDelete()
    {
        if (empty($this->selectedOrders)) {
            return;
        }

        $count = count($this->selectedOrders);
        Order::whereIn('id', $this->selectedOrders)->delete();
        $this->selectedOrders = [];
        $this->selectAll = false;
        $this->calculateKPIs();
        session()->flash('message', $count . ' commande(s) supprimée(s) avec succès');
    }

    /**
     * Export selected orders
     */
    public function exportSelected()
    {
        $orders = empty($this->selectedOrders) 
            ? $this->getFilteredOrders()->get()
            : Order::whereIn('id', $this->selectedOrders)->get();

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

    /**
     * Get filtered orders query
     */
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

    /**
     * Modal control methods
     */
    public function nextStep()
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'code' => 'required|string|max:255',
                'livraison' => 'required|date',
            ]);
        }
        $this->currentStep++;
    }
    
    public function previousStep()
    {
        $this->currentStep--;
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetOrderForm();
    }
    
    public function closeViewModal()
    {
        $this->showViewModal = false;
        $this->viewingOrder = null;
    }
    
    public function closeDeliveryModal()
    {
        $this->showDeliveryModal = false;
        $this->deliveryOrder = null;
        $this->deliveryStatus = '';
    }
    
    public function closeLineEditModal()
    {
        $this->showLineEditModal = false;
        $this->editingLineIndex = null;
        $this->resetLineForm();
    }

    /**
     * Reset form methods
     */
    private function resetOrderForm()
    {
        $this->orderId = null;
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
        $this->currentStep = 1;
        $this->resetLineForm();
    }
    
    private function resetLineForm()
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
        $this->currentLacetLength = '';
        $this->currentPerforation = 0;
        $this->currentTrepointe = '';
        $this->currentFleur = false;
        $this->currentDentlage = false;
        $this->customTalon = '';
        $this->customFinition = '';
        $this->customLacet = '';
        $this->customLacetLength = '';
        $this->customTrepointe = '';
        $this->productPrice = 0;
        $this->editingLineIndex = null;
        $this->initializeCurrentLine();
    }
    
    /**
     * Logo removal methods
     */
    public function removeLogo()
    {
        $this->logo = null;
    }
    
    public function removeLogo1()
    {
        $this->logo1 = null;
    }
}