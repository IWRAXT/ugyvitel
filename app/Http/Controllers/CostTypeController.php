<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cost_type;
use Auth;

class CostTypeController extends Controller
{


    public function getCost_types()
    {
//        if (Auth::user()->can('isSites')) {
            $cost_types = Cost_type::with('costs')->get();
            return $cost_types;
//        } else {
//            $cost_types = Cost_type::with('cost')
//                ->where('cost.site', Auth::user()->employee->site->id)
//                ->get(); //Csak azokat a site-okat amik megegyeznek az ő sitejával
//            return $cost_types;
//        }

    }
    public function create(Request $request)
    {
        return view('costs.types.create');
    }
    public function store(Request $request)
    {
        $cost_type = new Cost_type();
        $cost_type->name = request('name');
        $cost_type->group = request('group');

        $cost_type->save();
        return response()->json(['cost_type' => $cost_type, 'notification' => 'A kidás típus hozzáadva a Kiadásokhoz!', 'notificationType' => 'alert-success']);
    }
    public function edit($id)
    {
        $cost_type = Cost_type::with('costs')->find($id);
        return $cost_type;
    }
    public function update(Request $request,$id)
    {
        $cost_type = Cost_type::with('costs')->find($id);
        $cost_type->name = request('name');
        $cost_type->group = request('group');

        $cost_type->save();
        return response()->json(['costs' => $cost_type, 'notification' => 'A kiadás típus sikeresen frissítve!', 'notificationType' => 'alert-success']);
    }
    public function destroy($id)
    {
        $cost_type = Cost_type::find($id);
        $cost_type->delete();
        //Todo:Splice() jobb megoldás lenne:
        return response()->json(['cost_types' => Cost_type::all(), 'notification' => 'A számla sikeresen törölve!', 'notificationType' => 'alert-success']);
    }


}


