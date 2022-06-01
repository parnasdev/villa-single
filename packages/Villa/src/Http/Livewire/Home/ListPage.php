<?php

namespace Packages\Villa\src\Http\Livewire\Home;

use Livewire\Component;
use Packages\Villa\src\Models\Residence;
use Carbon\Carbon;

class ListPage extends Component
{
    public $url = null;
    public $city = null;
    public $startDate = null;
    public $endDate = null;
    protected $queryString = [
        'city' => ['except' => null],
        'startDate' => ['except' => null, 'as' => 'start'],
        'endDate' => ['except' => null, 'as' => 'end']
    ];


    public function render()
    {
        if ($this->startDate && $this->endDate) {
            if ($this->city) {
                $residences = Residence::query()->where('status_id', 1)->where('city_id', $this->city)->get();

            } else {
                $residences = Residence::query()->where('status_id', 1)->get();
            }
            $residences = $residences->map(function (Residence $residence) {
                if (in_array(Carbon::parse($this->startDate)->format('Y-m-d'), $residence->residenceDates()->pluck('date')->toArray())
                    && in_array(Carbon::parse($this->endDate)->format('Y-m-d'), $residence->residenceDates()->pluck('date')->toArray())
                    && (
                        $residence->residenceReserves()->where('checkIn', Carbon::parse($this->startDate)->format('Y-m-d'))
                        ->where('checkOut', Carbon::parse($this->endDate)->format('Y-m-d'))
                        ->where('status_id', 4)->get()->isEmpty()
                    )) {
                    return $residence;
                }
            })->filter(function ($value) {
                return $value != null;
            });

        } else {
            if ($this->city) {
                $residences = Residence::query()->where('status_id', 1)->where('city_id', $this->city)->get();
            } else {
                $residences = Residence::query()->where('status_id', 1)->get();

            }
        }


        return view('Villa::Livewire.Home.listPage', compact('residences'));
    }
}
