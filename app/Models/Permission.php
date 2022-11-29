<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'permissions';
    protected $fillable = [
        'name',
    ];
    // public function  role_permissions(): \Illuminate\Database\Eloquent\Relations\HasMany
    // {
    //     return $this->hasMany(RolePermission::class);
    // }
}
