<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected  $table = 'products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'status',
        'description',
        'image',
        'image_slide',

    ];
    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function product_details(): HasOne
    {
        return $this->hasOne(ProductDetail::class, 'product_id');
    }

    public function  ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
    public function import_details(): BelongsTo
    {
        return $this->belongsTo(ImportDetail::class);
    }
    public function order_details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function scopeSort($query, $request)
    {
        
        return $query
            ->when($request->has("sort"), function ($query) use ($request) {
                $sortBy = '';
                $sortValue = '';

                foreach ($request->query("sort") as $key => $value) {
                    $sortBy = $key;
                    $sortValue = $value;
                }

                $query->orderBy($sortBy, $sortValue);
            });
    }

    public function scopeFilter($query, $request)
    {
        // dd($request->query("filter")["type"]);
        return $query->when($request->has('filter.status'), function ($query) use ($request) {
            $list = explode(",", $request->query("filter")["status"]);
            $query->whereIn("status", $list);
        })
            ->when($request->has('filter.category_id'), function ($query) use ($request) {
                $list = explode(",", $request->query("filter")["category_id"]);
                $query->whereIn("category_id", $list);
            });
    }
    public function scopeSearch($query, $request)
    {
        return $query
            ->when($request->has('search'), function ($query) use ($request) {
                $search = $request->query('search');
                $query
                    ->where("name", "LIKE", "%{$search}%");
            });
    }


    public function scopeSelling($query, $request)
    {
        if (!$request->has('sell')) return $query;
        return $query->whereIn('id', $request['idProductSell']);
    }

    public function scopeStatus($query, $status = 1)
    {
        return $query->where('status', $status);
    }

    public function scopeSortPrice($query,$sort){
        if(@$sort ==null) return $query;

       return $query ->join('product_details','product_details.product_id','=','products.id')->orderBy('price',$sort);
    }
   

}
