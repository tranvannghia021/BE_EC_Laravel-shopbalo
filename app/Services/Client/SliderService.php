<?php

namespace App\Services\Client;

use App\Http\Resources\Admin\Slider\GetAllResource;
use App\Http\Resources\Admin\Slider\ShowResource;
use App\Http\Traits\ApiResponse;
use App\Repositories\Client\SliderRepository;

class SliderService
{
    use ApiResponse;
    protected $sliderRepo;
    protected $limit = 10;
    public function __construct(SliderRepository $sliderRepo)
    {
        $this->sliderRepo = $sliderRepo;
    }

    public function getAll($request)
    {
        $search = [];
        (is_null($request->q) || (empty($request->q))) ? $search['key'] = null : $search['key'] = $request->q;
        (is_null($request->status) || (empty($request->status))) ? $search['status'] = 'Active' : $search['status'] = $request->status;
        (is_null($request->per_page) || (empty($request->per_page))) ? $search['per_page'] = $this->limit : $search['per_page'] = $request->per_page;
        (is_null($request->sort) || (empty($request->sort))) ? $search['sort'] = 'desc' : $search['sort'] = $request->sort;

        $sliders = $this->sliderRepo->getAll($search);

        $data = [];
        if (!is_null($sliders)) {
            $data = GetAllResource::collection($sliders)->response()->getData();
        }

        return  $this->apiResponse($data, 200, 'list sliders');
    }

    public function show($id)
    {
        if (is_null($id)) return $this->errorResponse();
        $slider = $this->sliderRepo->find(intval($id));
        $data = [];
        if (!is_null($slider)) {
            $data = (new ShowResource($slider));
        }
        return $this->apiResponse($data, 200, 'Show Slider');
    }
}
