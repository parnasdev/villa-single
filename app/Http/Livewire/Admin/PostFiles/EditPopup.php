<?php

namespace App\Http\Livewire\Admin\PostFiles;

use Livewire\Component;

class EditPopup extends Component
{
    public $file = [
        'url' => null,
        'title' => null,
        'alt' => null,
        'type' => null,
    ];

    public $index = null;

    protected $listeners = ['getData'];

    public function render()
    {
        return view('livewire.admin.post-files.edit-popup');
    }

    public function submit()
    {
        $this->emit('changeFile' , ['index' => $this->index , 'value' => $this->file]);
        $this->dispatchBrowserEvent('close-modal');
    }

    public function getData($e)
    {
        $this->file = $e['value'];
        $this->index = $e['index'];
    }

}
