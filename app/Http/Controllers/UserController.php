<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\StoreUser;
use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('people.indexUsers');
    }

    public function getUsers() //todo:próba join-nal
    {
//        if (Auth::user()->can('isSites')) {
        $users = User::with('permission', 'employee')->get();
        return $users;
//        }else{
//            $users =User::with( 'permission', 'employee')->join('employees','employees.id','=','employee_id')
//                ->where('employees.site_id', Auth::user()->employee->site->id)
//                ->get(); //Csak azokat a site-okat amik megegyeznek az ő sitejával
//            return $users;
//        }


    }

    public function getLeaders() //Todo: Átgondolni
    {

        $leaders = User::with('permission')
            ->where('permission_id', 3, 2)
            ->get();
        return $leaders;


    }


    public function store(StoreUser $request)
    {
        $user = new User();
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->permission_id = request('permission');

        $user->save();
        return response()->json(['user' => $user, 'notification' => 'A User hozzáadva a Userstáblához!', 'notificationType' => 'alert-success']);
    }

    public function edit($id)
    {
        $user = User::with('permission')->find($id);
        return $user;
    }


    public function update(Request $request, $id)
    {

        $user = User::with('permission')->find($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->permission_id = request('permission_id');

        $user->save();

        return response()->json(['user' => $user, 'notification' => 'A user sikeresen frissítve!', 'notificationType' => 'alert-success']);

    }

    public function destroy($id)
    {

        if ($id == 2) {
            return response()->json(['notification' => 'A user a Kft vezetője nem lehet törölni!', 'notificationType' => 'alert-danger']);
        }
        if ($id == 1) {
            return response()->json(['notification' => 'A user a rendszer Adminja nem lehet törölni!', 'notificationType' => 'alert-danger']);
        }

        $user = User::find($id);
        $user->employee->user_id = '';

        //ha telephely leader akkor a site leader_id->igazgatóság főnöke fennhatóságba lesz a site
        if ($user->employee->site->leader_id == $user->employee->id) {
            $user->employee->site->leader_id = 2;
        }

        $user->delete();
        //Todo:Splice() jobb megoldás lenne:
        return response()->json(['users' => User::all(), 'notification' => 'A user sikeresen törölve!', 'notificationType' => 'alert-success']);
    }
}
