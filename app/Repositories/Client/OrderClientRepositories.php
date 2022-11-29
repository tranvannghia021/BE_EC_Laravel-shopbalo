<?php

namespace App\Repositories\Client;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class OrderClientRepositories extends BaseRepository
{
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
        parent::__construct($order);
    }

    public function getAllOrderByCustomer($request)
    {
        $idUser = Auth::user();
        $data = Order::query()
            ->filter($request)
            ->orderBy('id', 'desc')
            ->where('customer_id', $idUser->id)
            ->get();
        return $data;
    }
    public function getAllOrderDetailById($id)
    {
        $data = OrderDetail::query()
            ->where('order_id', $id)
            ->with('products')
            ->get();
        return $data;
    }

    public function storeOrder($request): \Illuminate\Database\Eloquent\Model|bool|\Illuminate\Database\Eloquent\Builder
    {

        $dataRequest = [
            'address_delivery' => $request->address_delivery,
            'customer_id' => $request->customer_id,
            'discount_id' => $request->discount_id,
            'discount_value' => $request->discount_value,
            'staff_id' => $request->staff_id,
            'status' => $request->status,
            'total_price' => $request->total_price,
            'created_order_date' => date('Y-m-d')
        ];
        // dd($dataRequest);
        $arrayDetail = $request->order_detail;
        try {
            $order = Order::query()->create($dataRequest);
            foreach ($arrayDetail as $item) {
                $productId = ProductDetail::query()->where('product_id', '=', $item['id'])->first();
                OrderDetail::query()->create([
                    'order_id' => $order['id'],
                    'product_id' => $item['id'],
                    'amount' => $item['qty'],
                    'price' => $item['price'],
                ]);
                $productId->update([
                    'amount' => (int) $productId['amount'] - (int) $item['qty']
                ]);
            }
        } catch (\Exception $e) {
            return false;
        }
        return Order::query()->find($order['id']);
    }
}
