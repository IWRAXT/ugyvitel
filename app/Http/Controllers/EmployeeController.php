<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use File;
use Illuminate\Support\Facades\DB;
use Image;

class EmployeeController extends Controller
{
    public function index()
    {
        $people = Employee::all();
        return view('people.index', compact('people'));
    }

    public function getPeople()
    {
        return Employee::all();
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
        $person->last_name = request('lastname');
        $person->first_name = request('firstname');
//        if (DB::table('people')->where('email', request('email'))->exists()) {
//            return back()->with('success', 'Már létezik ez az emailcím az adatbázisban');
//        } else {
//            $person->email = request('email');
//        }
        $person->born = request('born');
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $person->image = $person->lastname.'.jpg';

//            $path=$request->file->store('images');
//            $img = Image::make($path);
//            $img->resize(500, 500);
//            $img->save();
//
//            $img->

            $file->move(public_path('images'), $person->image);
        }
        $person->address=request('address');
        $person->phone_number =request('phone_number');
        $person->month_salary =request('month_salary');
        $person->definite_employment =request('definite_employment');
        $person->recruitment_date =request('recruitment_date');
        $person->comment =request('comment');
        $person->principal_id = request('principal_id');

        $person->save();
        return redirect('/people/index')->with('success', 'Person Saved');
    }

    public function edit($id)
    {
        $person = Employee::find($id);
        return view('people.edit', compact('person'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'file' => 'mimes:jpeg',
        ]);
        $person = Employee::find($id);
        $person->name = request('name');
        if (DB::table('people')
                ->where('email', request('email'))
                ->exists()
            && request('email') !== $person->email) {
            return back()->with('success', 'Már létezik ez az emailcím az adatbázisban');
        } else {
            $person->email = request('email');
            rename(public_path('./images/' . $person->image), './images/' . $person->email . '.jpg');
            $person->image = $person->email . '.jpg';
        }
        $person->born = request('born');
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $person->image = $person->email . '.jpg';
            // $img = Image::make('./images/'.$person->image);
            //$img->resize(500, 500);
            $file->move(public_path('./images/'), $person->image);
        }
        if (request('delete') == 'true') {
            $img_path = './images/' . $person->image;
            File::delete($img_path);
            $person->image = 'default.jpg';
        }
        $person->save();
        return redirect('/people/index')->with('success', 'Dolgozó adatai frissítve');
    }

    public function destroy($id)
    {
        $person = Employee::find($id);
        $img_path = './images/' . $person->image;
        File::delete($img_path);
        $person->delete();
        return Employee::all();
    }
}
