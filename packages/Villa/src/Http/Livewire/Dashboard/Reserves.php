<?php

namespace Packages\Villa\src\Http\Livewire\Dashboard;

use App\Http\Extra\TableFunction;
use App\Models\Status;
use Packages\Villa\src\Models\Residence;
use Livewire\Component;
use Livewire\WithPagination;
use Packages\Villa\src\Models\ResidenceReserve;

class Reserves extends Component
{

    public function mount()
    {
    }

    public function render()
    {
        $reserves =  ResidenceReserve::query()->where('user_id',user()->id)->get();

        return view('Villa::Livewire.dashboard.reserves',compact('reserves'));
    }
}

