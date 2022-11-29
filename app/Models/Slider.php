<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'sliders';
    protected $fillable = [
        'name',
        'description',
        'image_slider',
        'status',
        'url'
    ];



    /**
     * scopeStatus
     *@author tranvannghia021
     * @param  mixed $query
     * @param  mixed $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query, $status)
    {

        switch ($status) {
            case 'Active':
                return $query->where('status', $status);
                break;
            case 'InActive':
                return $query->where('status', $status);
                break;
            default:

                return $query;
        }
    }


    /**
     * scopeSort
     *@author tranvannghia021
     * @param  mixed $query
     * @param  mixed $sort
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSort($query, $sort = 'desc')
    {
        return $query->orderBy('id', $sort);
    }


    /**
     * scopeSearch
     *@author tranvannghia021
     * @param  mixed $query
     * @param  mixed $key
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $key)
    {
        if (is_null($key)) return $query;
        return $query->whereLike(['name', 'status', 'description'], $key);
    }
}
