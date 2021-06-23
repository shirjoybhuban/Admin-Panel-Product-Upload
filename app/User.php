<?php

namespace App;

use App\Model\Seller;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasRoles,HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email','phone','user_type', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    public function roles()
//    {
//        return $this
//            ->belongsToMany('App\Role')
//            ->withTimestamps();
//    }
    /*public function role()
    {
        return $this->belongsTo('App\Role');
    }*/

//    public function users()
//    {
//        return $this
//            ->belongsToMany('App\User')
//            ->withTimestamps();
//    }

    /*public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'This action is unauthorized.');
    }*/

    /*public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }*/

    /*public function hasRole($role)
    {
        //dd($role);
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }*/
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    public function seller()
    {
        return $this->hasOne('App\Model\Seller','user_id');
    }
    public function shop()
    {
        return $this->hasOne('App\Model\Shop','user_id');
    }
    public function products()
    {
        return $this->hasMany('App\Model\Product','user_id');
    }
}
