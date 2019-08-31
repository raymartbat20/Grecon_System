<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\{Category,Supplier,Defective,ItemLog};

class Product extends Model
{
    use softDeletes;
    protected $guarded = [];
    protected $primaryKey = 'primary_product_id';

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
    
    public function item_log()
    {
        return $this->hasMany(ItemLog::class,'primary_product_id');
    }
}
