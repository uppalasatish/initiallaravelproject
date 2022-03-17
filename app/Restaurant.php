<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'code',
        'number',
        'desc',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function image()
    {
        return $this->hasOne(RestaurantImage::class,'restaurant_id','id');
    }
}
