<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Role extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $primaryKey = 'role_id';

    public function user()
    {
        return $this->belongsToMany(User::class, 'role_id');
    }
}
