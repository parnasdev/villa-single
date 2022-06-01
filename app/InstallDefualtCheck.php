<?php


namespace App;



trait InstallDefualtCheck
{
    /**
     * @param array $dbs exampel: array('name'=> 'Post' , 'module' => null)
     * @param array $conditions is sql Conditions
     */
    public function checking(array $dbs, array $conditions = []) : array
    {
        $result = [];
        foreach ($dbs as $key => $db) {
            $model = $this->findDB($db);
            if (!is_null($conditions[$key])) {
                $result[$db['name']] = $this->getModelWithCondition($model , $conditions[$key])->get()->isEmpty();
                continue;
            }
            $result[$db['name']] = $model::get()->isEmpty();
        }

        return $result;
    }

    public function findDB(array $db): string
    {
        if (!is_null($db['module'])) {
            return getModulePath($db['module'] , true) . 'Models\\'. $db['name'];
        } else {
            return  'App\\Models\\'. $db['name'];
        }
    }

    public function getModelWithCondition($model , $condition)
    {
        switch ($condition['condition']) {
            case "where":
                return $model::where($condition['key'] , $condition['value']);
                break;
            case "whereIn":
                return $model::whereIn($condition['key'] , $condition['value']);
                break;
        }
    }
}
