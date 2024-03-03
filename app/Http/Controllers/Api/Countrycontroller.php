<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class Countrycontroller extends Controller
{
    public function indexcountry(){
        $country = Country::all();

       return response()->json([

            'country'   =>$country,

        ]);
    }
}
