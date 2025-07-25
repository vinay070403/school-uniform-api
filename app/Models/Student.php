<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // Mass assignment ke liye fillable fields define karo
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];
    public function orders()
{
    return $this->hasMany(Order::class);
}

}
