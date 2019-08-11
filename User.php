<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','first_name','last_name','pesel','number_phone','acctive',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() 
    {
        return $this->belongsToMany(Roles::class, 'roles_has_users', 'users_id', 'roles_id')->withTimestamps();
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } 
        else 
        {
            if ($this->hasRole($roles)) 
            {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function address()
    {
          return $this->belongsTo("App\Address");
    }

     public function group()
    {
        return $this->belongsTo('App\Group');
    }
     public function guardians()
    {
        return $this->hasMany('App\Guardian');
    }

     public function school()
    {
        return $this->belongsTo('App\School');
    }

     public function caregivers()
    {
         return $this->hasOne('App\Caregiver');
    }
    public function subjects()
    {
        return $this->hasMany('App\Subject');
    }
   public function absences()
    {
        return $this->hasMany('App\Absence');
    }
    public function raports()
    {
        return $this->hasMany('App\Raport');
    }
     

     public function class_teacher()
    {
        return $this->belongsTo('App\ClassTeacher');
    }


    public function ivents() 
     {
        return $this->belongsToMany(Ivent::class, 'ivents_has_users', 'users_id', 'ivents_id');
     }
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
}