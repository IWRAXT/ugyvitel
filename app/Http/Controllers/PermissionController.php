<?php

namespace App\Http\Controllers;
use App\Permission;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function getPermission()
    {
        return Permission::all();
    }
}
