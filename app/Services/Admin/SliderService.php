<?php

namespace App\Services\Admin;

use App\Helpers\Helper;
use App\Http\Resources\Admin\Slider\GetAllResource;
use App\Http\Resources\Admin\Slider\ShowResource;
use App\Http\Traits\ApiResponse;
use App\Repositories\Admin\SliderRepository;


class SliderService
{
    use ApiResponse;
    protected $limit = 10;
    protected $sliderRepo;
    public function __construct(SliderRepository $sliderRepo)
    {
        $this->sliderRepo = $sliderRepo;
    }


    public function getAll($request)
    {
        $search = [];
        (is_null($request->q) || (empty($request->q))) ? $search['key'] = null : $search['key'] = $request->q;
        (is_null($request->status) || (empty($request->status))) ? $search['status'] = 'all' : $search['status'] = $request->status;
        (is_null($request->per_page) || (empty($request->per_page))) ? $search['per_page'] = $this->limit : $search['per_page'] = $request->per_page;
        (is_null($request->sort) || (empty($request->sort))) ? $search['sort'] = 'desc' : $search['sort'] = $request->sort;

        $sliders = $this->sliderRepo->getAll($search);

        $data = [];
        if (!is_null($sliders)) {
            $data = GetAllResource::collection($sliders)->response()->getData();
        }

        return  $this->apiResponse($data, 200, 'list sliders');
    }


    public function create($request)
    {
        if (is_null($request)) return $this->errorResponse();
        $fileName = Helper::saveImgBase64v1($request->image, 'Slider');

        if ($fileName == false) return $this->apiResponse([], 422, 'Image is invalid.Try againt');
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'image_slider' => $fileName,
            'status' => $request->status === 'Active' ? 'Active' : 'InActive',
            'url' => $request->url,
        ];

        $sliders = $this->sliderRepo->create($data);

        $data = [];
        if (!is_null($sliders)) {
            $data = (new ShowResource($sliders));
        }

        return $this->apiResponse($data, 200, 'Create slider successfully');
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


    public function update($request, $id)
    {
        if (is_null($id) || is_null($request)) return $this->errorResponse();
        
        if (!is_null($request->input('image'))) {
            $fileName = Helper::saveImgBase64v1($request->input('image'), 'Slider');
           
            if ($fileName == false) return $this->apiResponse([], 422, 'Image is invalid.Try againt');
            $request['image_slider'] = $fileName;
            unset($request['image']);
        }
        if (!is_null($request->status)) $request['status'] = $request->status === 'Active' ? 'Active' : 'InActive';
        $result = $this->sliderRepo->update(intval($id), $request->toArray());
        return $result ? $this->apiResponse([], 200, 'Update slider successfully') : $this->apiResponse([], 401, 'Update slider failed');
    }

    public function delete($id)
    {
        if (is_null($id)) return $this->errorResponse();
        $result = $this->sliderRepo->delete(intval($id));
        return $result ? $this->apiResponse([], 200, 'Delete slider successfully') : $this->apiResponse([], 401, 'Delete slider failed');
    }
}
