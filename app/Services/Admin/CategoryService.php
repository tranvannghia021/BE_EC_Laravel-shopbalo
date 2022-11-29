<?php

namespace App\Services\Admin;

use App\Helpers\Helper;
use App\Http\Resources\Admin\Category\GetAllResource;
use App\Http\Resources\Admin\Category\ShowResource;
use App\Http\Traits\ApiResponse;
use App\Repositories\Admin\CategoryRepository;
use App\Repositories\Admin\ProductRepository;
use App\Services\collection;
use App\Services\response;

class CategoryService
{

    use ApiResponse;
    protected $categoryRepo;
    protected $limit = 10;
    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }


    /**
     * getAll
     *
     * @return collection
     */
    public function index()
    {
        $categories = $this->categoryRepo->index();

        $data = [];
        if (!is_null($categories)) {
            $data = getAllResource::collection($categories)->response()->getData();
        }

        return  $this->apiResponse($data, 200, 'List all category');
    }
    public function getAll($request)
    {
        $search = [];
        (is_null($request->q) || (empty($request->q))) ? $search['key'] = null : $search['key'] = $request->q;
        (is_null($request->status) || (empty($request->status))) ? $search['status'] = 'all' : $search['status'] = $request->status;
        (is_null($request->per_page) || (empty($request->per_page))) ? $search['per_page'] = $this->limit : $search['per_page'] = $request->per_page;
        (is_null($request->sort_id) || (empty($request->sort_id))) ? $search['sort_id'] = null : $search['sort_id'] = $request->sort_id;

        $categories = $this->categoryRepo->getAll($search);

        $data = [];
        if (!is_null($categories)) {
            $data = getAllResource::collection($categories)->response()->getData();
        }

        return  $this->apiResponse($data, 200, 'list category');
    }


    /**
     * show
     *
     * @param  mixed $id
     * @return response
     */
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


    /**
     * create
     *
     * @param  mixed $request
     * @return response
     */
    public function create($request)
    {
        if (is_null($request)) return $this->errorResponse();
        $fileName = Helper::saveImgBase64v1($request->image, 'Category');

        if ($fileName == false) return $this->apiResponse([], 422, 'Image is invalid.Try againt');
        $data = [
            'name' => $request->name,
            'parent_id' => ($request->parent_id < 0) || (is_null($request->parent_id)) ? 0 : intval($request->parent_id),
            'image' => $fileName,
        ];
        $category = $this->categoryRepo->create($data);

        $isCheckCreate = (is_null($category)) ? false : true;

        return  $isCheckCreate ?  $this->apiResponse($category, 200, 'Create category successfully') : $this->apiResponse($category, 422, 'Create category failed.');
    }


    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return response
     */
    public function update($request, int  $id)
    {
        if (is_null($request) || is_null($id)) return $this->errorResponse();
        $data = [
            'name' => $request->name,
            'parent_id' => ($request->parent_id < 0) || (is_null($request->parent_id)) ? 0 : intval($request->parent_id),
        ];
        if ($request->image) {
            $fileName = Helper::saveImgBase64v1($request->image, 'Category');
            if ($fileName == false) return $this->errorResponse('Image is invalid.Try againt', 422);

            $data['image'] =  $fileName;
        }
        $category = $this->categoryRepo->update(intval($id), $data);

        $isCheckCreate = (is_null($category)) ? false : true;

        return  $isCheckCreate ?  $this->apiResponse($data, 200, 'Update category successfully.') : $this->apiResponse($data, 422, 'Update category failed.');
    }


    /**
     * delete
     *
     * @param  mixed $id
     * @return response
     */
    public function delete(int $id)
    {
        if (is_null($id)) return $this->errorResponse();
        $result = $this->trigger($id);
        if ($result['status']) return $this->errorResponse($result['message']);
        $result = $this->categoryRepo->delete(intval($id));

        return $result ? $this->apiResponse([], 200, 'Delete category successfully') : $this->apiResponse([], 412, 'Delete category failed,try againt');
    }


    public function forgot(int $id)
    {
        if (is_null($id)) return $this->errorResponse();
        $result = $this->categoryRepo->forgot(intval($id));

        return $result ? $this->apiResponse([], 200, 'Delete category successfully') : $this->apiResponse([], 412, 'Delete category failed,try againt');
    }


    private function trigger($id)
    {
        $productsModel = app(ProductRepository::class);
        $result = $productsModel->findByIdCategory($id);
        $isCheckParentId =  $this->categoryRepo->findByIdParent($id);

        if (!is_null($result)) {
            return [
                'status' => true,
                'message' => 'Something went wrong,The list is already attached to the product.'
            ];
        } else if (!is_null($isCheckParentId)) {
            return [
                'status' => true,
                'message' => 'Something went wrong,Category is has childrent.'
            ];
        }
        return [
            'status' => false,
            'message' => ''
        ];
    }
}
