<?php

namespace Packages\Villa\src\Http\Livewire\Home;

use Livewire\Component;
use Packages\Villa\src\Models\Residence;

class ReservePage extends Component
{
    public string $name = '';
    public string $family = '';
    public string $phone = '';
    public $url = null;
    public Residence $residence;




    public function render()
    {
        dd($this->residence);
        return view('Villa::Livewire.Home.reservePage', compact('residences'));
    }
}
