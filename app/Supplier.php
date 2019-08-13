<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;


    protected $guarded = [];

    
    protected $primaryKey = 'supplier_id';


    public function getFullName(){
        return "{$this->firstname} {$this->lastname}";
    }
}
