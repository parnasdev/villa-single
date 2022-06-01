<?php

namespace Packages\Villa\src\Http\Livewire\Admin;

use Livewire\Component;
use Packages\Villa\src\Models\ResidenceReserve;

class ReservesPanel extends Component
{

    public function mount()
    {
    }

    public function render()
    {
        $reserves =  ResidenceReserve::query()->where('user_id',user()->id)->get();

        return view('Villa::Livewire.admin.reservesPanel',compact('reserves'));
    }
}

