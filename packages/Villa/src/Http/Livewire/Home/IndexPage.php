<?php

namespace Packages\Villa\src\Http\Livewire\Home;

use Livewire\Component;
use Packages\Villa\src\Models\Residence;

class IndexPage extends Component
{
    public string $citySelected = '';

    public ?string $startDate = null;

    public ?string $endDate = null;

    public function render()
    {
        $residences = Residence::query()->where('status_id', 1)->get();
        return view('Villa::Livewire.Home.indexPage', compact('residences'));
    }

    public function submit()
    {
        return redirect(route('list' , ['city' => $this->citySelected , 'start' => $this->startDate , 'end' => $this->endDate]));
    }
}
