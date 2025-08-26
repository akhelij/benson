<?php

namespace App\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class ClientManagement extends Component
{
    use WithPagination;

    public $showModal = false;
    public $editingClient = null;
    public $search = '';
    public $searchCriteria = 'nom';
    
    // Client form fields
    public $nom = '';
    public $telephone = '';
    public $email = '';
    public $adresse = '';
    public $ville = '';
    public $pays = '';

    protected $rules = [
        'nom' => 'required|string|max:100',
        'telephone' => 'required|string|max:100',
        'email' => 'required|email|max:100',
        'adresse' => 'required|string',
        'ville' => 'required|string|max:100',
        'pays' => 'required|string|max:110',
    ];

    protected $messages = [
        'nom.required' => 'Le nom est obligatoire.',
        'telephone.required' => 'Le téléphone est obligatoire.',
        'email.required' => 'L\'email est obligatoire.',
        'email.email' => 'L\'email doit être valide.',
        'adresse.required' => 'L\'adresse est obligatoire.',
        'ville.required' => 'La ville est obligatoire.',
        'pays.required' => 'Le pays est obligatoire.',
    ];

    public function render()
    {
        $clients = Client::when($this->search, function($query) {
                $searchTerm = '%' . $this->search . '%';
                switch($this->searchCriteria) {
                    case 'nom':
                        return $query->where('nom', 'like', $searchTerm);
                    case 'telephone':
                        return $query->where('telephone', 'like', $searchTerm);
                    case 'email':
                        return $query->where('email', 'like', $searchTerm);
                    case 'ville':
                        return $query->where('ville', 'like', $searchTerm);
                    case 'pays':
                        return $query->where('pays', 'like', $searchTerm);
                    default:
                        return $query->where('nom', 'like', $searchTerm);
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.client-management', [
            'clients' => $clients
        ])->layout('layouts.app');
    }

    public function createClient()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function editClient($clientId)
    {
        $client = Client::findOrFail($clientId);
        $this->editingClient = $client;
        
        $this->nom = $client->nom;
        $this->telephone = $client->telephone;
        $this->email = $client->email;
        $this->adresse = $client->adresse;
        $this->ville = $client->ville;
        $this->pays = $client->pays;
        
        $this->showModal = true;
    }

    public function saveClient()
    {
        $this->validate();

        $clientData = [
            'nom' => $this->nom,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'adresse' => $this->adresse,
            'ville' => $this->ville,
            'pays' => $this->pays,
        ];

        if ($this->editingClient) {
            $this->editingClient->update($clientData);
            session()->flash('message', 'Client modifié avec succès!');
        } else {
            Client::create($clientData);
            session()->flash('message', 'Client ajouté avec succès!');
        }

        $this->resetForm();
        $this->showModal = false;
    }

    public function deleteClient($clientId)
    {
        Client::findOrFail($clientId)->delete();
        session()->flash('message', 'Client supprimé avec succès!');
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
        $this->editingClient = null;
        $this->nom = '';
        $this->telephone = '';
        $this->email = '';
        $this->adresse = '';
        $this->ville = '';
        $this->pays = '';
        $this->resetErrorBag();
    }
}
