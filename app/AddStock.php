<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\{User,Product};
class AddStock extends Model
{
    protected $guarded = [];


    public function user()
    {
       return $this->belongsTo(User::class,'user_id');
    }

    public function product()
    {
       return $this->belongsTo(Product::class,'primary_product_id');
    }
}
