<?php

namespace App\Http\Controllers;
use App\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function getSite()
    {
        return Site::all();
    }
}
