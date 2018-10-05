<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Employee;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Image;
use Illuminate\Support\Facades\Storage;
use File;



class EmployeeController extends Controller
{
    public function index()
    {
        return view('people.index');
    }


    public function getPeople()
    {

        $people=Employee::with('user', 'user.permission')->get();
        return $people;
    }

    public function user_id(Request $request,$id)
    {
        $person = Employee::find($id);
        $person->user_id=request('userID');
        $person->save();

        return $person;

    }
//    public function getDirects($id)
//    {
//        return Employee::find($id)->printSubalterns();
//    }



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
        $person->born = request('born');
        if ($request->hasFile('file')) {
            $person->image = $person->email.'.jpg';
            //StoreAs a storage-ba menti
            $request->file('file')->storeAs('public/images/',$person->image);
           //A képet 500x500s formátumba mentse méretarány megtartásával
        }
        $person->address=request('address');
        $person->phone_number =request('phone_number');
        $person->month_salary =request('month_salary');
        $person->definite_employment =request('definite_employment');
        $person->recruitment_date =request('recruitment_date');
        $person->job =request('job');
        $person->comment =request('comment');

        //A felettes nevét jelenítse meg amennyiben van neki (select listából kiválasztva)

        $person->principal_id = request('principal_id');

        //Csak Admin módban lehessan hozzáférést adni a rendszerhez
//        $person->user->permission->name=request('permission.name');


        $person->save();
        return redirect('/people/index')->with('success', 'Person Saved');
    }

    public function edit($id)
    {
        $person = Employee::with('user', 'user.permission')->find($id);
        return view('people.edit', compact('person'));
    }

    public function update(Request $request, $id)
    {

        //Jelenleg default kép helyett új kép feltöltése működik, viszont régi kép átnevezése, és megváltoztatása nem
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

            if($person->image !== 'default.jpg' && $person->image!==$person->email){
                //felül kell írni a file nevét az új e-mailcímre
//                dd(storage_path('app/public/images/'.$person->image));
                File::move(storage_path('app/public/images/'.$person->image),storage_path('app/public/images/'.$person->email.'.jpg'));
                $person->image = $person->email.'.jpg';

            }

        }
        $person->born = request('born');


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if($person->image == 'default.jpg'){
                $person->image = $person->email.'.jpg';
                $file->storeAs('public/images/',$person->image);
            }elseif($person->image!==$person->email){
                //ha nem default és nem ugyan az volt a file név, akkor felül kell írni a file nevét az új e-mailcímre
                File::move(storage_path('app/public/images/'.$person->image),storage_path('app/public/images/'.$person->email.'.jpg'));
                $person->image = $person->email.'.jpg';

            }

        }
        if (request('delete') == 'true') {
            $img_path = 'images/' . $person->image;
            File::delete($img_path);
            $person->image = 'default.jpg';
        }
        $person->address=request('address');
        $person->phone_number=request('phone_number');
        $person->month_salary=request('month_salary');
        $person->definite_employment=request('definite_employment');
        $person->recruitment_date=request('recruitment_date');
        $person->job=request('job');
        $person->comment=request('comment');
        $person->principal_id=request('principal_id');

        $person->save();
        return redirect('/people/index')->with('success', 'Dolgozó adatai frissítve');
    }

    public function destroy($id)
    {
        $person = Employee::find($id);
        $img_path = storage_path('app/public/images/') . $person->image;
        File::delete($img_path);
        $person->delete();
        return Employee::all();
    }
}
