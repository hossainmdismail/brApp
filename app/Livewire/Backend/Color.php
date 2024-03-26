<?php

namespace App\Livewire\Backend;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Color extends Component
{
    #[Validate('required')]
    public $name = null;
    #[Validate('required')]
    public $code = null;


    public function save()
    {
        $this->validate();
        $this->dispatch('stayModal');
    }

    public function render()
    {
        return view('livewire.backend.color');
    }
}