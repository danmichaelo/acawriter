<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Feature;

class Assignment extends Model
{
    //
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function feature() {
        return $this->belongsTo('App\Feature','feature_id', 'id');
    }

    public function documents() {
        return $this->hasMany('App\Documents', 'assignment_id', 'id');
    }


}
