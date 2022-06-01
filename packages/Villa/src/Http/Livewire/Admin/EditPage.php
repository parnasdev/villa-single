<?php

namespace Packages\Villa\src\Http\Livewire\Admin;

use App\Http\Extra\TableFunction;
use App\Models\City;
use App\Models\PostFile;
use App\Models\Province;
use App\Models\Status;
use App\Rules\ControlThumbs;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Packages\Villa\src\Models\Residence;
use Packages\Villa\src\Models\ResidenceFile;

class EditPage extends Component
{
    public Residence $residence;
    public $deletedFiles = [];

    public Collection $files;
    public $file = [
        'url' => null,
        'alt' => null,
        'type' => null
    ];

    public function rules()
    {
        return [
            'residence.title' => ['required', 'string', 'max:100'],
            'residence.slug' => ['nullable', 'string', Rule::unique('req', 'slug')],
            'residence.province_id' => ['required'],
            'residence.user_id' => ['required'],
            'residence.city_id' => ['required'],
            'residence.residence_owner' => [],
            'residence.mobile' => ['required'],
            'residence.description' => ['nullable', 'string', 'max:10000'],
            'residence.address' => ['required'],
            'residence.coordinates' => [],
            'residence.building_area' => ['required'],
            'residence.land_area' => ['required'],
            'residence.capacity' => ['required'],
            'residence.maxCapacity' => ['required'],
            'residence.twinBed'=>['required'],
            'residence.singleBed'=>['required'],
            'residence.mattress'=>['required'],
            'residence.room_count' => ['required'],
            'residence.rules' => ['nullable' , 'array'],
            'residence.rules.text' => [],
            'residence.specifications' => ['nullable' , 'array'],
            'residence.specifications.type' => ['required'],
            'residence.specifications.view' => ['required'],
            'residence.specifications.location' => '',
            'residence.specifications.facilities' => ['required'],
            'residence.specifications.paymentType' => '',
            'residence.specifications.additionalPrice' => '',
            'residence.status_id' => ['required'],
        ];
    }


    public function mount()
    {
        $this->files = collect([]);
        $this->files = collect($this->residence->residenceFiles()->get()->toArray());

    }

    public function render()
    {
        $statuses = Status::query()->where('type', 1)->get();
        $provinces = Province::query()->get();
        $cities = City::query()->where('province_id', $this->residence->province_id)->get();
        return view('Villa::Livewire.Admin.editPage', compact('statuses', 'provinces', 'cities'));
    }


    public function submit()
    {
        $this->validate();


        $this->residence->user_id = auth()->id();
        $this->residence->residence_owner = 1;
        $this->residence->coordinates = [];
        $this->residence->save();
//        foreach ($this->files as $file) {
//            ResidenceFile::query()->create([
//                'url' => $file['url'],
//                'alt' => $file['alt'],
//                'type' => $file['type'],
//                'residence_id' => $this->residence->id
//            ]);
//        }




            if (count($this->deletedFiles) > 0) {
                foreach ($this->deletedFiles as $file) {
                    ResidenceFile::query()->find( $file)->delete();

                }

            }


        foreach ($this->files->whereNull('id') as $file) {
            ResidenceFile::query()->create([
                'url' => $file['url'],
                'alt' => $file['alt'],
                'type' => $file['type'],
                'residence_id' => $this->residence->id
            ]);
        }

        foreach ($this->files->whereNotNull('id') as $file) {
            ResidenceFile::query()->find($file['id'])->update([
                'url' => $file['url'],
                'alt' => $file['alt'],
                'type' => $file['type'],
            ]);
        }



        session()->flash('message', ['title' => 'ویلای شما با موفقیت اضافه شد', 'icon' => 'success']);

        return redirect(route('admin.villa.list'));
    }

    public function deleteFile($index)
    {
        if ($this->files[$index]['id'] != null) {
            $this->deletedFiles[] = $this->files[$index]['id'];
        }
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
