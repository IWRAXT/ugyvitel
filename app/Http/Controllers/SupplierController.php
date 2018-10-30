<?php

namespace App\Http\Controllers;

use App\Supplier;
use Auth;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return view('suppliers.index');
    }

    public function getSuppliers()
    {
//        if (Auth::user()->can('isSites')) {
            $suppliers = Supplier::with('cost')->get();
            return $suppliers;
//        } else {
//            $suppliers = Supplier::with('cost')
//                ->where('cost.site', Auth::user()->employee->site->id)
//                ->get(); //Csak azokat a site-okat amik megegyeznek az ő sitejával
//            return $suppliers;
//        }

    }

    public function create(Request $request)
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $supplier = new Supplier();
        $supplier->name = request('name');
        $supplier->fiscal_number = request('fiscal_number');
        $supplier->address = request('address');
        $supplier->webpage_address = request('webpage_address');
        $supplier->contact_name = request('contact_name');
        $supplier->contact_title = request('contact_title');
        $supplier->contact_email = request('contact_email');
        $supplier->contact_phone_number = request('contact_phone_number');
        $supplier->save();
        return response()->json(['supplier' => $supplier, 'notification' => 'A beszállító rögzítve !', 'notificationType' => 'alert-success']);
    }

    public function edit($id)
    {
        $supplier = Supplier::with('cost')->find($id);
        return $supplier;
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::with('cost')->find($id);
        $supplier->name = request('name');
        $supplier->fiscal_number = request('fiscal_number');
        $supplier->address = request('address');
        $supplier->webpage_address = request('webpage_address');
        $supplier->contact_name = request('contact_name');
        $supplier->contact_title = request('contact_title');
        $supplier->contact_email = request('contact_email');
        $supplier->contact_phone_number = request('contact_phone_number');

        $supplier->save();
        return response()->json(['supplier' => $supplier, 'notification' => 'A beszállító sikeresen frissítve!', 'notificationType' => 'alert-success']);
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        //Todo:Splice() jobb megoldás lenne:
        return response()->json(['suppliers' => Supplier::all(), 'notification' => 'A beszállító sikeresen törölve!', 'notificationType' => 'alert-success']);
    }


}
