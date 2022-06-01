<?php

namespace Packages\Villa\src\Http\Livewire\Home;

use App\Models\City;
use App\Models\Province;
use Livewire\Component;
use Packages\Villa\src\Models\Residence;
use Packages\Villa\src\Models\ResidenceDate;
use Packages\Villa\src\Models\ResidenceFile;
use Packages\Villa\src\Models\ResidenceReserve;

class InfoPage extends Component
{
    public Residence $residence;
    public int|null $currentMonth = null;
    public int|null $currentYear = null;
    public array $residenceData = [];
    public array $calendarRequest = [];
    public string $name = '';
    public string $family = '';
    public string $phone = '';
    public int $count = 0;
    public int $step = 1;
    public $dayIn = null;
    public $dayOut = null;
    public array $datesSelected = [];
    public $calenderData;
    public $months = null;
    public $additionalCount = 0;




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
        $province = Province::query()->where('id', $this->residence->province_id)->get();
        $files = ResidenceFile::query()->where('residence_id', $this->residence->id)->get();
        $cities = City::query()->where('province_id', $this->residence->province_id)->get();
        $city = $cities->where('id', $this->residence->city_id);
        $this->fillCalendarRequest();
        return view('Villa::Livewire.Home.infoPage', compact('province', 'city', 'files'));
    }

    public function getAllReservations()
    {
        $allDatesReserved = [];
        $calenderReservesSource = ResidenceReserve::query()->where('residence_id', $this->residence->id)->where('status_id', 4)->get();
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
            array_push(
                $this->calendarRequest,
                [
                    'date' => jdate($item->date)->format('Y-m-d'),
                    'items' => [
                        'price' => $item->price,
                        'isReserved' => in_array($item->date, $this->getAllReservations())
                    ]
                ]
            );
        }
        //        dd($this->calendarRequest);

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

            $this->datesSelected = $this->getBetweenDates($this->dayIn, $this->dayOut);
        }
        return json_encode($this->datesSelected);
    }

    // public function getItemByDateEn($dateEn)
    // {
    //     foreach ($this->calenderData['dates'] as $item) {
    //         if ($item['dateEn'] === $dateEn) {
    //             return $item;
    //         }
    //     }
    // }


    public function submit()
    {
        if (count($this->datesSelected) > 0) {
            ResidenceReserve::query()->create([
                'residence_id' => $this->residence->id,
                'checkIn' => $this->datesSelected[0],
                'checkOut' => $this->datesSelected[count($this->datesSelected) - 1],
                'totalPrice' => $this->getTotalPrice(),
                'user_id' => user()->id,
                'name' => $this->name,
                'count' => (int)$this->count,
                'family' => $this->family,
                'phone' => $this->phone,
                'status_id' => 6,
            ]);
            $this->fillCalendarRequest();
            $this->dispatchBrowserEvent('message', ['message' => 'درخواست رزرو شما ارسال شد تا تایید ادمین منتظر باشید', 'btnCText' => 'باشه',  'btnCAText' => 'بستن']);
            $this->removeSelection();
            $this->dispatchBrowserEvent('send-data', $this->getCalender($this->calendarRequest));
        } else {
            dd('لطفا روزهای خود را انتخاب کنید.');
        }
    }


    public function getViewMode($label)
    {
        return in_array($label, $this->residence->specifications['view']);
    }


    function removeSelection()
    {
        $this->datesSelected = [];
        $this->name = '';
        $this->family = '';
        $this->phone = '';
        $this->count = 0;
        $this->dayIn = null;
        $this->dayOut = null;
    }

    public function getTotalPrice()
    {
        $total = 0;
        for ($i = 0; $i < count($this->datesSelected) - 1; $i++) {
            // $total += $this->datesSelected[$i]['data'][0]['price'];
            $total += $this->getPrice($this->datesSelected[$i])[count($this->getPrice($this->datesSelected[$i])) - 1]['price'];
        }

        return $total + $this->getTotalAdditionalPrice();
    }

    public function updated($name)
    {
        if ($name == 'count') {
            $this->getTotalAdditionalPrice();
        }
    }

    public function getTotalAdditionalPrice()
    {
        $total = 0;
        $this->additionalCount = 0;
        if ($this->count > 0 && ($this->count > $this->residence->capacity)) {
            for ($i = $this->residence->capacity + 1; $i <= $this->count; $i++) {
                $this->additionalCount += 1;
                $total += $this->residence->specifications['additionalPrice'];
            }
        }
        return $total;
    }

    public function getBetweenDates($startDate, $endDate)
    {
        $rangArray = [];

        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        for (
            $currentDate = $startDate;
            $currentDate <= $endDate;
            $currentDate += (86400)
        ) {

            $date = date('Y-m-d', $currentDate);
            $rangArray[] = $date;
        }
        return $rangArray;
    }


    public function getDateFA($date)
    {
        return jdate($date)->format('Y-m-d');
    }


    public function getPrice($date)
    {
        return ResidenceDate::query()->where('date', $date)->get('price');
    }

    public function checkIsReserve($date)
    {
        return in_array($date, $this->getAllReservations());
    }


    public function nextStep() {
        if(auth()->user()){
            $this->step = 2;
        }else {
            return redirect(route('login' , ['referrer-url' => url('/info/'. $this->residence->id)]));

        }
    }

    public function previoesStep() {
        $this->step = 2;
    }
}
