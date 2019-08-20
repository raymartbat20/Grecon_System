<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Product;

class Category extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $primaryKey = 'category_id';


    public function product(){
        return $this->hasMany(Product::class, 'category_id');
    }
}
