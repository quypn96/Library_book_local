<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class EloquentRepository implements RepositoryInterface
{

    protected $_model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    public function setDataSort($key, $sort)
    {
        return $this->_model->orderBy($key, $sort);
    }

    public function getAll()
    {
        return $this->_model->all();
    }

    public function find($id)
    {
        $result = $this->_model->find($id);

        return $result;
    }

    public function findOrFail($id)
    {
        $result = $this->_model->findOrFail($id);

        return $result;
    }

    public function create(array $attributes)
    {

        return $this->_model->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);

            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->findOrFail($id);
        $result->delete();

        return true;
    }

    public function getByAttribute($attribute, $comparison, $value)
    {
        $result = $this->_model::where($attribute, $comparison, $value)->get();

        return $result;
    }

}
