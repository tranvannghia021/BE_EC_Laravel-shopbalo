<?php

namespace App\Services\Client;

use App\Http\Resources\Admin\Category\GetAllResource;
use App\Http\Resources\Admin\Category\ShowResource;
use App\Http\Traits\ApiResponse;
use App\Repositories\Client\CategoryRepository;


class CategoryService
{
    use ApiResponse;
    protected $categoryRepo;
    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getAll($request)
    {
        $search = [];
        (is_null($request->q) || (empty($request->q))) ? $search['key'] = null : $search['key'] = $request->q;
        (is_null($request->sort_id) || (empty($request->sort_id))) ? $search['sort_id'] = null : $search['sort_id'] = $request->sort_id;

        $categories = $this->categoryRepo->getAll($search);

        $data = [];
        if (!is_null($categories)) {
            $data = GetAllResource::collection($categories)->response()->getData();
        }

        return  $this->apiResponse($data, 200, 'list category');
    }


    public function show(int $id)
    {
        if (is_null($id)) return $this->errorResponse();

        $category = $this->categoryRepo->find(intval($id));
        $data = [];
        if (!is_null($category)) {
            $data = (new ShowResource($category));
        }


        return  $this->apiResponse($data, 200, 'Show category');
    }
}