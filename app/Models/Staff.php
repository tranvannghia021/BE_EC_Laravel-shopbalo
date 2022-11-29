<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Role;
use App\Notifications\ForgotPasswordNotification;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Staff extends Model
{
    use Notifiable;
    use HasFactory;
    use HasApiTokens;
    protected  $table = 'staff';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'role_id',
        'first_name',
        'last_name',
        'gender',
        'phone',
        'email',
        'password',
        'avatar',
        'status',
        'address',
        'created_date'

    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function roles(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
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
//                        ->where("first_name", "LIKE", "%{$search}%")
//                    ->orWhere("last_name", "LIKE", "%{$search}%");
                })
                    ->when($request->has('email'), function ($query) use ($request) {
                        $search = $request->query('email');
                        $query
                            ->where("email", "LIKE", "%{$search}%");
                    })
                    ->when($request->has('phone'), function ($query) use ($request) {
                        $search = $request->query('phone');
                        $query
                            ->orWhere("phone", "LIKE", "%{$search}%");
                    });

    }
    public function scopeExistance($query, $request)
    {
        return $query
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

    public function fullName(): Attribute
    {
        $fullName = $this->first_name . ' ' . $this->last_name;

        return Attribute::make(
            get: fn () => $fullName,
            set: fn () => $fullName,
        );
    }
    public function sendPasswordResetNotification($token)
    {

        $url = 'https://spa.test/reset-password?token=' . $token;

        $this->notify(new ForgotPasswordNotification($url));
    }
}
