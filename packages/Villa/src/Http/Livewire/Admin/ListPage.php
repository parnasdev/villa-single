<?php

namespace Packages\Villa\src\Http\Livewire\Admin;

use App\Http\Extra\TableFunction;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use Packages\Villa\src\Models\Residence;
use Livewire\Component;
use Livewire\WithPagination;

class ListPage extends Component
{
    use TableFunction, WithPagination;

    public $paginationTheme = 'bootstrap';

    protected $listeners = ['delete', 'forceDelete', 'restore', 'selectedAction'];
    public $residenceData = [];
    public $calendarRequest = [];
    public $perPage = 15;
    public $orderCol = 'created_at';
    public $ordering = 'desc';
    public $selected = [];
    public $status = '0';
    public $action = 0;
    public $trash = 0;
    public $q = '';

    protected $queryString = ['perPage' => ['except' => 15], 'status' => ['except' => '0'], 'q' => ['except' => ''], 'trash' => ['except' => 0], 'orderCol', 'ordering'];

    public function mount()
    {
        $this->model = 'Packages\Villa\src\Models\Residence';
        $this->softDelete = true;
    }

    public function render()
    {
        $conditions = [array('condition' => 'where', 'key' => 'status_id', 'value' => $this->status, 'except' => 0), array('condition' => 'where', 'key' => 'specifications', 'value' => 'page', 'except' => null), array('condition' => 'order', 'key' => $this->orderCol, 'value' => $this->ordering, 'except' => null)];
        if ($this->trash) {
            $conditions = array_merge($conditions, [array('condition' => 'trash', 'key' => 'd', 'value' => null, 'except' => null)]);
        }
//        $villas = $this->getData($this->perPage , $this->q , collect($conditions));
        $villas = Auth::user()->role_id === 1 ? Residence::query()->get() : user()->residences()->get();
        $statuses = Status::query()->where('type', 1)->get();
        $perPages = [15, 30, 45, 50];

        return view('Villa::Livewire.Admin.listPage', compact('villas', 'statuses', 'perPages'));
    }

    public function changeStatus($id, $status)
    {
        $this->model::find($id)->update([
            'status_id' => $status
        ]);

        $this->dispatchBrowserEvent('toastMessage', ['message' => 'وضعیت تغییر کرد.', 'icon' => 'success']);
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
            $this->dispatchBrowserEvent('toastMessage', ['message' => 'موردی انتخاب نشده', 'icon' => 'error']);
        }

        $this->action = 0;
    }
}
