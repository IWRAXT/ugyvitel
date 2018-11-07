<?php

namespace App\Http\Controllers;


use App\Employee;
use App\User;
use App\Permission;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Input;
use Intervention\Image\ImageManagerStatic as Image;


class EmployeeController extends Controller
{
    public function index()
    {
        return view('people.index');
    }

    public function getPeople()
    {
        if (Auth::user()->can('isSites')) {
            $people = Employee::with('user', 'user.permission', 'site', 'site.leader')->get();
            return $people;
        } else {
            $people = Employee::with('user', 'user.permission', 'site', 'site.leader')
                ->where('site_id', Auth::user()->employee->site->id)
                ->get(); //Csak azokat a site-okat amik megegyeznek az ő sitejával
            return $people;
        }

    }

    public function user_id(Request $request, $id)
    {
        $person = Employee::find($id);
        $person->user_id = request('userID');
        $person->save();
        return response()->json(['person' => $person, 'notification' => 'User jog hozzáadva!', 'notificationType' => 'alert-success']);
    }

    public function delete_user_id($id)
    {
        $person = Employee::find($id);
        $person->user->id = null;
        $person->save();
        return response()->json(['person' => $person, 'notification' => 'User jog törölve!', 'notificationType' => 'alert-success']);
    }

    public function getDirects($id)
    {
        return Employee::find($id)->printSubalterns();
    }


    public function create(Request $request)
    {
        return view('people.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'mimes:jpeg',
        ]);
        $person = new Employee();
        $person->last_name = request('last_name');
        $person->first_name = request('first_name');
        if (DB::table('employees')->where('email', request('email'))->exists()) {
            return back()->with('success', 'Már létezik ez az emailcím az adatbázisban');
        } else {
            $person->email = request('email');
        }
        if ($request->hasFile('image')) {

            $person->image = $person->email . '.jpg';
            //StoreAs a storage-ba menti
            //$request->file('image')->storeAs('public/images/',$person->image);
            //Mivel a Vue-ban blob file-ként küldtük el a képet ezért szükséges ez a változtatás
            //Segítségül az Intervention/Image csomagot hívtuk
            $decode = file_get_contents($request['image']);
            $img = Image::make($decode);
            $img->save(storage_path('app/public/images/' . $person->image));
            //Todo: A képet 500x500s formátumba mentse méretarány megtartásával
        } else {
            $person->image = 'default.jpg';
        }
        $person->birth = request('birth');
        $person->address = request('address');
        $person->phone_number = request('phone_number');
        $person->month_salary = request('month_salary');
        $person->recruitment_date = request('recruitment_date');
        $person->job = request('job');
        $person->comment = request('comment');
        $person->site_id = request('site_id');
        $person->save();
        return response()->json(['person' => $person, 'notification' => 'Az új munkatárs sikeresen hozzáadva!', 'notificationType' => 'alert-success']);
        //people/indexre kéne mutatnia
    }

    public function edit($id)
    {
        $person = Employee::with('user', 'user.permission', 'site.leader')->find($id);
        return $person;
    }

    public function edit_mount() //Auth User
    {
        $id = Auth::user()->employee->id;
        $person = Employee::with('user', 'user.permission', 'site', 'site.leader')->find($id);
        return $person;

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'file' => 'mimes:jpeg',
        ]);
        $person = Employee::find($id);
        $person->last_name = request('last_name');
        $person->first_name = request('first_name');
        //Todo: DB-t átírni modellekre
        if (DB::table('employees')
                ->where('email', request('email'))
                ->exists()
            && request('email') !== $person->email) {
            return back()->with('success', 'Már létezik ez az emailcím az adatbázisban');
        } else {
            $person->email = request('email');

            if ($person->image !== 'default.jpg' && $person->image !== $person->email) {
                //felül kell írni a file nevét az új e-mailcímre
                File::move(storage_path('app/public/images/' . $person->image), storage_path('app/public/images/' . $person->email . '.jpg'));
                $person->image = $person->email . '.jpg';
            }
        }
        $person->birth = request('birth');
        if ($request->hasFile('file')) {
            $decode = file_get_contents($request['image']); //Blob file-t küldtünk a Vue-ból
            $img = Image::make($decode);

            if ($person->image == 'default.jpg') {
                $person->image = $person->email . '.jpg';
                $img->save(storage_path('app/public/images/' . $person->image)); //mentem a mostanit
            } else
                //ha nem default és nem ugyan az volt a file név, akkor felül kell írni a file nevét az új e-mailcímre
                File::delete(storage_path('app/public/images/' . $person->image)); //törlöm az előző file-t
            $person->image = $person->email . '.jpg';
            $img->save(storage_path('app/public/images/' . $person->image)); //mentem a mostanit
        }
        if (request('delete') == 'true' && $person->image != 'default.jpg') {
            $img_path = 'app/public/images/' . $person->image;
            File::delete(storage_path($img_path));
            $person->image = 'default.jpg';
        }
        $person->address = request('address');
        $person->phone_number = request('phone_number');
        $person->month_salary = request('month_salary');
        $person->recruitment_date = request('recruitment_date');
        $person->job = request('job');
        $person->comment = request('comment');
        $person->site_id = request('site_id');

        $person->save();
        return response()->json(['person' => $person, 'notification' => 'A dolgozói adatok sikeresen fissítve!', 'notificationType' => 'alert-success']);
    }

    public function destroy($id)
    {


        $person = Employee::find($id);

        if ($person->user->permission == 2) {
            return response()->json(['notification' => 'A user a Kft vezetője nem lehet törölni!', 'notificationType' => 'alert-danger']);
        } elseif ($person->user->permission == 1) {
            return response()->json(['notification' => 'A user a rendszer Adminja nem lehet törölni!', 'notificationType' => 'alert-danger']);
        } else {
            if ($person->image !== "default.jpg") {
                $img_path = storage_path('app/public/images/') . $person->image;
                File::delete($img_path);
            }
            //Ha az employee törlődik törlődjön a hozzátartozó user is
            if ($person->user->id !== null) {
                if ($person->site->leader_id == $id) {

//                    $boss=Permission::find(2)->users->employee->id; //Printuserben kéne keresni
                    $person->site->leader_id = 2; //ha leader akkor törlődjön a telephelyekből is->igazgatóság főnöke fennhatóságba lesz a site
                }
                User::find($person->user->id)->delete();
            }

            $person->delete();

            //Todo:Splice() jobb megoldás lenne mint ez:
            if (Auth::user()->can('isSites')) {
                $people = Employee::with('user', 'user.permission', 'site', 'site.leader')->get();
                return response()->json(['people' => $people, 'notification' => 'A dolgozó sikeresen törölve!', 'notificationType' => 'alert-success']);
            } else {
                $people = Employee::with('user', 'user.permission', 'site', 'site.leader')
                    ->where('site_id', Auth::user()->employee->site->id)
                    ->get(); //Csak azokat a site-okat amik megegyeznek az ő sitejával
                return response()->json(['people' => $people, 'notification' => 'A dolgozó sikeresen törölve!', 'notificationType' => 'alert-success']);;
            }
        }


    }
}
