<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Site;
use File;

class SiteController extends Controller
{
    public function mysite()
    {
        return view('sites.MySite');
    }
    public function index()
    {
        return view('sites.index');
    }
    public function getSites()
    {
        $sites = Site::with('employee')->get();
        return $sites;
    }
    public function create()
    {
        return view('sites.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'mimes:jpeg',
        ]);
        $site = new Site();
        $site->name = request('name');


        if ($request->hasFile('image')) {

            $site->image = $site->name . '.jpg'; //Unique legyen a name
            //StoreAs a storage-ba menti
            //$request->file('image')->storeAs('public/images/',$person->image);
            //Mivel a Vue-ban blob file-ként küldtük el a képet ezért szükséges ez a változtatás
            //Segítségül az Intervention/Image csomagot hívtuk
            $decode = file_get_contents($request['image']);
            $img = Image::make($decode);
            $img->save(storage_path('app/public/images/' . $site->image));
            //Todo: A képet 500x500s formátumba mentse méretarány megtartásával
        }else{
            $site->image ='default-site.jpg';
        }

        $site->address = request('address');
        $site->phone_number = request('phone_number');

        $site->leader = request('leader');
        $site->save();
        return $site;
    }
}
