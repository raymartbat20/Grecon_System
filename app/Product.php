<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\{Category,Supplier};

class Product extends Model
{
    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
}
