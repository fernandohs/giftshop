<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;


abstract class BaseRepository
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    abstract public function getFieldsSearchable();


    abstract public function model();

    public function allQuery($search = [])
    {
        $query = $this->model->newQuery();

        if (count($search)) {
            foreach ($search as $key => $value) {
                if (in_array($key, $this->getFieldsSearchable())) {
                    $query->where($key, $value);
                }
            }
        }


        return $query;
    }


    public function all($search = [], $trashed = false, $columns = ['*'])
    {
        $query = $this->allQuery($search);
        if ($trashed) {
            $query->withTrashed();
        }

        return $query->get($columns);
    }

    public function create($input)
    {
        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }

    public function find($id, $trashed = false, $columns = ['*'])
    {
        $query = $this->model->newQuery();

        if ($trashed) {
            $query->withTrashed();
        }


        return $query->find($id, $columns);
    }


    public function update($input, $id)
    {
        $query = $this->model->newQuery();
        $model = $query->findOrFail($id);
        if (empty($input['password'])) {
            unset($input['password']);
        }else{
            $input['password'] = \Hash::make($input['password']);
        }
       
        $model->fill($input);
        $model->save();

        return $model;
    }

    public function delete($id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        return $model->delete();
    }
}
