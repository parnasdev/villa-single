<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Http\Extra\TableFunction;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryIndex extends Component
{
    use TableFunction , WithPagination;

    public $paginationTheme = 'bootstrap';

    protected $listeners = ['delete' , 'selectedAction'];

    public $perPage = 15;
    public $q = '';
    public $selected = [];
    public $action = 0;
    public $type;

    protected $queryString = ['perPage' => ['except' => 15] , 'q' => ['except' => ''] , 'type'];

    public function mount()
    {
        $this->model = 'App\Models\Category';
    }

    public function render()
    {
        $conditions = [array('condition' => 'where' , 'key' => 'category_type' , 'value' => $this->type , 'except' => null) , array('condition' => 'order' , 'key' => 'id' , 'value' => 'desc' , 'except' => null)];

        $categories = $this->getData($this->perPage , $this->q , collect($conditions));
        return view('livewire.admin.categories.category-index' , compact('categories'));
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
