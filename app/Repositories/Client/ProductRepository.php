<?php

namespace App\Repositories\Client;

use App\Models\OrderDetail;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository
{
    protected $product;
    protected $ordersDetail;

    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->ordersDetail = app(OrderDetail::class);
        parent::__construct($product);
    }



    public function getAll($request = [])
    {


        return $this->product->with('categories')->with('product_details')
            ->sortPrice(@$request['sort_price'])
            ->status()
            ->withWhereHas('product_details', function ($query) use ($request) {
               
                
                if (!empty(@$request['filter_price'][0])) {
                    $query->where('price', '>=', @$request['filter_price'][0]);
                }
                if (!empty(@$request['filter_price'][1])) {
                    $query->where('price', '<', @$request['filter_price'][1]);
                }
               
              
            })
            ->when($request->has('filter.category_id'), function ($query) use ($request) {

                $query->whereIn('category_id', explode(',', $request->input('filter.category_id')));
            })
            ->with('ratings', function ($query) {
                $query->selectRaw('avg(point) as point_avg, product_id')
                    ->groupBy('product_id');
            })
            ->selling($request)
            ->sort($request)
           
            ->search($request)
            
            ->paginate($request['per_page']);
          
    }
    public function sellProduct()
    {
        return $this->ordersDetail->select('product_id', DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->orderBy('total', 'desc')
            ->limit(10)->get();
    }

    public function findById($id)
    {
        return $this->product->with('categories')->with('product_details')
            ->status()
            ->with('ratings', function ($query) {
                $query->selectRaw('avg(point) as point_avg, product_id')
                    ->groupBy('product_id');
            })->where('id', $id)->get();
    }
}
