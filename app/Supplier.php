<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Product;

class Supplier extends Model
{
    use SoftDeletes;


    protected $guarded = [];

    
    protected $primaryKey = 'supplier_id';

    public function products(){
        return $this->hasMany(Product::class,'supplier_id');
    }

    public function getFullName(){
        return "{$this->firstname} {$this->lastname}";
    }
}
