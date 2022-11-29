<?php

namespace App\Services\Client;

use App\Http\Resources\Admin\Product\ProductResource;
use App\Http\Traits\ApiResponse;
use App\Repositories\Client\ProductRepository;

class ProductService
{
    use ApiResponse;
    protected $productRepo;
    protected $limit = 10;
    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }


    public function getAll($request)
    {

        $data = [];
        $request['per_page'] = $request['per_page'] === null ? $this->limit : $request['per_page'];
        $request['filter_price'] = [
            @$request->start_price,
            @$request->end_price,
        ];

        if ($request->has('sell')) {
            $productSell = $this->productRepo->sellProduct();
            $idProducts = array_column($productSell->toArray(), 'product_id');
            if (!is_null($idProducts)) {
                $request['idProductSell'] = $idProducts;
            }
        }
        $products = $this->productRepo->getAll($request);
        if (!is_null($products)) {
            $data = ProductResource::collection($products)->response()->getData();
        }
        return $this->apiResponse($data, 200, 'List Products');
    }

    public function show($id)
    {
        if (is_null($id)) return $this->apiResponse([], 401, _('validation.required', ['attribute' => 'id']));
        $data = [];
        $product = $this->productRepo->findById($id);

        if (!is_null($product)) {
            $data =  ProductResource::collection($product)->response()->getData();
        }
        return $this->apiResponse($data, 200, 'Show products');
    }

    public function showListProduct($id)
    {
        if (is_null($id)) return $this->apiResponse([], 401, _('validation.required', ['attribute' => 'id']));
        $data = [];
        $product = $this->productRepo->find($id);

        if (!is_null($product)) {
            $data = new ProductResource($product);
        }
        return $this->apiResponse($data, 200, 'Show products');
    }
}
