<?php


namespace App\Http\Extra;


use Illuminate\Support\Collection;

trait DynamicFunction
{
    public ?string $model = null;

    /**
     * get data form model
     * @param mixed $perpage
     * @param string|null $keyword : key for search in your model must have scopeSearch
     * @param Collection|null $options : options where or whereIn if softDelete is true use trash for get trash
     * @param bool $paginate
     * @return mixed
     */
    public function getData($perpage = 15 , string $keyword = null , Collection $options = null , bool $paginate = true) {
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
                    case 'limit':
                        $data->limit($option['value']);
                        break;
                }
            }
        }

        if (!$paginate) {
            return $data->get();
        }

        return $data->paginate($perpage);
    }
}
