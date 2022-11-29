<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Rating extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ratings';
    protected $fillable = [
        'customer_id',
        'product_id',
        'point',
        'status',
        'content',
        'image',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }


    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    /**
     * scopeSearch
     *
     * @param  mixed $query
     * @param  mixed $key
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $key)
    {
        if (is_null($key)) return $query;
        return $query->whereLike([
            'point', 'customers.last_name', 'customers.first_name',
            'customers.email', 'customers.address', 'products.name', 'products.description'
        ], $key);
    }


    /**
     * sortStatus
     *
     * @param  mixed $query
     * @param  mixed $sort
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortStatus($query, $sort)
    {
        if ($sort == 'pending' || $sort == 'pushlished') return $query->where('status', $sort);
        return $query;
    }

    /**
     * sortPoint
     *
     * @param  mixed $query
     * @param  mixed $sort
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortPoint($query, $sort)
    {
        return $query->orderBy('point', $sort);
    }



    public function scopeFilterProductById($query, $filter)
    {
        if (is_null($filter)) return $query;
        $list = explode(",", $filter);
        return $query->whereIn('product_id', $list);
    }
}
