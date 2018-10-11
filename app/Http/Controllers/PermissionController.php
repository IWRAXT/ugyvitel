<?php

namespace App\Http\Controllers;
use App\Permission;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function getPermission()
    {
//        return redirect('/permission')->with(Permission::all());
        return Permission::all();
    }
    public function create()
    {
        return view('people.createPermission');
    }
}
