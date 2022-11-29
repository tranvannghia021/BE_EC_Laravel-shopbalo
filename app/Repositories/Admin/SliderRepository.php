<?php

namespace App\Repositories\Admin;

use App\Models\Slider;
use App\Repositories\BaseRepository;

class liderRepository extends BaseRepository
{

    public function __construct(Slider $slider)
    {
        parent::__construct($slider);
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

        return $this->model->status($search['status'])->search($search['key'])
            ->sort($search['sort'])->paginate($search['per_page']);
    }
}
