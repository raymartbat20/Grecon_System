<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\{User,Product};

class Defective extends Model
{
    protected $guarded = [];


    public function product()
    {
        return $this->belongsTo(Product::class,'primary_product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
