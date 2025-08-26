<?php

namespace App\Livewire;

use Livewire\Component;

class ArticleManagement extends Component
{
    public function render()
    {
        return view('livewire.article-management')->layout('layouts.app');
    }
}
