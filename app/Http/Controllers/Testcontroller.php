<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Testcontroller extends Controller
{
    public function index (){
        return view('Fontend.share.masterFE');
    }
}
