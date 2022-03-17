<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantImage extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'restaurant_id',
        'image',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class,'restaurant_id','id');
    }
}
