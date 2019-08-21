<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\{User,Product};
class AddStock extends Model
{
    protected $guarded = [];


    public function user()
    {
        $this->belongsTo(User::class,'user_id');
    }

    public function product()
    {
        $this->belongsTo(Product::class,'primary_product_id');
    }
}
