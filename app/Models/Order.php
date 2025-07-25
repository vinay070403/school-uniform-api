<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     protected $fillable = [
        'student_id',
        'uniform_id',
        'quantity',
        'total_price',
        'status',
        'order_date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function uniform()
    {
        return $this->belongsTo(Uniform::class);
    }

}
