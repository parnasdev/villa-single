<?php

namespace Packages\Villa\src\Http\Livewire\Admin;

use App\Models\City;
use App\Models\Province;
use App\Models\Status;
use App\Rules\ControlThumbs;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Packages\Villa\src\Models\Residence;
use Packages\Villa\src\Models\ResidenceFile;


class AddPage extends Component
{
    public Residence $req;
    public Collection $files;
    public $file = [
        'url' => null,
        'alt' => null,
        'type' => null
    ];

    public function rules()
    {
        return [
            'req.title' => ['required', 'string', 'max:100'],
            'req.slug' => ['nullable', 'string', Rule::unique('req', 'slug')],
            'req.province_id' => ['required'],
            'req.user_id' => ['required'],
            'req.city_id' => ['required'],
            'req.residence_owner' => [],
            'req.mobile' => ['required'],
            'req.description' => ['nullable', 'string', 'max:10000'],
            'req.address' => ['required'],
            'req.coordinates' => [],
            'req.building_area' => ['required'],
            'req.land_area' => ['required'],
            'req.capacity' => ['required'],
            'req.maxCapacity' => ['required'],
            'req.twinBed' => ['required'],
            'req.singleBed' => ['required'],
            'req.mattress' => ['required'],
            'req.room_count' => ['required'],
            'req.rules' => ['nullable', 'array'],
            'req.rules.text' => [],
            'req.specifications' => ['nullable', 'array'],
            'req.specifications.type' => ['required'],
            'req.specifications.view' => [],
            'req.specifications.location' => '',
            'req.specifications.paymentType' => '',
            'req.specifications.additionalPrice' => '',
            'req.specifications.facilities' => [],
            'req.status_id' => ['required'],
        ];
    }


    public function mount()
    {
        $this->req = new Residence([
            'title' => '',
            'slug' => '',
            'province_id' => 0,
            'user_id' => 0,
            'city_id' => 1,
            'residence_owner' => '',
            'mobile' => '',
            'twinBed' => 0,
            'singleBed' => 0,
            'mattress' => 0,
            'description' => '',
            'address' => '',
            'coordinates' => '',
            'building_area' => '',
            'land_area' => '',
            'capacity' => 0,
            'maxCapacity' => 0,
            'room_count' => 0,
            'rules' => ['text' => null],
            'specifications' => [
                'type' => null,
                'view' => [],
                'paymentType' => '1',
                'additionalPrice' => null,
                'location' => null,
                'facilities' => []
            ],
            'status_id' => 2,
        ]);
        $this->files = collect([]);
    
        // session()->flash('alert-toast', ['message' => 'ویلای شما با موفقیت اضافه شد', 'icon' => 'success']);
        }

    public function render()
    {


        if (count(Residence::query()->get()) >= 1) {
            session()->flash('message', ['title' => 'امکان افزودن ویلا برای شما فراهم نیست', 'icon' => 'danger', '']);

            redirect('/admin/villa/list');
        }
        $statuses = Status::query()->where('type', 1)->get();
        $provinces = Province::query()->get();

        $cities = City::query()->where('province_id', $this->req->province_id)->get();
        return view('Villa::Livewire.Admin.addPage', compact('statuses', 'provinces', 'cities'));
    }


    public function submit()
    {
        //        $this->validate();
        $this->req->user_id = auth()->id();
        $this->req->residence_owner = 1;
        $this->req->coordinates = [];
        //        dd($this->req);
        $this->req->save();
        foreach ($this->files as $file) {
            ResidenceFile::query()->create([
                'url' => $file['url'],
                'alt' => $file['alt'],
                'type' => $file['type'],
                'residence_id' => $this->req->id
            ]);
        }

        session()->flash('message', ['title' => 'ویلای شما با موفقیت اضافه شد', 'icon' => 'success']);

        return redirect(route('admin.villa.list'));
    }

    public function deleteFile($index)
    {
        $this->files->splice($index, 1);
    }

    public function editFile($index)
    {
        $this->emit('getData', ['value' => $this->files[$index], 'index' => $index]);
        $this->dispatchBrowserEvent('open-modal');
    }

    public function changeFile($e)
    {
        $this->files->put($e['index'], $e['value']);
        $this->dispatchBrowserEvent('toastMessage', ['message' => 'فایل شما آپدیت شد.', 'icon' => 'success']);
    }

    public function upload()
    {
        $this->validate([
            'file.url' => ['required'],
            'file.alt' => ['nullable', 'string', 'max:100'],
            'file.type' => ['required', new ControlThumbs($this->files, 1)],
        ]);

        $this->files->push([
            'url' => $this->file['url'],
            'type' => $this->file['type'],
            'alt' => $this->file['alt'],
        ]);

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->file = [
            'url' => null,
            'alt' => null,
            'type' => null
        ];
    }
}
