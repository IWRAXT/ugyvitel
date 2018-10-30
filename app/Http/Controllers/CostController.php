<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cost;
use Auth;

class CostController extends Controller
{
    public function index()
    {
        return view('costs.index');
    }

    public function getCosts()
    {
        if (Auth::user()->can('isSites')) {
            $costs = Cost::with('site', 'supplier', 'cost_type')->get();
            return $costs;
        } else {
            $costs = Cost::with('site', 'supplier', 'cost_type')
                ->where('site_id', Auth::user()->employee->site->id)
                ->get(); //Csak azokat a site-okat amik megegyeznek az ő sitejával
            return $costs;
        }

    }
    public function create(Request $request)
    {
        return view('costs.create');
    }
    public function store(Request $request)
    {
        $cost = new Cost();
        $cost->date = request('date');
        $cost->account_number = request('account_number');
        $cost->comment = request('comment');
        $cost->sum = request('sum');
        $cost->site_id = request('site_id');
        $cost->supplier_id = request('supplier_id');
        $cost->cost_type_id = request('cost_type_id');

        $cost->save();
        return response()->json(['cost' => $cost, 'notification' => 'A Számla hozzáadva a Kiadásokhoz!', 'notificationType' => 'alert-success']);
    }
    public function edit($id)
    {
        $cost = Cost::with('site','supplier', 'cost_type')->find($id);
        return $cost;
    }
    public function update(Request $request,$id)
    {
        $cost = Cost::with('site','supplier', 'cost_type')->find($id);
        $cost->date = request('date');
        $cost->account_number = request('account_number');
        $cost->comment = request('comment');
//        $cost->sum = request('sum');
        $cost->site_id = request('site_id');
        $cost->supplier_id = request('supplier_id');
        $cost->cost_type_id = request('cost_type_id');

        $cost->save();
        return response()->json(['cost' => $cost, 'notification' => 'A Számla sikeresen frissítve!', 'notificationType' => 'alert-success']);
    }
    public function destroy($id)
    {
        $cost = Cost::find($id);
        $cost->delete();
        //Todo:Splice() jobb megoldás lenne:
        return response()->json(['costs' => Cost::all(), 'notification' => 'A számla sikeresen törölve!', 'notificationType' => 'alert-success']);
    }
    public function summary(){
        $summary=0;
        if (Auth::user()->can('isSites')) {
            $costs=Cost::all();
            for ($i=0;$i<count($costs);$i++){
                     $summary+=$costs[$i]->sum;
                }
            return $summary;
        } else {
            $costs = Cost::with('site', 'supplier', 'cost_type')
                ->where('site_id', Auth::user()->employee->site->id)
                ->get(); //Csak azokat a site-okat amik megegyeznek az ő sitejával
            for ($i=0;$i<count($costs);$i++){
                $summary+=$costs[$i]->sum;
            }
            return $summary;
        }
    }


}
