<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Item;

class CuirsSupplements extends Component
{
    use WithPagination, WithFileUploads;

    // Confirmation properties
    public $showDeleteConfirmation = false;
    public $itemToDelete = null;
    public $deleteType = null; // 'cuir', 'doublure', or 'supplement'

    // Search filters
    public $searchCuir = '';
    public $searchSupplement = '';
    public $searchDoublure = '';

    // Edit/Add state for each table
    public $editingCuirId = null;
    public $newCuir = ['nom' => '', 'type' => 'cuir'];
    public $editCuir = ['id' => null, 'nom' => ''];
    public $cuirImage = null;
    public $editCuirImage = null;

    public $editingSupplementId = null;
    public $newSupplement = ['nom' => '', 'type' => 'supplement'];
    public $editSupplement = ['id' => null, 'nom' => ''];

    public $editingDoublureId = null;
    public $newDoublure = ['nom' => '', 'type' => 'doublure'];
    public $editDoublure = ['id' => null, 'nom' => ''];
    public $doublureImage = null;
    public $editDoublureImage = null;

    // Add mode flags
    public $addingCuir = false;
    public $addingSupplement = false;
    public $addingDoublure = false;

    protected $rules = [
        'newCuir.nom' => 'required|string|max:255',
        'newSupplement.nom' => 'required|string|max:255',
        'newDoublure.nom' => 'required|string|max:255',
        'cuirImage' => 'nullable|image|max:2048',
        'doublureImage' => 'nullable|image|max:2048',
        'editCuir.nom' => 'required|string|max:255',
        'editSupplement.nom' => 'required|string|max:255',
        'editDoublure.nom' => 'required|string|max:255',
        'editCuirImage' => 'nullable|image|max:2048',
        'editDoublureImage' => 'nullable|image|max:2048',
    ];

    public function mount()
    {
        // Initialize
    }

    // Cuir Methods
    public function startAddCuir()
    {
        $this->addingCuir = true;
        $this->newCuir = ['nom' => '', 'type' => 'cuir'];
        $this->cuirImage = null;
    }

    public function saveCuir()
    {
        $this->validate([
            'newCuir.nom' => 'required|string|max:255',
            'cuirImage' => 'nullable|image|max:2048'
        ]);
        
        $item = Item::create([
            'nom' => $this->newCuir['nom'],
            'type' => 'cuir'
        ]);

        // Handle image upload
        if ($this->cuirImage) {
            $item->addMedia($this->cuirImage, 'images');
        }

        $this->addingCuir = false;
        $this->newCuir = ['nom' => '', 'type' => 'cuir'];
        $this->cuirImage = null;
        session()->flash('message', 'Cuir ajouté avec succès.');
    }

    public function cancelAddCuir()
    {
        $this->addingCuir = false;
        $this->newCuir = ['nom' => '', 'type' => 'cuir'];
        $this->cuirImage = null;
    }

    public function editCuirRow($id)
    {
        $cuir = Item::find($id);
        if ($cuir) {
            $this->editingCuirId = $id;
            $this->editCuir = [
                'id' => $id, 
                'nom' => $cuir->nom
            ];
            $this->editCuirImage = null;
        }
    }

    public function updateCuir()
    {
        $this->validate([
            'editCuir.nom' => 'required|string|max:255',
            'editCuirImage' => 'nullable|image|max:2048'
        ]);
        
        $cuir = Item::find($this->editCuir['id']);
        if ($cuir) {
            $cuir->update([
                'nom' => $this->editCuir['nom']
            ]);
            
            // Handle image upload
            if ($this->editCuirImage) {
                $cuir->clearMediaCollection('images');
                $cuir->addMedia($this->editCuirImage, 'images');
            }
            
            session()->flash('message', 'Cuir modifié avec succès.');
        }
        
        $this->editingCuirId = null;
        $this->editCuir = ['id' => null, 'nom' => ''];
        $this->editCuirImage = null;
    }

    public function cancelEditCuir()
    {
        $this->editingCuirId = null;
        $this->editCuir = ['id' => null, 'nom' => ''];
        $this->editCuirImage = null;
    }

    public function confirmDeleteCuir($id)
    {
        $this->confirmDelete($id, 'cuir');
    }

    // Supplement Methods
    public function startAddSupplement()
    {
        $this->addingSupplement = true;
        $this->newSupplement = ['nom' => '', 'type' => 'supplement'];
    }

    public function saveSupplement()
    {
        $this->validate([
            'newSupplement.nom' => 'required|string|max:255'
        ]);
        
        Item::create([
            'nom' => $this->newSupplement['nom'],
            'type' => 'supplement'
        ]);

        $this->addingSupplement = false;
        $this->newSupplement = ['nom' => '', 'type' => 'supplement'];
        session()->flash('message', 'Supplément ajouté avec succès.');
    }

    public function cancelAddSupplement()
    {
        $this->addingSupplement = false;
        $this->newSupplement = ['nom' => '', 'type' => 'supplement'];
    }

    public function editSupplementRow($id)
    {
        $supplement = Item::find($id);
        if ($supplement) {
            $this->editingSupplementId = $id;
            $this->editSupplement = ['id' => $id, 'nom' => $supplement->nom];
        }
    }

    public function updateSupplement()
    {
        $this->validate(['editSupplement.nom' => 'required|string|max:255']);
        
        $supplement = Item::find($this->editSupplement['id']);
        if ($supplement) {
            $supplement->update(['nom' => $this->editSupplement['nom']]);
            session()->flash('message', 'Supplément modifié avec succès.');
        }
        
        $this->editingSupplementId = null;
        $this->editSupplement = ['id' => null, 'nom' => ''];
    }

    public function cancelEditSupplement()
    {
        $this->editingSupplementId = null;
        $this->editSupplement = ['id' => null, 'nom' => ''];
    }

    public function confirmDeleteSupplement($id)
    {
        $this->confirmDelete($id, 'supplement');
    }

    // Doublure Methods
    public function startAddDoublure()
    {
        $this->addingDoublure = true;
        $this->newDoublure = ['nom' => '', 'type' => 'doublure'];
        $this->doublureImage = null;
    }

    public function saveDoublure()
    {
        $this->validate([
            'newDoublure.nom' => 'required|string|max:255',
            'doublureImage' => 'nullable|image|max:2048'
        ]);
        
        $item = Item::create([
            'nom' => $this->newDoublure['nom'],
            'type' => 'doublure'
        ]);

        // Handle image upload
        if ($this->doublureImage) {
            $item->addMedia($this->doublureImage, 'images');
        }

        $this->addingDoublure = false;
        $this->newDoublure = ['nom' => '', 'type' => 'doublure'];
        $this->doublureImage = null;
        session()->flash('message', 'Doublure ajoutée avec succès.');
    }

    public function cancelAddDoublure()
    {
        $this->addingDoublure = false;
        $this->newDoublure = ['nom' => '', 'type' => 'doublure'];
        $this->doublureImage = null;
    }

    public function editDoublureRow($id)
    {
        $doublure = Item::find($id);
        if ($doublure) {
            $this->editingDoublureId = $id;
            $this->editDoublure = [
                'id' => $id, 
                'nom' => $doublure->nom
            ];
            $this->editDoublureImage = null;
        }
    }

    public function updateDoublure()
    {
        $this->validate([
            'editDoublure.nom' => 'required|string|max:255',
            'editDoublureImage' => 'nullable|image|max:2048'
        ]);
        
        $doublure = Item::find($this->editDoublure['id']);
        if ($doublure) {
            $doublure->update([
                'nom' => $this->editDoublure['nom']
            ]);
            
            // Handle image upload
            if ($this->editDoublureImage) {
                $doublure->clearMediaCollection('images');
                $doublure->addMedia($this->editDoublureImage, 'images');
            }
            
            session()->flash('message', 'Doublure modifiée avec succès.');
        }
        
        $this->editingDoublureId = null;
        $this->editDoublure = ['id' => null, 'nom' => ''];
        $this->editDoublureImage = null;
    }

    public function cancelEditDoublure()
    {
        $this->editingDoublureId = null;
        $this->editDoublure = ['id' => null, 'nom' => ''];
        $this->editDoublureImage = null;
    }

    public function confirmDeleteDoublure($id)
    {
        $this->confirmDelete($id, 'doublure');
    }

    public function confirmDelete($id, $type)
    {
        $this->itemToDelete = $id;
        $this->deleteType = $type;
        $this->showDeleteConfirmation = true;
    }

    public function cancelDelete()
    {
        $this->reset(['showDeleteConfirmation', 'itemToDelete', 'deleteType']);
    }

    public function executeDelete()
    {
        if ($this->deleteType === 'cuir') {
            $this->deleteCuir();
        } elseif ($this->deleteType === 'doublure') {
            $this->deleteDoublure();
        } elseif ($this->deleteType === 'supplement') {
            $this->deleteSupplement();
        }
        
        $this->reset(['showDeleteConfirmation', 'itemToDelete', 'deleteType']);
    }

    public function deleteCuir()
    {
        $cuir = Item::find($this->itemToDelete);
        if ($cuir) {
            $cuir->delete();
            session()->flash('message', 'Cuir supprimé avec succès.');
        }
    }

    public function deleteSupplement()
    {
        $supplement = Item::find($this->itemToDelete);
        if ($supplement) {
            $supplement->delete();
            session()->flash('message', 'Supplément supprimé avec succès.');
        }
    }

    public function deleteDoublure()
    {
        $doublure = Item::find($this->itemToDelete);
        if ($doublure) {
            $doublure->delete();
            session()->flash('message', 'Doublure supprimée avec succès.');
        }
    }

    public function render()
    {
        $cuirs = Item::where('type', 'cuir')
            ->where('nom', 'like', '%' . $this->searchCuir . '%')
            ->orderBy('nom')
            ->paginate(10, ['*'], 'cuirsPage');

        $supplements = Item::where('type', 'supplement')
            ->where('nom', 'like', '%' . $this->searchSupplement . '%')
            ->orderBy('nom')
            ->paginate(10, ['*'], 'supplementsPage');

        $doublures = Item::where('type', 'doublure')
            ->where('nom', 'like', '%' . $this->searchDoublure . '%')
            ->orderBy('nom')
            ->paginate(10, ['*'], 'doubluresPage');

        return view('livewire.cuirs-supplements', compact('cuirs', 'supplements', 'doublures'))
            ->layout('layouts.app');
    }
}
