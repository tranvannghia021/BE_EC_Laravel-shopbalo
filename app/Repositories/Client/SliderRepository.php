<?php

namespace App\Repositories\Client;

use App\Models\Slider;
use App\Repositories\BaseRepository;

class SliderRepository extends BaseRepository
{
    protected $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
        parent::__construct($slider);
    }

    public function getAll($search = [])
    {

        return $this->model->status($search['status'])->search($search['key'])
            ->sort($search['sort'])->paginate($search['per_page']);
    }
}