<?php

namespace Packages\Villa\src\Http\Livewire\Admin;

use App\Models\Status;
use Livewire\Component;
use Packages\Villa\src\Models\Residence;
use Packages\Villa\src\Models\ResidenceDate;
use Packages\Villa\src\Models\ResidenceReserve;

class ReserveInfoPanel extends Component
{
    public ResidenceReserve $reserve;
    public function mount()
    {

    }


    public function rules()
    {
        return [
            'reserve.status_id' => ['required'],
        ];
    }

    public function updated($name) {
        if ($name === 'reserve.status_id') {
            $this->reserve->save();
        }
    }

    public function render()
    {
        $statuses = Status::query()->where('type', 2)->get();

        return view('Villa::Livewire.admin.ReserveInfoPanel',compact('statuses'));
    }

    public function getVillaItem($residence_id) {
        return Residence::query()->where('id',$residence_id)->get('title')->first();
    }
    public function getDatePrice($date) {
        return ResidenceDate::query()->where('date',$date)->get('price')->first();
    }



    public function getBetweenDates($startDate, $endDate)
    {
        $rangArray = [];

        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        for ($currentDate = $startDate; $currentDate <= $endDate;
             $currentDate += (86400)) {

            $date = date('Y-m-d', $currentDate);
            $rangArray[] = $date;
        }
        return $rangArray;
    }
}
