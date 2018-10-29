<?php

namespace App\Http\Controllers;

use App\Site;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests\StoreSite;

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


        if (Auth::user()->can('isSites')) {
            $sites = Site::with('leader')->get();
            return $sites;
        }else{
            $sites = Site::with('leader')
                ->where('id', Auth::user()->employee->site->id)
                ->get(); //Csak azokat a site-okat amik megegyeznek az ő sitejával
            return $sites;
        }



    }

    public function getEmployees($id)
    {
        return Site::find($id)->printEmployees();
    }

    public function getAuthUserSiteId()
    {
        return Auth::user()->employee->site->id;
    }

    public function create()
    {
        return view('sites.create');
    }

    public function store(StoreSite $request)
    {
//        $this->validate($request, [
//            'file' => 'mimes:jpeg',
//        ]);



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
        } else {
            $site->image = 'default-site.jpg';
        }

        $site->address = request('address');
        $site->phone_number = request('phone_number');

        $site->leader_id = request('leader_id');
        $site->save();

        return response()->json(['site' => $site, 'notification' => 'A telephely sikeresen rögzítve!', 'notificationType' => 'alert-success']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'file' => 'mimes:jpeg',
        ]);
        $site = Site::find($id);

        //Todo:DB-t átírni modellekre
        if (DB::table('sites')
                ->where('name', request('name'))
                ->exists()
            && request('name') !== $site->name) {
            return back()->with('success', 'Már létezik ez a telephely  az adatbázisban');
        } else {
            $site->name = request('name');

            if ($site->image !== 'default-site.jpg' && $site->image !== $site->name) {
                //felül kell írni a file nevét az új telephelynévre
                File::move(storage_path('app/public/images/' . $site->image), storage_path('app/public/images/' . $site->name . '.jpg'));
                $site->image = $site->name . '.jpg';
            }
        }

        if ($request->hasFile('file')) {
            $decode = file_get_contents($request['image']); //Blob file-t küldtünk a Vue-ból
            $img = Image::make($decode);

            if ($site->image == 'default-site.jpg') {
                $site->image = $site->name . '.jpg';
                $img->save(storage_path('app/public/images/' . $site->image)); //mentem a mostanit
            } else
                //ha nem default és nem ugyan az volt a file név, akkor felül kell írni a file nevét az új telephelynévre
                File::delete(storage_path('app/public/images/' . $site->image)); //törlöm az előző file-t
            $site->image = $site->name . '.jpg';
            $img->save(storage_path('app/public/images/' . $site->image)); //mentem a mostanit
        }
        if (request('delete') == 'true' && $site->image != 'default-site.jpg') {
            $img_path = 'app/public/images/' . $site->image;
            File::delete(storage_path($img_path));
            $site->image = 'default-site.jpg';
        }
        $site->address = request('address');
        $site->phone_number = request('phone_number');
        $site->leader_id = request('leader_id');


        $site->save();
        return response()->json(['site' => $site, 'notification' => 'A telephely sikeresen frissítve!', 'notificationType' => 'alert-success']);
    }

    public function edit($id)
    {
        $site = Site::with('leader')->find($id);
        return $site;
    }

    public function destroy($id)
    {
        //Todo:Splice() jobb megoldás lenne
        //Ha a telephely törlődik figyelmeztessen, ha van még a telephelyen dolgozó munkatársak akik a rendszerben maradtak
        if (Site::find($id)->employees) {
            return response()->json(['notification' => 'A telephelyhez dolgozók tartoznak, nem lehet törölni', 'notificationType' => 'alert-danger']);
        } else {
            $site = Site::find($id);
            if ($site->image !== "default-site.jpg") {
                $img_path = storage_path('app/public/images/') . $site->image;
                File::delete($img_path);
            }
            $site->delete();
            return response()->json(['site' => Site::all(), 'notification' => 'A telephely sikeresen törölve!', 'notificationType' => 'alert-success']);

        }

    }
}
