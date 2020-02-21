<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $guarded = [];

     public function user()
    {
        return $this->hasMany('App\User');
    }
}


