<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    /**
     * getAll
     *
     * @return collection
     */
    public function getAll()
    {
        return $this->model->all();
    }
    /**
     * find
     *
     * @param  mixed $id
     * @return object|array
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * create
     *
     * @param  mixed $data
     * @return  array|object
     */
    public function create(array $data)
    {
        try {
            $model = $this->model->create($data);
        } catch (\Exception $e) {
            return [];
        }
        return $model;
    }
    /**
     * update
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return object|array
     */
    public function update($id, array $data)
    {
        try {

            $model = $this->find($id);
            if ($model) {
                $model->update($data);
            }
        } catch (\Exception $e) {
            return [];
        }
        return $model;
    }
    /**
     * delete
     *
     * @param  mixed $id
     * @return bool
     */
    public function delete($id)
    {
        try {
            $model = $this->find($id);
            if ($model) {

                $model->delete();
            }
        } catch (\Exception $e) {

            return false;
        }
        return true;
    }
}
