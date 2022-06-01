<?php

namespace Packages\Villa\src\Http\Livewire\Admin;


use Livewire\Component;
use Packages\Villa\src\Models\Residence;
use Packages\Villa\src\Models\ResidenceDate;
use Packages\Villa\src\Models\ResidenceReserve;

class PriceManagement extends Component
{
    public Residence $residence;
    public int|null $currentMonth = null;
    public int|null $currentYear = null;
    public $residenceData = [];
    public $calendarRequest = [];
    public string $name = '';
    public string $family = '';
    public string $phone = '';
    public $dayIn = null;
    public $dayOut = null;
    public $price = '';
    public array $datesSelected = [];
    public $calenderData;
    public $months = null;
    public $selectType = '1';
    public $additionalPrice = 0;
    public function mount()
    {
        $this->months = collect([
            array('id' => 1, 'text' => 'فروردین'),
            array('id' => 2, 'text' => 'اردیبهشت'),
            array('id' => 3, 'text' => 'خرداد'),
            array('id' => 4, 'text' => 'تیر'),
            array('id' => 5, 'text' => 'مرداد'),
            array('id' => 6, 'text' => 'شهریور'),
            array('id' => 7, 'text' => 'مهر'),
            array('id' => 8, 'text' => 'آبان'),
            array('id' => 9, 'text' => 'آذر'),
            array('id' => 10, 'text' => 'دی'),
            array('id' => 11, 'text' => 'بهمن'),
            array('id' => 12, 'text' => 'اسفند'),
        ]);
    }

    public function render()
    {
    $this->fillCalendarRequest();
//        dd($this->residenceData);
// $this->additionalPrice = $this->residence->specifications['additionalPrice'];

        return view('Villa::Livewire.Admin.priceManagmentPage');
    }


    public function getAllReservations()
    {

        $allDatesReserved = [];
        $calenderReservesSource = ResidenceReserve::query()->where('residence_id', $this->residence->id)->where('status_id',4)->get();
        foreach ($calenderReservesSource as $date) {
            $dates = $this->getBetweenDates($date['checkIn'], $date['checkOut']);
            foreach ($dates as $index => $y) {
                if ($index !== count($dates) - 1) {
                    array_push($allDatesReserved, $y);
                }
            }
        }
        return $allDatesReserved;
    }

    public function getCalendarResidencePrices()
    {
        return ResidenceDate::query()->where('residence_id', $this->residence->id)->get();
    }

    public function fillCalendarRequest()
    {
        $this->calendarRequest = [];
        foreach ($this->getCalendarResidencePrices() as $item) {
            array_push($this->calendarRequest,
                [
                    'date' => jdate($item->date)->format('Y-m-d'),
                    'items' => [
                    'price' => $item->price,
                    'isReserved' => in_array($item->date, $this->getAllReservations())
                    ]
                ]);
        }
    }


    public function getCalender($data = [])
    {
        $req = [
            'year' => $this->currentYear,
            'month' => $this->currentMonth,
            'minDate' => jdate()->format('Y-m-d'),
            'maxDate' => null,
            'format ' => 15,
            'data' => $data
        ];
        return json_encode(apiService()->getCalender($req));
    }


    public function previousMonth()
    {
        if ($this->currentMonth === 1) {
            $this->currentYear = $this->currentYear - 1;
            $this->currentMonth = 12;
        } else {
            $this->currentMonth = $this->currentMonth - 1;
        }

    }

    public function itemClicked($date)
    {
        $item = $this->data->firstWhere('id', $currentMonth ?? 1)['text'];
    }

    public function nextMonth()
    {
        if ($this->currentMonth === 12) {
            $this->currentYear = $this->currentYear + 1;
            $this->currentMonth = 1;
        } else {
            $this->currentMonth = $this->currentMonth + 1;
        }
    }


    public function getDates($date1, $date2)
    {
        if ($date1 && $date2) {
            $this->datesSelected = [];
            $this->dayIn = $date1;
            $this->dayOut = $date2;
            $dates = $this->getBetweenDates($this->dayIn['dateEn'], $this->dayOut['dateEn']);
            foreach ($dates as $d) {
                if($this->getItemByDateEn($d)){
                    array_push($this->datesSelected, $this->getItemByDateEn($d));
                }
            }
        }
        return json_encode($this->datesSelected);
    }

    public function addDateToList($date) {
        if (in_array($date,$this->datesSelected)) {

            $index = collect($this->datesSelected)->search(function ($item) use($date) {
                return $item['dateEn'] == $date['dateEn'];
            });
            array_splice($this->datesSelected , $index , 1);
        }else {
            array_push($this->datesSelected, $this->getItemByDateEn($date['dateEn']));
        }
        return json_encode($this->datesSelected);
    }

    public function getItemByDateEn($dateEn)
    {
        foreach ($this->calenderData['dates'] as $item) {
            if ($item['dateEn'] === $dateEn) {
                return $item;
            }
        }
    }


    function removeSelection()
    {
        $this->datesSelected = [];
        $this->name = '';
        $this->family = '';
        $this->phone = '';
        $this->dayIn = null;
        $this->dayOut = null;
    }

    public function getTotalPrice()
    {
        $total = 0;
        for ($i = 0; $i < count($this->datesSelected) - 1; $i++) {
            $total += $this->datesSelected[$i]['data'][0]['price'];
        }
        return $total;
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

    public function additionalSubmit() {
        // dd($this->residence->specifications['additionalPrice']);
        // dd(array_merge($this->additionalPrice , ['additionalPrice' => $this->additionalPrice]));
        $this->residence->specifications = array_merge( $this->residence->specifications , ['additionalPrice' => $this->additionalPrice]);
        $this->residence->save();
        $this->dispatchBrowserEvent('message', ['message' => 'قیمت فرد افزایشی شما ثبت شد.', 'btnCText' => 'باشه',  'btnCAText' => 'بستن']);

    }
    public function submit()
    {

        if ($this->price !== '') {
            foreach ($this->datesSelected as $itemIndex) {
                ResidenceDate::query()->create([
                    'date' => $itemIndex['dateEn'],
                    'residence_id' => $this->residence->id,
                    'price' => $this->price
                ]);
            }
            $this->fillCalendarRequest();

            session()->flash('message', ['title' => 'قیمت شما ثبت شد', 'icon' => 'success']);
            $this->removeSelection();
            $this->dispatchBrowserEvent('send-data', $this->getCalender($this->calendarRequest));
        } else {
            dd('قیمت را وارد نکرده اید');
        }
    }


}
