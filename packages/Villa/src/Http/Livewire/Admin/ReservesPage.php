<?php

namespace Packages\Villa\src\Http\Livewire\Admin;

use App\Models\Status;
use Livewire\Component;
use Packages\Villa\src\Models\Residence;
use Packages\Villa\src\Models\ResidenceReserve;

class ReservesPage extends Component
{
    public ?string $model = null;
    public int $residence_id = 1;

    public function mount()
    {
        $this->model = 'Packages\Villa\src\Models\Residence';
    }

    public function render()
    {
        $reserves = ResidenceReserve::query()->whereHas('residence', function($query){
            $query->where('user_id', user()->id);
        })->get();
        $statuses = Status::query()->where('type', 2)->get();
//        $statuses = Status::query()->get();

        return view('Villa::Livewire.Admin.ReservesPage', compact('reserves', 'statuses'));
    }


    public function changeStatus($id, $status)
    {
        ResidenceReserve::find($id)->update([
            'status_id' => $status
        ]);

        $this->dispatchBrowserEvent('toastMessage', ['message' => 'وضعیت تغییر کرد.', 'icon' => 'success']);
    }
    public function getVillaTitle($residence_id) {
        return Residence::query()->where('id',$residence_id)->get('title')->first()?->title;
    }
}
