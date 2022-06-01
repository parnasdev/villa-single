<?php


namespace Packages\pay\src\Http\Livewire\Admin;


use App\Http\Extra\TableFunction;
use App\Models\Status;
use Livewire\WithPagination;

class TransactionIndex extends \Livewire\Component
{
    use WithPagination , TableFunction;

    public $paginationTheme = 'bootstrap';

    public $perPage = 15;
    public $status = '0';
    public $q = '';
    public $orderCol = 'created_at';
    public $ordering = 'desc';
    public $selected = [];
    public $action = 0;

    protected $queryString = ['perPage' => ['except' => 15] , 'status' => ['except' => '0'] ,'q' => ['except' => ''] , 'orderCol', 'ordering'];

    public function mount()
    {
        $this->model = 'Packages\pay\src\Models\Transaction';
    }

    public function render()
    {
        $conditions = [array('condition' => 'where' , 'key' => 'status_id' , 'value' => $this->status , 'except' => 0) , array('condition' => 'order' , 'key' => $this->orderCol , 'value' => $this->ordering , 'except' => null)];
        $transactions = $this->getData($this->perPage , $this->q , collect($conditions));
        $statuses = Status::query()->where('type' , 3)->get();
        $perPages = [15 , 30 , 45 , 50];
        return view('pay::livewire.admin.transaction-index' , compact('transactions' , 'statuses' , 'perPages'));
    }


    public function actionMessage()
    {
        // TODO: Implement actionMessage() method.
    }

    public function selectedAction()
    {
        // TODO: Implement selectedAction() method.
    }
}
