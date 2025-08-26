<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserManagement extends Component
{
    use WithPagination;

    public $showModal = false;
    public $editingUser = false;
    public $userId;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    
    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email' . ($this->userId ? ',' . $this->userId : ''),
        ];

        if (!$this->editingUser || $this->password) {
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        return $rules;
    }

    public function updatedSearch()
    {
        $this->resetPage();
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

    public function openModal()
    {
        $this->reset(['userId', 'name', 'email', 'password', 'password_confirmation']);
        $this->editingUser = false;
        $this->showModal = true;
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->editingUser = true;
        $this->showModal = true;
    }

    public function saveUser()
    {
        $this->validate();

        if ($this->editingUser) {
            $user = User::findOrFail($this->userId);
            $user->name = $this->name;
            $user->email = $this->email;
            if ($this->password) {
                $user->password = Hash::make($this->password);
            }
            $user->save();
            session()->flash('success', 'User updated successfully.');
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
            session()->flash('success', 'User created successfully.');
        }

        $this->showModal = false;
        $this->reset(['userId', 'name', 'email', 'password', 'password_confirmation']);
    }

    public function deleteUser($id)
    {
        if ($id == auth()->id()) {
            session()->flash('error', 'You cannot delete your own account.');
            return;
        }

        User::findOrFail($id)->delete();
        session()->flash('success', 'User deleted successfully.');
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.user-management', compact('users'))
            ->layout('layouts.app');
    }
}
