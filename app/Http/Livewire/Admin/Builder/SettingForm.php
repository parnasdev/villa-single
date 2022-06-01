<?php

namespace App\Http\Livewire\Admin\Builder;

use Livewire\Component;

class SettingForm extends Component
{
    protected $listeners = ['setData', 'getFile'];
    public array|null $item = null;
    public int|null $index = null;
    public int|null $index1 = null;
    public string|null $direction = null;

    public function render()
    {
        return view('livewire.admin.builder.setting-form');
    }

    public function updated($name, $value)
    {
        if (!($name == 'component.data.form.id' && !is_null($value))) {
            return;
        }
//        $form = Form::query()->find($value);
//        $this->component['data']['form']['content'] = $form->content;
//        $this->component['data']['form']['title'] = $form->title;


    }

    public function close()
    {
        $this->dispatchBrowserEvent('close-modal');
        $this->index = null;
        $this->index1 = null;
        $this->direction = null;
        $this->item = null;
    }

    public function setData($e)
    {
        list($this->index, $this->index1, $this->direction, $this->item) = $e;
    }

    public function convert($name)
    {
        $types = collect(config('pagebuilder.types'));

        return $types->get($name);
    }

    public function submit()
    {
        $this->dispatchBrowserEvent('change-options', ['index' => $this->index, 'index1' => $this->index1, 'direction' =>  $this->direction, 'item' => $this->item]);

        $this->close();
    }

    public function getFile($e)
    {
        $this->fill([$e['input'] => url($e['value'])]);
    }
}
