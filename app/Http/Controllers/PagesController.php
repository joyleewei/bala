<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
class PagesController extends Controller{
    public function root(){
        return view('pages.root');
    }
}