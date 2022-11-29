<?php

namespace App\Repositories\Admin;

use App\Http\Resources\Admin\Product\ProductResource;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
    protected $product;
    protected int $paginate = 10;
    public function __construct(Product $product)
    {
        $this->product = $product;
        parent::__construct($product);
    }
    public function getAllProduct($request)
    {
        if ($request->has('get-all')) {
            $data = Product::query()->get();
            return ProductResource::collection($data)->response()->getData();
        } else {
            $data = Product::query()
                ->with('categories')
                ->with('product_details')
                ->sort($request)
                ->search($request)
                ->filter($request)
                ->paginate($this->paginate);
            return ProductResource::collection($data)->response()->getData();
        }
    }
    public function showProduct($id)
    {
        $data = Product::query()->with('product_details')->find($id);
        return ProductResource::make($data);
    }
    public function storeProduct($request)
    {

        // dd($request);
        try {
            $product = Product::query()->create($request);
            ProductDetail::query()->create([
                'product_id' => $product->id,
                'code_color' => $request['code_color'],
                'amount' => $request['amount'],
                'price' => $request['price']
            ]);
        } catch (\Exception $e) {
            return false;
        }
        return Product::query()->find($product['id']);
    }

    public function updateProduct($request, $id)
    {
        $product =  Product::query()->where('id', '=', $id)->first();
        $product->update($request->all());
        return $product;
    }

    public function updateProductDetail($request, $id)
    {
        $productDetail = ProductDetail::query()->where('product_id', '=', $id)->first();
        $productDetail->update($request->all());
        return $productDetail;
    }
    public function delete($id)
    {
        $product = Product::query()->find($id);
        $product->delete();
        return $product;
    }


    public function findByIdCategory($id)
    {
        return $this->product->where('category_id', $id)->first();
    }
}
