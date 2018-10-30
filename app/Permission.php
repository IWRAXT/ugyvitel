<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'id', 'name', 'sites',
    ];
    public function users(){
        return $this->hasMany(User::class);
    }
    public function printUsers()
    {
        $users = $this->users;
        $result = [];
        $j=0;
        for ($i = 0, $iMax = count($users); $i < $iMax; $i++) {
            $user = $users[$i];
                $result[$j] = $user;
                $j++;
        }

        return $result;
    }




}
