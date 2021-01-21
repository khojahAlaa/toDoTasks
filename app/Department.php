<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //

    protected $fillable = [
        'name',
    ];
    // one to many-> one department has many users
    public function users(){
		return $this->hasMany('App\User','dep_id', 'id');
    }
    

    public function projects(){
		return $this->hasMany('App\Project','dep_id', 'id');
    }
}
