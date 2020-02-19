<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'type_id');
    }
}
