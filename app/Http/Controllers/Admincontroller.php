<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admincontroller extends Controller
{

    public function index()
    {
         return view('ADMIN.share.master');
    }
    

}
