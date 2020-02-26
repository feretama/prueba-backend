<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $guarded=[];

    protected $hidden = [
        'pass'
    ];


    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }
}
