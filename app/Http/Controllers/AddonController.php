<?php

namespace App\Http\Controllers;

use App\Addon;
use App\Menu;
use Illuminate\Http\Request;
use ZipArchive;
use DB;
use Auth;
use Session;

class AddonController extends Controller
{

    public function onstart(){
        if ( Auth::check()){
        Auth::logout(); 

        session(['role' => '']); 

        Session::flush();

        return view('vote.backend.vue');
            }else{
            return view('vote.backend.vue');
    }

    public function vote(Request $request)
    {
        $add = $request->add;

    }
}
