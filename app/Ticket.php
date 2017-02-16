<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    public function customers()
    {
        return $this->belongsToMany('App\Customer');
    }
    public function acties()
    {
        return $this->belongsToMany('App\Actie');
    }

    public function hardware()
    {
        return $this->belongsToMany('App\Hardware');
    }
}
