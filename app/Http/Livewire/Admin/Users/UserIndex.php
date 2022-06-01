<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Extra\TableFunction;
use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination , TableFunction;

    public $paginationTheme = 'bootstrap';

    protected $listeners = ['delete' , 'forceDelete'  , 'restore' , 'selectedAction'];

    public $perPage = 15;
    public $status = '0';
    public $q = '';
    public $orderCol = 'created_at';
    public $ordering = 'desc';
    public $selected = [];
    public $action = 0;
    public $trash = 0;

    protected $queryString = ['perPage' => ['except' => 15] , 'status' => ['except' => '0'] , 'q' => ['except' => ''] , 'trash' => ['except' => 0] , 'orderCol', 'ordering'];

    public function mount()
    {
        $this->model = 'App\Models\User';
        $this->softDelete = true;
    }

    public function render()
    {
        $conditions = [array('condition' => 'order' , 'key' => $this->orderCol , 'value' => $this->ordering , 'except' => null)];

        if ($this->trash) {
            $conditions = array_merge($conditions , [array('condition' => 'trash' , 'key' => 'd' , 'value' => null , 'except' => null)]);
        }
        $users = $this->getData($this->perPage , $this->q , collect($conditions));

        $perPages = [15 , 30 , 45 , 50];

        return view('livewire.admin.users.user-index' , compact('users' , 'perPages'));
    }

    public function showTrash()
    {
        $this->trash = $this->trash == 0 ? 1 : 0;
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
                        if ($this->trash ?? false) {
                            $this->forceDelete($item);
                            continue;
                        }
                        $this->delete($item);
                    }
                    $this->selected = [];
                    break;
                case 2:
                    foreach ($this->selected as $item) {
                        $this->restore($item);
                    }
                    $this->selected = [];
                    break;
            }
        } else {
            $this->dispatchBrowserEvent('toastMessage' , ['message' => 'موردی انتخاب نشده' , 'icon' => 'error']);
        }

        $this->action = 0;
    }

    public function changePassword($id)
    {
        $this->emit('getData' , $id);
        $this->dispatchBrowserEvent('open-modal');
    }
}
