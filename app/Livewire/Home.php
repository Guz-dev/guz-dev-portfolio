<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public string|null $selected = null;

    public function openModal(string $key)
    {
        $this->selected = $key;
    }

    public function closeModal()
    {
        $this->selected = null;
    }
    public function render()
    {
        return view('livewire.home');
    }
}
