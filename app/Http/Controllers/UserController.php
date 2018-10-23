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
        $user->employee_id=request('employee_id');

        //Site-ot az új permission hozzáadásánál lehessen beállítani
//        $user->permission_id=request('site');


        $user->save();
        return response()->json(['user' => $user, 'notification' => 'A usert sikeresen hozzáadta!', 'notificationType' => 'alert-success']);
    }
    public function edit($id)
    {
        $user = User::with('permission')->find($id);
        return $user;
    }


    public function update(Request $request, $id){

        $user = User::with('permission')->find($id);

        $user->name=request('name');
        $user->email=request('email');
        $user->password=bcrypt(request('password'));
        $user->permission_id=request('permission');

        return response()->json(['user' => $user, 'notification' => 'A user sikeresen frissítve!', 'notificationType' => 'alert-success']);

    }
    public function destroy($id)
    {
        //Todo:Splice() jobb megoldás lenne

        $user = User::find($id);

        $user->delete();
        return response()->json(['users' => User::all(), 'notification' => 'A user sikeresen törölve!', 'notificationType' => 'alert-success']);
    }
}
