<?php

namespace App\Http\Controllers;


use App\Employee;
use App\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;


class EmployeeController extends Controller
{
    public function index()
    {
        return view('people.index');
    }

    public function getPeople()
    {
        $people = Employee::with('user', 'user.permission', 'principal')->get();
        return $people;
    }

    public function user_id(Request $request, $id)
    {
        $person = Employee::find($id);
        $person->user_id = request('userID');
        $person->save();
        return $person;
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
        }
        $person->born = request('born');
        $person->address = request('address');
        $person->phone_number = request('phone_number');
        $person->month_salary = request('month_salary');
        $person->definite_employment = request('definite_employment');
        $person->recruitment_date = request('recruitment_date');
        $person->job = request('job');
        $person->comment = request('comment');
        $person->principal_id = request('principal_id');
        $person->save();
        return $person;
    }

    public function edit($id)
    {
        $person = Employee::with('user', 'user.permission')->find($id);
        return view('people.edit', compact('person'));
    }
//    public function edit_mount($id)
//    {
//        $person = Employee::with('user', 'user.permission')->find($id);
//        return view('people.edit', compact('person'));
//    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'file' => 'mimes:jpeg',
        ]);
        $person = Employee::find($id);
        $person->last_name = request('last_name');
        $person->first_name = request('first_name');
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
        $person->born = request('born');
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
        if (request('delete') == 'true') {
            $img_path = 'images/' . $person->image;
            File::delete($img_path);
            $person->image = 'default.jpg';
        }
        $person->address = request('address');
        $person->phone_number = request('phone_number');
        $person->month_salary = request('month_salary');
        $person->definite_employment = request('definite_employment');
        $person->recruitment_date = request('recruitment_date');
        $person->job = request('job');
        $person->comment = request('comment');
        $person->principal_id = request('principal_id');

        $person->save();
        return $person;
//        return redirect('/people/index')->with('success', 'Dolgozó adatai frissítve');
    }

    public function destroy($id)
    {
        $person = Employee::find($id);
        if ($person->image !== "default.jpg") {
            $img_path = storage_path('app/public/images/') . $person->image;
            File::delete($img_path);
        }
//Ha az employee törlődik törlődjön a hozzátartozó user is
        if ($person->user_id!==null){
            User::find($person->user_id)->delete();
        }

        $person->delete();
        return Employee::all();
    }
}
