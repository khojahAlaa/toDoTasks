<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'api_token', 
        'first_name', 'last_name', 'photo',
        'role_id', 'dep_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // public function setPasswordAttribute($password)
    // {
    // $this->attributes['password'] = bcrypt($password);
    // }
  


    // One To Many (Inverse) -> one user belonges to one role 
    public function role(){
		return $this->belongsTo('App\Role');
    }
    // One To Many (Inverse) -> one user belonges to one department 
    public function department(){
		return $this->belongsTo('App\Department','dep_id', 'id');
    }
    
    // one to many-> one user has many project
    public function projects(){
		return $this->hasMany('App\Project');
    }
    
    public function projectmanager(){
      return $this->belongsTo('App\Project', 'manager_id','id');

    }


    // one to many-> one user has many attachment
    public function attachment(){
		return $this->hasMany('App\Attachment');
    }
    // many to many-> many user has many taske assigned
    public function tasks(){
      //the second argument is for table name that link between tasks and users in manay to many ralation
    return $this->belongsToMany('App\Task','task_users', 'user_id', 'task_id')
    ->withTimestamps()->withPivot('status_id');

    }

    public function MyTasks(){
      return $this->hasMany('App\MyTask');
    }



}
