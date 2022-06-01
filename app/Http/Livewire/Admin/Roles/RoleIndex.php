<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Http\Extra\TableFunction;
use Livewire\Component;
use Livewire\WithPagination;

class RoleIndex extends Component
{

    use TableFunction , WithPagination;

    public $paginationTheme = 'bootstrap';

    protected $listeners = ['delete' , 'selectedAction'];

    public $perPage = 15;
    public $q = '';
    public $selected = [];
    public $action = 0;

    protected $queryString = ['perPage' => ['except' => 15] , 'q' => ['except' => '']];

    public function mount()
    {
        $this->model = 'App\Models\Role';
    }

    public function render()
    {
        $conditions = [array('condition' => 'order' , 'key' => 'id' , 'value' => 'desc' , 'except' => null)];

        $roles = $this->getData($this->perPage , $this->q , collect($conditions));
        return view('livewire.admin.roles.role-index' , compact('roles'));
    }

    public function actionMessage()
    {
        if (count($this->selected) > 0) {
            $this->dispatchBrowserEvent('message', ['message' => 'آیا میخواهید این عملیات انجام دهید؟', 'icon' => 'waring', 'title' => 'اطمینان دارید؟', 'btnCText' => 'بله', 'btnCAText' => 'لغو', 'event' => 'selectedAction', 'data' => null]);
        }
    }

    public function selectedAction()
    {
        if (count($this->selected) > 0) {
            switch ($this->action) {
                case 1:
                    foreach ($this->selected as $item) {
                        $this->delete($item);
                    }
                    $this->selected = [];
                    break;
            }
        } else {
            $this->dispatchBrowserEvent('toastMessage' , ['message' => 'موردی انتخاب نشده' , 'icon' => 'error']);
        }

        $this->action = 0;
    }
}
