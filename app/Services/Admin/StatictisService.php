<?php

namespace App\Services\Admin;

use App\Helpers\Helper;
use App\Http\Traits\ApiResponse;
use App\Repositories\Admin\StatictisRepository;

class StatictisService
{
    use apiResponse;
    protected StatictisRepository $staffRepository;

    public function __construct(StatictisRepository $staffRepository)
    {
        $this->staffRepository = $staffRepository;
    }





}
