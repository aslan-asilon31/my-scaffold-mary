<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class Navbar extends Component
{
  public int $cartCounter = 0;

  public function render()
  {



    return view('livewire.partials.navbar');
  }
}
