<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExportStorage extends Model
{
    use HasFactory;
    protected  $table = 'export_storages';
    protected $fillable = [
        'name',
        'export_amount',
        'product_id',
        'provider_id'
    ];
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function providers(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
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
    public function scopeSearch($query, $request)
    {
        return $query
            ->when($request->has('search'), function ($query) use ($request) {
                $search = $request->query('search');
                $query->where("product_id", "LIKE", "%{$search}%")
                    ->orWhere("provider_id", "LIKE", "%{$search}%");
            });
    }
}
