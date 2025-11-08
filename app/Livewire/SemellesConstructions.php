<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class SemellesConstructions extends Component
{
    use WithPagination, WithFileUploads;
    
    // Confirmation properties
    public $showDeleteConfirmation = false;
    public $itemToDelete = null;
    public $deleteType = null; // 'semelle' or 'construction'

    // Image preview
    public $showImagePreview = false;
    public $previewImageUrl = null;

    // Search terms
    public $searchSemelles = '';
    public $searchConstructions = '';
    public $searchDoublure = '';

    // Add/Edit forms data - Semelles
    public $semelleNom = '';
    public $editSemelle = ['nom' => ''];
    public $semelleImage = null;
    public $editSemelleImage = null;
    public $editingSemelleId = null;
    public $addingSemelle = false;

    // Add/Edit forms data - Constructions
    public $constructionNom = '';
    public $editConstruction = ['nom' => ''];
    public $editingConstructionId = null;
    public $addingConstruction = false;

    // Add/Edit forms data - Doublures
    public $newDoublure = ['nom' => ''];
    public $editDoublure = ['nom' => ''];
    public $doublureImage = null;
    public $editDoublureImage = null;
    public $editingDoublureId = null;
    public $addingDoublure = false;

    protected $rules = [
        'semelleNom' => 'required|string|max:255',
        'semelleImage' => 'nullable|image|max:2048',
        'editSemelleImage' => 'nullable|image|max:2048',
        'constructionNom' => 'required|string|max:255',
        'newDoublure.nom' => 'required|string|max:255',
        'editDoublure.nom' => 'required|string|max:255',
        'doublureImage' => 'nullable|image|max:2048',
        'editDoublureImage' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'semelleNom.required' => 'Le nom est requis.',
        'semelleNom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
        'semelleImage.image' => 'Le fichier doit être une image.',
        'semelleImage.max' => 'L\'image ne doit pas dépasser 2MB.',
        'editSemelleImage.image' => 'Le fichier doit être une image.',
        'editSemelleImage.max' => 'L\'image ne doit pas dépasser 2MB.',
        'constructionNom.required' => 'Le nom est requis.',
        'constructionNom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
        'constructionImage.image' => 'Le fichier doit être une image.',
        'constructionImage.max' => 'L\'image ne doit pas dépasser 2MB.',
        'editConstructionImage.image' => 'Le fichier doit être une image.',
        'editConstructionImage.max' => 'L\'image ne doit pas dépasser 2MB.',
        'newDoublure.nom.required' => 'Le nom est requis.',
        'newDoublure.nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
        'editDoublure.nom.required' => 'Le nom est requis.',
        'editDoublure.nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
        'doublureImage.image' => 'Le fichier doit être une image.',
        'doublureImage.max' => 'L\'image ne doit pas dépasser 2MB.',
        'editDoublureImage.image' => 'Le fichier doit être une image.',
        'editDoublureImage.max' => 'L\'image ne doit pas dépasser 2MB.',
    ];

    public function mount()
    {
        // Initialize any necessary data
    }

    // Semelles Methods
    public function startAddingSemelle()
    {
        $this->addingSemelle = true;
        $this->resetSemelleForm();
    }

    public function cancelAddingSemelle()
    {
        $this->addingSemelle = false;
        $this->resetSemelleForm();
    }

    public function saveSemelle()
    {
        $this->validate([
            'semelleNom' => 'required|string|max:255',
            'semelleImage' => 'nullable|image|max:2048',
        ]);

        $semelle = Item::create([
            'type' => 'semelle',
            'nom' => $this->semelleNom,
        ]);

        if ($this->semelleImage) {
            $semelle->addMedia($this->semelleImage, 'images');
        }

        $this->resetSemelleForm();
        $this->resetPage('semellesPage');
        session()->flash('message', 'Semelle ajoutée avec succès.');
    }

    public function editSemelleRow($id)
    {
        $semelle = Item::findOrFail($id);
        $this->editingSemelleId = $id;
        $this->editSemelle = ['nom' => $semelle->nom];
        $this->editSemelleImage = null;
        $this->addingSemelle = false;
    }

    public function updateSemelle()
    {
        $this->validate([
            'editSemelle.nom' => 'required|string|max:255',
            'editSemelleImage' => 'nullable|image|max:2048',
        ]);

        $semelle = Item::findOrFail($this->editingSemelleId);
        $semelle->nom = $this->editSemelle['nom'];
        $semelle->save();

        if ($this->editSemelleImage) {
            $semelle->clearMediaCollection('images');
            $semelle->addMedia($this->editSemelleImage, 'images');
        }

        $this->cancelEditingSemelle();
        session()->flash('message', 'Semelle mise à jour avec succès.');
    }

    public function cancelEditingSemelle()
    {
        $this->editingSemelleId = null;
        $this->resetSemelleForm();
    }

    public function deleteSemelle()
    {
        $item = Item::find($this->itemToDelete);
        if ($item) {
            $item->delete();
            session()->flash('message', 'Semelle supprimée avec succès.');
        }
    }

    // Constructions Methods
    public function startAddingConstruction()
    {
        $this->addingConstruction = true;
        $this->resetConstructionForm();
    }

    public function cancelAddingConstruction()
    {
        $this->addingConstruction = false;
        $this->resetConstructionForm();
    }

    public function saveConstruction()
    {
        $this->validate([
            'constructionNom' => 'required|string|max:255',
        ]);

        $construction = Item::create([
            'type' => 'construction',
            'nom' => $this->constructionNom,
        ]);

        $this->addingConstruction = false;
        $this->resetConstructionForm();
        $this->resetPage('constructionsPage');
        session()->flash('message', 'Construction ajoutée avec succès.');
    }

    public function editConstructionRow($id)
    {
        $construction = Item::findOrFail($id);
        $this->editingConstructionId = $id;
        $this->editConstruction = ['nom' => $construction->nom];
        $this->addingConstruction = false;
    }

    public function updateConstruction()
    {
        $this->validate([
            'editConstruction.nom' => 'required|string|max:255',
        ]);

        $construction = Item::findOrFail($this->editingConstructionId);
        $construction->nom = $this->editConstruction['nom'];
        $construction->save();

        $this->cancelEditingConstruction();
        session()->flash('message', 'Construction mise à jour avec succès.');
    }

    public function cancelEditingConstruction()
    {
        $this->editingConstructionId = null;
        $this->resetConstructionForm();
    }

    public function cancelEditConstruction()
    {
        $this->editingConstructionId = null;
        $this->resetConstructionForm();
    }

    // Doublures Methods
    public function startAddDoublure()
    {
        $this->addingDoublure = true;
        $this->resetDoublureForm();
    }

    public function cancelAddDoublure()
    {
        $this->addingDoublure = false;
        $this->resetDoublureForm();
    }

    public function saveDoublure()
    {
        $this->validate([
            'newDoublure.nom' => 'required|string|max:255',
            'doublureImage' => 'nullable|image|max:2048',
        ]);

        $doublure = Item::create([
            'type' => 'doublure',
            'nom' => $this->newDoublure['nom'],
        ]);

        if ($this->doublureImage) {
            $doublure->addMedia($this->doublureImage, 'images');
        }

        $this->addingDoublure = false;
        $this->resetDoublureForm();
        $this->resetPage('doubluresPage');
        session()->flash('message', 'Doublure ajoutée avec succès.');
    }

    public function editDoublureRow($id)
    {
        $doublure = Item::findOrFail($id);
        $this->editingDoublureId = $id;
        $this->editDoublure = ['nom' => $doublure->nom];
        $this->editDoublureImage = null;
        $this->addingDoublure = false;
    }

    public function updateDoublure()
    {
        $this->validate([
            'editDoublure.nom' => 'required|string|max:255',
            'editDoublureImage' => 'nullable|image|max:2048',
        ]);

        $doublure = Item::findOrFail($this->editingDoublureId);
        $doublure->update([
            'nom' => $this->editDoublure['nom'],
        ]);

        if ($this->editDoublureImage) {
            $doublure->clearMediaCollection('images');
            $doublure->addMedia($this->editDoublureImage, 'images');
        }

        $this->cancelEditDoublure();
        session()->flash('message', 'Doublure mise à jour avec succès.');
    }

    public function cancelEditDoublure()
    {
        $this->editingDoublureId = null;
        $this->resetDoublureForm();
    }

    public function confirmDeleteSemelle($id)
    {
        $this->confirmDelete($id, 'semelle');
    }

    public function confirmDeleteConstruction($id)
    {
        $this->confirmDelete($id, 'construction');
    }

    public function confirmDeleteDoublure($id)
    {
        $this->confirmDelete($id, 'doublure');
    }

    public function deleteDoublure()
    {
        $item = Item::find($this->itemToDelete);
        if ($item) {
            $item->delete();
            session()->flash('message', 'Doublure supprimée avec succès.');
        }
    }

    public function deleteConstruction()
    {
        $item = Item::find($this->itemToDelete);
        if ($item) {
            $item->delete();
            session()->flash('message', 'Construction supprimée avec succès.');
        }
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
        if ($this->deleteType === 'semelle') {
            $this->deleteSemelle();
        } elseif ($this->deleteType === 'construction') {
            $this->deleteConstruction();
        } elseif ($this->deleteType === 'doublure') {
            $this->deleteDoublure();
        }
        
        $this->reset(['showDeleteConfirmation', 'itemToDelete', 'deleteType']);
    }

    private function resetSemelleForm()
    {
        $this->semelleNom = '';
        $this->semelleImage = null;
        $this->editSemelleImage = null;
    }

    private function resetConstructionForm()
    {
        $this->constructionNom = '';
    }

    private function resetDoublureForm()
    {
        $this->newDoublure = ['nom' => ''];
        $this->editDoublure = ['nom' => ''];
        $this->doublureImage = null;
        $this->editDoublureImage = null;
    }

    // Search update methods
    public function updatingSearchSemelles()
    {
        $this->resetPage('semellesPage');
    }

    public function updatingSearchConstructions()
    {
        $this->resetPage('constructionsPage');
    }

    public function updatingSearchDoublure()
    {
        $this->resetPage('doubluresPage');
    }

    // Image methods
    public function deleteSemelleImage($semelleId)
    {
        $semelle = Item::findOrFail($semelleId);
        $semelle->clearMediaCollection('images');
        session()->flash('message', 'Image supprimée avec succès!');
    }

    public function deleteDoublureImage($doublureId)
    {
        $doublure = Item::findOrFail($doublureId);
        $doublure->clearMediaCollection('images');
        session()->flash('message', 'Image supprimée avec succès!');
    }

    public function previewImage($imageUrl)
    {
        $this->previewImageUrl = $imageUrl;
        $this->showImagePreview = true;
    }

    public function closeImagePreview()
    {
        $this->showImagePreview = false;
        $this->previewImageUrl = null;
    }

    public function render()
    {
        $semelles = Item::where('type', 'semelle')
            ->where('nom', 'like', '%' . $this->searchSemelles . '%')
            ->orderBy('nom')
            ->paginate(10, ['*'], 'semellesPage');

        $constructions = Item::where('type', 'construction')
            ->where('nom', 'like', '%' . $this->searchConstructions . '%')
            ->orderBy('nom')
            ->paginate(10, ['*'], 'constructionsPage');

        $doublures = Item::where('type', 'doublure')
            ->where('nom', 'like', '%' . $this->searchDoublure . '%')
            ->orderBy('nom')
            ->paginate(10, ['*'], 'doubluresPage');

        return view('livewire.semelles-constructions', [
            'semelles' => $semelles,
            'constructions' => $constructions,
            'doublures' => $doublures,
        ])->layout('layouts.app');
    }
}
