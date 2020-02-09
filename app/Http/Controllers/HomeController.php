<?php
 
namespace App\Http\Controllers;
 
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Province;
use App\City;
use App\Courier;
use DB;
use Kavist\RajaOngkir\Facades\RajaOngkir;
 
class HomeController extends Controller
{

    public function myform()
    {
        $states = Province::pluck('title', 'province_id');
        $couriers = Courier::pluck('title', 'code');
        return view('myform',compact('states', 'couriers'));
    }


    /**
     * Get Ajax Request and restun Data
     *
     * @return \Illuminate\Http\Response
     */
    public function myformAjax($id)
    {
        $cities = DB::table("cities")
                    ->where("province_id",$id)
                    ->pluck("title","city_id");
        return json_encode($cities);
    }
 
    public function submit(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => $request->city_origin,
            'destination'   => $request->city_destination,
            'weight'        => $request->weight,
            'courier'       => $request->courier,
        ])->get();
 
        dd($cost);
    }
}