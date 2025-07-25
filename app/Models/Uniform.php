<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uniform extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'size',
        'color',
        'image',            //add image 
    ];
    public function orders()
{
    return $this->hasMany(Order::class);
}

}
