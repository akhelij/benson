<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class ItemManagement extends Component
{
    use WithPagination;

    public $showModal = false;
    public $editingItem = null;
    public $search = '';
    public $searchCriteria = 'forme';
    public $activeTab = 'formes';
    
    // Item form fields
    public $nom = '';
    public $type = 'forme';
    public $parent_id = null;
    public $description = '';

    protected $rules = [
        'nom' => 'required|string|max:255',
        'type' => 'required|in:forme,article,cuir,semelle,construction,supplement',
        'parent_id' => 'nullable|exists:items,id',
    ];

    protected $messages = [
        'nom.required' => 'Le nom est obligatoire.',
        'type.required' => 'Le type est obligatoire.',
        'parent_id.exists' => 'Le parent sélectionné n\'existe pas.',
    ];

    public function render()
    {
        $formes = Item::where('type', 'forme')
            ->when($this->search && $this->searchCriteria === 'forme', function($query) {
                $query->where('nom', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nom')
            ->paginate(10, ['*'], 'formes');

        $articles = Item::where('type', 'article')
            ->with('parent')
            ->when($this->search && $this->searchCriteria === 'article', function($query) {
                $query->where('nom', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nom')
            ->paginate(10, ['*'], 'articles');

        $cuirs = Item::where('type', 'cuir')
            ->when($this->search && $this->searchCriteria === 'cuir', function($query) {
                $query->where('nom', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nom')
            ->paginate(10, ['*'], 'cuirs');

        $semelles = Item::where('type', 'semelle')
            ->when($this->search && $this->searchCriteria === 'semelle', function($query) {
                $query->where('nom', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nom')
            ->paginate(10, ['*'], 'semelles');

        $constructions = Item::where('type', 'construction')
            ->when($this->search && $this->searchCriteria === 'construction', function($query) {
                $query->where('nom', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nom')
            ->paginate(10, ['*'], 'constructions');

        $supplements = Item::where('type', 'supplement')
            ->when($this->search && $this->searchCriteria === 'supplement', function($query) {
                $query->where('nom', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nom')
            ->paginate(10, ['*'], 'supplements');

        return view('livewire.item-management', [
            'formes' => $formes,
            'articles' => $articles,
            'cuirs' => $cuirs,
            'semelles' => $semelles,
            'constructions' => $constructions,
            'supplements' => $supplements,
            'availableFormes' => Item::where('type', 'forme')->orderBy('nom')->get(),
        ])->layout('layouts.app');
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->searchCriteria = $tab === 'formes' ? 'forme' : $tab;
        $this->search = '';
        $this->resetPage();
    }

    public function createItem($type = null)
    {
        $this->resetForm();
        if ($type) {
            $this->type = $type;
        }
        $this->showModal = true;
    }

    public function createArticleForForme($formeId)
    {
        $this->resetForm();
        $this->type = 'article';
        $this->parent_id = $formeId;
        $this->showModal = true;
    }

    public function editItem($itemId)
    {
        $item = Item::findOrFail($itemId);
        $this->editingItem = $item;
        
        $this->nom = $item->nom;
        $this->type = $item->type;
        $this->parent_id = $item->parent_id;
        
        $this->showModal = true;
    }

    public function saveItem()
    {
        $this->validate();

        $itemData = [
            'nom' => $this->nom,
            'type' => $this->type,
            'parent_id' => $this->parent_id,
        ];

        if ($this->editingItem) {
            $this->editingItem->update($itemData);
            session()->flash('message', ucfirst($this->type) . ' modifié(e) avec succès!');
        } else {
            Item::create($itemData);
            session()->flash('message', ucfirst($this->type) . ' ajouté(e) avec succès!');
        }

        $this->resetForm();
        $this->showModal = false;
    }

    public function deleteItem($itemId)
    {
        $item = Item::findOrFail($itemId);
        
        // Check if item has children (for formes with articles)
        if ($item->children()->count() > 0) {
            session()->flash('error', 'Impossible de supprimer cet élément car il a des éléments associés.');
            return;
        }
        
        $item->delete();
        session()->flash('message', ucfirst($item->type) . ' supprimé(e) avec succès!');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSearchCriteria()
    {
        $this->resetPage();
    }

    private function resetForm()
    {
        $this->editingItem = null;
        $this->nom = '';
        $this->type = 'forme';
        $this->parent_id = null;
        $this->description = '';
        $this->resetErrorBag();
    }
}
