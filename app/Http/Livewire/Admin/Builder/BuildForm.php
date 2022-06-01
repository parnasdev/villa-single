<?php

namespace App\Http\Livewire\Admin\Builder;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class BuildForm extends Component
{
    public array $components;

    public array $body;

    public $componentId = null;

    protected $listeners = ['dropComponent' , 'dropCol' , 'changeOptions'];

    public function mount()
    {
        $this->body = [];
        $this->components = json_decode(File::get(base_path('jsons/components.json')) , true);
    }

    public function render()
    {
        return view('livewire.admin.builder.build-form');
    }

    public function openSetting($index , $index1 = null , $direction = null)
    {
        $this->dispatchBrowserEvent('open-modal');
        $component = $this->body[$index];
        if (is_null($index1)) {
            $this->emit('setData' , [$index , $index1 ,  $direction , $component]);
        } else {
            $element = $component['data'][$direction][$index1];
            $this->emit('setData' , [ $index , $index1 ,  $direction , $element]);
        }
    }

    public function changeOptions($e) {
        list($index , $index1 , $direction , $component) = $e;
        if (is_null($index1)) {
            collect($this->body)->put($index , $component);
        } else {
            $_component = collect($this->body)->get($index);
            $_component['data'][$direction][$index1] = $component;
            collect($this->body)->put($index , $_component);
        }
    }
}
