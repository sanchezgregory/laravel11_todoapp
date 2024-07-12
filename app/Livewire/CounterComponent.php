<?php

namespace App\Livewire;

use Livewire\Component;

class CounterComponent extends Component
{
    public int $cont =10;
    public function render()
    {
        return view('livewire.counter-component');
    }

    public function increment()
    {
        $this->cont++;
    }

    public function decrement()
    {
        $this->cont--;
    }
}
