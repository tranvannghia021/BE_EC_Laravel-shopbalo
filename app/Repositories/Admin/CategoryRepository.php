<?php

namespace App\Repositories\Admin;

use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\collection;
use App\Repositories\response;

class CategoryRepository extends BaseRepository
{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
        parent::__construct($category);
    }

    /**
     * override
     * getAll record delete_at
     * @author  tranvannghia021
     *
     * @return collection
     */
    public function index()
    {
        return $this->model->get();
    }
    /**
     * override
     * getAll record delete_at
     * @author  tranvannghia021
     *
     * @return collection
     */
    public function getAll($search = [])
    {

        return $this->category->status($search['status'])->search($search['key'])
            ->sort($search['sort_id'])->paginate($search['per_page']);
    }


    // /**
    //  * override
    //  * find
    //  *
    //  * @param  int $id
    //  * @return collection
    //  */
    // public function find($id)
    // {

    //     return $this->model->findCategory('id', $id)->first();
    // }
    /**
     * forgot
     *@author tranvannghia021
     * @param  mixed $id
     * @return void
     */
    public function forgot(int $id)
    {
        try {
            $model = $this->find($id);
            if ($model) {

                $model->forceDelete();
            }
        } catch (\Exception $e) {

            return false;
        }
        return true;
    }



    /**
     * findByIdParent
     *@author tranvannghia021
     * @param  mixed $id
     * @return response
     */
    public function findByIdParent($id)
    {
        return $this->category->where('parent_id', $id)->first();
    }
}
