<?php

namespace App\Http\Livewire\Admin\Links;

use App\Http\Extra\TableFunction;
use App\Models\Link;
use Livewire\Component;
use Livewire\WithPagination;

class LinkIndex extends Component
{
    use TableFunction , WithPagination;

    public $paginationTheme = 'bootstrap';

    protected $listeners = ['delete'];

    public $perPage = 15;
    public $selected = [];
    public $action = 0;
    public $type;

    public function mount()
    {
        $this->model = 'App\Models\Link';
    }

    public function render()
    {
        $links = $this->getData($this->perPage , null , collect([]));
        return view('livewire.admin.links.link-index' , compact('links'));
    }

    public function actionMessage()
    {
    }

    public function selectedAction()
    {

    }

    public function changeStatus(Link $link)
    {
        $link->used = !$link->used;

        $link->save();

        $this->dispatchBrowserEvent('toastMessage' , ['message' => 'عملیات انجام شد.' , 'icon' => 'success']);

    }
}
