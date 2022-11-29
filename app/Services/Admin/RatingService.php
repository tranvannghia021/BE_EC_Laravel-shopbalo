<?php

namespace App\Services\Admin;

use App\Helpers\Helper;
use App\Http\Resources\Admin\Rating\GetAllresource;
use App\Http\Resources\Admin\Rating\ShowResource;
use App\Http\Traits\ApiResponse;
use App\Repositories\Admin\RatingRepository;
use App\Services\response;

class RatingService
{
    use ApiResponse;
    protected $ratingRepo;
    protected $limit = 10;
    public function __construct(RatingRepository $ratingRepo)
    {
        $this->ratingRepo = $ratingRepo;
    }


    /**
     * getAll
     *@author tranvannghia021
     * @param  mixed $request
     * @return response
     */
    public function getAll($request)
    {
        $search = [];
        (is_null($request->q) || (empty($request->q))) ? $search['key'] = null : $search['key'] = $request->q;
        (is_null($request->per_page) || (empty($request->per_page))) ? $search['per_page'] = $this->limit : $search['per_page'] = $request->per_page;
        (is_null($request->sortPoint) || (empty($request->sortPoint))) ? $search['sortPoint'] = 'asc' : $search['sortPoint'] = $request->sortPoint;
        (is_null($request->sortStatus) || (empty($request->sortStatus))) ? $search['sortStatus'] = 'all' : $search['sortStatus'] = $request->sortStatus;

        $ratings = $this->ratingRepo->getAll($search);
        $data = [];

        if (!is_null($ratings)) {
            $data = GetAllresource::collection($ratings)->response()->getData();
        }

        return $this->apiResponse($data, 200, 'List rating');
    }


    /**
     * create
     *@author tranvannghia021
     * @param  mixed $request
     * @return response
     */
    public function create($request)
    {
        $nameFile = Helper::saveImgBase64v1($request->image, 'Rating');
        if ($nameFile === false) return $this->errorResponse('Image is invalid', 422);
        $payload = [
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'point' => $request->point,
            'content' => $request->content,
            'image' => $nameFile,
        ];
        $rating = $this->ratingRepo->create($payload);

        $data = [];
        if (!is_null($rating)) {
            $data = (new ShowResource($rating));
        }
        return $this->apiResponse($data, 200, 'Create rating successfully.');
    }


    /**
     * show
     *@author tranvannghia021
     * @param  mixed $id
     * @return response
     */
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


    /**
     * update
     *@author tranvannghia021
     * @param  mixed $request
     * @param  mixed $id
     * @return bool
     */
    public function update($request, $id)
    {

        if (is_null($id)) return $this->errorResponse();
        if ($request->image != '' || !is_null($request->image)) {
            $request['image'] = Helper::saveImgBase64v1($request->image, 'Rating');
        }

        $result = $this->ratingRepo->update($id, $request->toArray());

        return $result ? $this->apiResponse([], 200, 'Update rating successfully') : $this->apiResponse([], 401, 'Update rating failed');
    }


    public function destroy($id)
    {
        if (is_null($id)) return $this->errorResponse();

        $result = $this->ratingRepo->delete($id);
        return $result ? $this->apiResponse([], 200, 'Delete rating successfully') : $this->apiResponse([], 401, 'Delete rating failed');
    }
}
