<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Statistic;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeGeneratorController extends Controller
{
    public function generate()
    {
        $restaurant = Restaurant::find(Auth::user()->restaurant_id);


        if (!$restaurant) {

            return redirect()->back()->with('error', 'Restaurant not found.');
        }

        try {

            $qrCode = QrCode::size(500)->format('png')->generate(url('qrcode/' . $restaurant->id));
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Failed to generate QR code.');
        }

        return view('restaurant.qrcode', ['qrCode' => $qrCode]);
    }




    public function redirect($restaurant)

    {

        //1- find resturnat by id
        $restaurantData = Restaurant::where('id', $restaurant)->first();

        //2- check iof there is a resturant with this id
        if (!$restaurantData) {
            return 'there is resturant with this link';
        }
        //3- bring all statics
        $statistics = Statistic::where('restaurant_id', $restaurantData->id)->first();


        //3- bring all Subscriptions
        $limits = Subscription::where('restaurant_id', $restaurantData->id)
            ->where('status', 'active')
            ->first()->plan;

        //4- chekc if they reahc limit for scan qrcode
        if ($statistics->count_scans >= $limits->max_scans) {
            return 'blocked';
        }

        //5- incress statistics <count scan qrcode>
        $statistics->count_scans += 1;
        $statistics->save();
        // dd($restaurant);
        return Redirect::route('menu.index', ['restaurantName' => $restaurantData->name]);
    }
}
