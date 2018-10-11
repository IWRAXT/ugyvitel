<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $user= new User();
        $user->name=request('name');
        $user->email=request('email');
        $user->password=bcrypt(request('password'));


        //Itt ne lehessen új permissiont hozzáadni csak a listából választani

        $user->permission_id=request('permission');
//        $user->employee_id=request('employee');


        //Site-ot az új permission hozzáadásánál lehessen beállítani
//        $user->permission_id=request('site');


        $user->save();
        return $user;
    }
}
