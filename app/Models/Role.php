<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'status'
    ];
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
        return $query->when($request->has('filter.status'), function ($query) use ($request) {
            $list = explode(",", $request->query("filter")["status"]);
            $query->whereIn("status", $list);
        });
    }
    public function scopeSearch($query, $request)
    {
        return $query
            ->when($request->has('name'), function ($query) use ($request) {
                $search = $request->query('name');
                $query->where("name", "LIKE", "%{$search}%");
            });
    }
    public function  role_permissions(): HasMany
    {
        return $this->hasMany(RolePermission::class);
    }


}
