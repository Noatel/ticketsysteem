<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actie extends Model
{
    protected $table = 'acties';

    public function ticket()
    {
        return $this->belongsToMany('App\Ticket');
    }
}
