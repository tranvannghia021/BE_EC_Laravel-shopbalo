<?php

namespace App\Services\Client;

use App\Http\Resources\Admin\Rating\GetAllresource;
use App\Http\Resources\Admin\Rating\ShowResource;
use App\Http\Traits\ApiResponse;
use App\Repositories\Client\RatingRepository;
use App\Services\Admin\RatingService as AdminRatingService;

class RatingService
{
    use ApiResponse;
    protected $ratingRepo;
    protected $limit = 10;
    public function __construct(RatingRepository $ratingRepo)
    {
        $this->ratingRepo = $ratingRepo;
    }

    public function getAll($request)
    {
        $search = [];
        (is_null($request->q) || (empty($request->q))) ? $search['key'] = null : $search['key'] = $request->q;
        (is_null($request->per_page) || (empty($request->per_page))) ? $search['per_page'] = $this->limit : $search['per_page'] = $request->per_page;
        (is_null($request->sortPoint) || (empty($request->sortPoint))) ? $search['sortPoint'] = 'asc' : $search['sortPoint'] = $request->sortPoint;
        (is_null($request->sortStatus) || (empty($request->sortStatus))) ? $search['sortStatus'] = 'pushlished' : $search['sortStatus'] = $request->sortStatus;
        (is_null($request->filter) || (empty($request->filter))) ? $search['filter'] = null : $search['filter'] = $request->filter;

        $ratings = $this->ratingRepo->getAll($search);
        $data = [];

        if (!is_null($ratings)) {
            $data = GetAllresource::collection($ratings)->response()->getData();
        }

        return $this->apiResponse($data, 200, 'List rating');
    }


    public function show($id)
    {
        if (is_null($id)) return $this->errorResponse();
        $rating = $this->ratingRepo->find(intval($id));
        $data = [];
        if (!is_null($rating)) {
            $data = (new ShowResource($rating));
        }

        return $this->apiResponse($data, 200, 'Show rating.');
    }


    public function create($request)
    {
        $ratingAdmin = app(AdminRatingService::class);
        return $ratingAdmin->create($request);
    }
}
