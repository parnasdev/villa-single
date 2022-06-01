<?php


namespace App\Http\Extra;


use Illuminate\Support\Collection;

trait TableFunction
{
    public ?string $model = null;
    public bool $useScout = false;
    public bool $softDelete = false;

    /**
     * get data form model
     * @param mixed $perpage
     * @param string|null $keyword : key for search in your model must have scopeSearch
     * @param Collection|null $options : options where or whereIn if softDelete is true use trash for get trash
     * @return mixed
     */
    public function getData($perpage = 15 , string $keyword = null ,Collection $options = null) {
        if ($options->where('condition' , 'trash')->isEmpty()) {
            $data = $this->model::query();
        } else {
            $data = $this->model::onlyTrashed();
        }

        if (!is_null($keyword) && $keyword != '') {
            $data->search($keyword);
        }

        $wheres = [];
        foreach ($options as $option) {
            if ($option['except'] != $option['value']) {
                switch ($option['condition']) {
                    case 'where':
                        $data->where($option['key'] , $option['value']);
                        break;
                    case 'whereIn':
                        $data->whereIn($option['key'] , $option['value']);
                        break;
                    case 'order':
                        $data->orderBy($option['key'] , $option['value']);
                        break;
                }
            }
        }



        return $data->paginate($perpage);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $this->model::find($id)->delete();

        $this->dispatchBrowserEvent('toastMessage' , ['message' => $this->softDelete ? 'به سطل آشغال انتقال پیدا کرد.' : 'کاملا حذف شد.' , 'icon' => 'success']);
    }

    /**
     * @param $id
     */
    public function restore($id)
    {
        $this->model::withTrashed()->find($id)->restore();

        $this->dispatchBrowserEvent('toastMessage' , ['message' => ' بازیابی شد.' , 'icon' => 'success']);
    }

    /**
     * @param $id
     */
    public function forceDelete($id)
    {
        $this->model::withTrashed()->find($id)->forceDelete();

        $this->dispatchBrowserEvent('toastMessage' , ['message' => 'کاملا حذف شد.' , 'icon' => 'success']);
    }

    /**
     * @param $id
     * @param bool $force
     * @param bool $restore
     */
    public function message($id , $force = false , $restore = false)
    {
       if ($this->softDelete) {
           if (!$restore) {
               $this->dispatchBrowserEvent('deleteMessage' , ['event' => $force ? 'forceDelete': 'delete' , 'id' => $id , 'force' => $force]);
           } else {
               $this->dispatchBrowserEvent('message' , ['message' => 'آیا میخواهید بازیابی کنید؟' , 'icon' => 'waring' , 'title' => 'اطمینان دارید؟' , 'btnCText' => 'بله' , 'btnCAText' => 'لغو' , 'event' => 'restore' , 'data' => $id]);
           }
       } else {
           $this->dispatchBrowserEvent('deleteMessage' , ['event' => 'delete' , 'id' => $id , 'force' => true]);
       }
    }

    abstract public function actionMessage();

    abstract public function selectedAction();
}
