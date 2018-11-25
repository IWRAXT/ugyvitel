<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password', 'image','permission_id', 'employee',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    public function permission(){
        return $this->belongsTo(Permission::class);
    }
    public function employee(){
        return $this->hasOne(Employee::class);
    }
    //Már van egy kapcsolat a User és az Employee modellben szóval elég a visszafelé hivatkozó hasOne
}
