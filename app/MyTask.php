<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyTask extends Model
{
    //
    protected $fillable = [
      'name',
      'description',
      'startDate',
      'dueDate',
      'is_done',
      'user_id',
     

  ];

    public function user(){
		return $this->belongsTo('App\User','user_id');
    }
}
