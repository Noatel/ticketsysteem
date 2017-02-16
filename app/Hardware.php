<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hardware extends Model
{
    protected $table = 'hardware';

    public function tickets()
    {
        return $this->belongsToMany('App\Ticket');
    }
}
