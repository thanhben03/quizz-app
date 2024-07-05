<?php

namespace App\Repositories;

use App\Http\Traits\ResponseTrait;
use App\Models\User;
use App\Repositories\Interfaces\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface {
    use ResponseTrait;
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    abstract function getModel();

    public function index()
    {
        $model = $this->model->get();
        return $this->responseSuccess($model);
    }

    public function create()
    {

    }

    public function store($attributes = [])
    {
        try {
            return $this->model->create($attributes);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }

    public function show($slug)
    {

        return false;
    }

    public function edit($id)
    {

        return false;
    }

    public function update($data, $id)
    {
        $instance = $this->model->find($id);
        $instance->update($data);
    }

    public function destroy($id)
    {
        // dd($id);
        $instance = $this->model->find($id);
        dd($instance);
        $instance->delete();

    }
}
