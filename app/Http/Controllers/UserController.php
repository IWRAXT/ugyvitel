<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\User;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('people.indexUsers');
    }

    public function getUsers()
    {

//        if (Auth::user()->can('isSites')) {
            $users =User::with( 'permission','employee')->get();
            return $users;
//        }else{
//            $users =User::with( 'permission', 'employee')
//                ->where('employee.site_id', Auth::user()->employee->site->id)
//                ->get(); //Csak azokat a site-okat amik megegyeznek az ő sitejával
//            return $users;
//        }




    }
    public function getLeaders()
    {
        //Csak a permission_id
        $leaders = User::with('permission')
            ->where('permission_id', 3, 2)
            ->get();
        return $leaders;


    }


    public function store(StoreUser $request)
    {
        $user=new User();
        $user->name=request('name');
        $user->email=request('email');
        $user->password=bcrypt(request('password'));
        $user->permission_id=request('permission');


//        $user=User::create([
//            'name'=> request('name'),
//            'employee'=>request('email'),
//            'password'=>bcrypt(request('password')),
//            'permission_id'=>request('permission'),
//        ])->with('employee');
//        $user->employee->id=request('employee_id');

        $user->save();
        return response()->json(['user' => $user, 'notification' => 'A User hozzáadva a Userstáblához!', 'notificationType' => 'alert-success']);
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
        $user->permission_id=request('permission_id');

        $user->save();

        return response()->json(['user' => $user, 'notification' => 'A user sikeresen frissítve!', 'notificationType' => 'alert-success']);

    }
    public function destroy($id)
    {
        //Todo:Splice() jobb megoldás lenne

        $user = User::find($id);
        $user->employee->user_id='';
        $user->delete();
        return response()->json(['users' => User::all(), 'notification' => 'A user sikeresen törölve!', 'notificationType' => 'alert-success']);
    }
}
