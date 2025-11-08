<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class FormesArticles extends Component
{
    use WithPagination, WithFileUploads;

    // Search and filtering
    public $searchForme = '';
    public $searchArticle = '';
    public $selectedFormeId = null;
    public $selectedFormeName = '';

    // Add/Edit states
    public $addingForme = false;
    public $editingFormeId = null;
    public $addingArticle = false;
    public $editingArticleId = null;

    // Form data for Forme
    public $newForme = ['nom' => ''];
    public $editForme = ['nom' => ''];
    public $formeImage = null;
    public $editFormeImage = null;

    // Form data for Article
    public $newArticle = ['nom' => '', 'parent_id' => null];
    public $editArticle = ['nom' => '', 'parent_id' => null];
    public $articleImage = null;
    public $editArticleImage = null;

    // Delete confirmation
    public $showDeleteConfirmation = false;
    public $deleteType = null;
    public $deleteId = null;

    protected $rules = [
        'newForme.nom' => 'required|string|max:255',
        'editForme.nom' => 'required|string|max:255',
        'newArticle.nom' => 'required|string|max:255',
        'newArticle.parent_id' => 'required|exists:items,id',
        'editArticle.nom' => 'required|string|max:255',
        'editArticle.parent_id' => 'required|exists:items,id',
        'formeImage' => 'nullable|image|max:2048',
        'editFormeImage' => 'nullable|image|max:2048',
        'articleImage' => 'nullable|image|max:2048',
        'editArticleImage' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'newForme.nom.required' => 'Le nom de la forme est obligatoire.',
        'editForme.nom.required' => 'Le nom de la forme est obligatoire.',
        'newArticle.nom.required' => 'Le nom de l\'article est obligatoire.',
        'newArticle.parent_id.required' => 'Veuillez sélectionner une forme.',
        'editArticle.nom.required' => 'Le nom de l\'article est obligatoire.',
        'editArticle.parent_id.required' => 'Veuillez sélectionner une forme.',
    ];

    public function render()
    {
        $formes = Item::where('type', 'forme')
            ->when($this->searchForme, function($query) {
                $query->where('nom', 'like', '%' . $this->searchForme . '%');
            })
            ->orderBy('nom')
            ->paginate(10, ['*'], 'formesPage');

        // Get articles - filtered by selected forme if any
        $articlesQuery = Item::where('type', 'article')
            ->with('parent');

        if ($this->selectedFormeId) {
            $articlesQuery->where('parent_id', $this->selectedFormeId);
        }

        if ($this->searchArticle) {
            $articlesQuery->where('nom', 'like', '%' . $this->searchArticle . '%');
        }

        $articles = $articlesQuery->orderBy('nom')
            ->paginate(10, ['*'], 'articlesPage');

        $availableFormes = Item::where('type', 'forme')->orderBy('nom')->get();

        return view('livewire.formes-articles', [
            'formes' => $formes,
            'articles' => $articles,
            'availableFormes' => $availableFormes,
        ])->layout('layouts.app');
    }

    // Forme Methods
    public function startAddForme()
    {
        $this->addingForme = true;
        $this->newForme = ['nom' => ''];
        $this->formeImage = null;
    }

    public function saveForme()
    {
        $this->validate([
            'newForme.nom' => 'required|string|max:255',
            'formeImage' => 'nullable|image|max:2048',
        ]);

        $forme = Item::create([
            'nom' => $this->newForme['nom'],
            'type' => 'forme',
        ]);

        if ($this->formeImage) {
            $forme->addMedia($this->formeImage, 'images');
        }

        $this->addingForme = false;
        $this->newForme = ['nom' => ''];
        $this->formeImage = null;

        session()->flash('message', 'Forme ajoutée avec succès!');
    }

    public function cancelAddForme()
    {
        $this->addingForme = false;
        $this->newForme = ['nom' => ''];
        $this->formeImage = null;
    }

    public function editFormeRow($formeId)
    {
        $forme = Item::findOrFail($formeId);
        $this->editingFormeId = $formeId;
        $this->editForme = ['nom' => $forme->nom];
        $this->editFormeImage = null;
    }

    public function updateForme()
    {
        $this->validate([
            'editForme.nom' => 'required|string|max:255',
            'editFormeImage' => 'nullable|image|max:2048',
        ]);

        $forme = Item::findOrFail($this->editingFormeId);
        $forme->update(['nom' => $this->editForme['nom']]);

        if ($this->editFormeImage) {
            $forme->clearMediaCollection('images');
            $forme->addMedia($this->editFormeImage, 'images');
        }

        $this->editingFormeId = null;
        $this->editForme = ['nom' => ''];
        $this->editFormeImage = null;

        session()->flash('message', 'Forme modifiée avec succès!');
    }

    public function cancelEditForme()
    {
        $this->editingFormeId = null;
        $this->editForme = ['nom' => ''];
        $this->editFormeImage = null;
    }

    public function filterByForme($formeId)
    {
        if ($this->selectedFormeId === $formeId) {
            // If clicking the same forme, clear the filter
            $this->selectedFormeId = null;
            $this->selectedFormeName = '';
        } else {
            // Set the filter
            $forme = Item::find($formeId);
            $this->selectedFormeId = $formeId;
            $this->selectedFormeName = $forme ? $forme->nom : '';
        }
        $this->resetPage('articlesPage');
    }

    // Article Methods
    public function startAddArticle()
    {
        $this->addingArticle = true;
        $this->newArticle = ['nom' => '', 'parent_id' => $this->selectedFormeId];
        $this->articleImage = null;
    }

    public function saveArticle()
    {
        $this->validate([
            'newArticle.nom' => 'required|string|max:255',
            'newArticle.parent_id' => 'required|exists:items,id',
            'articleImage' => 'nullable|image|max:2048',
        ]);

        $article = Item::create([
            'nom' => $this->newArticle['nom'],
            'type' => 'article',
            'parent_id' => $this->newArticle['parent_id'],
        ]);

        if ($this->articleImage) {
            $article->addMedia($this->articleImage, 'images');
        }

        $this->addingArticle = false;
        $this->newArticle = ['nom' => '', 'parent_id' => null];
        $this->articleImage = null;

        session()->flash('message', 'Article ajouté avec succès!');
    }

    public function cancelAddArticle()
    {
        $this->addingArticle = false;
        $this->newArticle = ['nom' => '', 'parent_id' => null];
        $this->articleImage = null;
    }

    public function editArticleRow($articleId)
    {
        $article = Item::findOrFail($articleId);
        $this->editingArticleId = $articleId;
        $this->editArticle = [
            'nom' => $article->nom,
            'parent_id' => $article->parent_id,
        ];
        $this->editArticleImage = null;
    }

    public function updateArticle()
    {
        $this->validate([
            'editArticle.nom' => 'required|string|max:255',
            'editArticle.parent_id' => 'required|exists:items,id',
            'editArticleImage' => 'nullable|image|max:2048',
        ]);

        $article = Item::findOrFail($this->editingArticleId);
        $article->update([
            'nom' => $this->editArticle['nom'],
            'parent_id' => $this->editArticle['parent_id'],
        ]);

        if ($this->editArticleImage) {
            $article->clearMediaCollection('images');
            $article->addMedia($this->editArticleImage, 'images');
        }

        $this->editingArticleId = null;
        $this->editArticle = ['nom' => '', 'parent_id' => null];
        $this->editArticleImage = null;

        session()->flash('message', 'Article modifié avec succès!');
    }

    public function cancelEditArticle()
    {
        $this->editingArticleId = null;
        $this->editArticle = ['nom' => '', 'parent_id' => null];
        $this->editArticleImage = null;
    }

    // Delete Methods
    public function confirmDeleteForme($formeId)
    {
        $forme = Item::findOrFail($formeId);
        
        // Check if forme has articles
        if ($forme->children()->count() > 0) {
            session()->flash('error', 'Impossible de supprimer cette forme car elle contient des articles.');
            return;
        }

        $this->showDeleteConfirmation = true;
        $this->deleteType = 'forme';
        $this->deleteId = $formeId;
    }

    public function confirmDeleteArticle($articleId)
    {
        $this->showDeleteConfirmation = true;
        $this->deleteType = 'article';
        $this->deleteId = $articleId;
    }

    public function executeDelete()
    {
        if ($this->deleteId) {
            $item = Item::findOrFail($this->deleteId);
            $item->delete();
            
            session()->flash('message', ucfirst($this->deleteType) . ' supprimé(e) avec succès!');
        }

        $this->cancelDelete();
    }

    public function cancelDelete()
    {
        $this->showDeleteConfirmation = false;
        $this->deleteType = null;
        $this->deleteId = null;
    }

    // Search methods
    public function updatedSearchForme()
    {
        $this->resetPage('formesPage');
    }

    public function updatedSearchArticle()
    {
        $this->resetPage('articlesPage');
    }
}
