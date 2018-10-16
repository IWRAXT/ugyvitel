<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return view('people.indexUsers');
    }

    public function getUsers()
    {
        $users =User::with( 'permission')->get();
        return $users;
    }

    public function store(Request $request)
    {
        $user= new User();
        $user->name=request('name');
        $user->email=request('email');
        $user->password=bcrypt(request('password'));


        $user->permission_id=request('permission');

        //Site-ot az új permission hozzáadásánál lehessen beállítani
//        $user->permission_id=request('site');


        $user->save();
        return $user;
    }


    public function update(Request $request, $id){

        $user = User::find($id);

        $user->name=request('name');
        $user->email=request('email');
        $user->password=bcrypt(request('password'));
        $user->permission_id=request('permission');

        return $user;
    }
}
