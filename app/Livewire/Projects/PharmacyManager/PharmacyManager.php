<?php

namespace App\Livewire\Projects\PharmacyManager;

use Livewire\Component;

class PharmacyManager extends Component
{
    public $currentIndex = 0;

    public function previous()
    {
        $this->currentIndex = ($this->currentIndex - 1 + 7) % 7;
    }

    public function next()
    {
        $this->currentIndex = ($this->currentIndex + 1) % 7;
    }

    public function render()
    {
        return view('livewire.projects.pharmacy-manager.pharmacy-manager');
    }
}
