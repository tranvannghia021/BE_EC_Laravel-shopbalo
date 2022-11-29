<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
    use HasFactory;
    use HasApiTokens;
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'phone',
        'email',
        'password',
        'point',
        'avatar',
        'status',
        'address',
        'created_date'


    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function  orders(): HasMany
    {
        return $this->hasMany(Order::class);
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
            ->when($request->has('filter.role_id'), function ($query) use ($request) {
                $list = explode(",", $request->query("filter")["role_id"]);
                $query->whereIn("role_id", $list);
            });
    }
    public function scopeSearch($query, $request)
    {
        return $query
            ->when($request->has('fullname'), function ($query) use ($request) {
                $search = $request->query('fullname');
                $query
                    ->whereLike([DB::raw("CONCAT(first_name,' ',last_name)")], $search);
            })
            ->when($request->has('email'), function ($query) use ($request) {
                $search = $request->query('email');
                $query
                    ->where("email", "LIKE", "%{$search}%");
            })
            ->when($request->has('phone'), function ($query) use ($request) {
                $search = $request->query('phone');
                $query
                    ->where("phone", "LIKE", "%{$search}%");
            });
    }
}
