<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\Http\AdminUsersControllers;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'photo_id', 'role_id', 'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {

        return $this->belongsTo('App\Role');
    }

    public function photo() {

        return $this->belongsTo('App\Photo');
    }



    public function isAdmin(){

        if($this->role->name == "administrator" && $this->is_active == 1){ //if the role name is equal to "administrator"
        // adding "is_active", means that only active users can access the dashboard.
            return true;
        }

        return false; //if not, going to return false

    }

    public function posts() {

        return $this->hasMany('App\Post');
    }

}
