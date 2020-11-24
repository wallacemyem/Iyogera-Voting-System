<?php

namespace App\Http\Controllers;

use App\Addon;
use App\Menu;
use Illuminate\Http\Request;
use ZipArchive;
use DB;
use Auth;
use Session;
use App\Result;

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
        }

    public function vote(Request $request)
    {
        $add = $request->add;

    }

    public function results()
    {
        return view('vote.backend.selectr');

    }

    public function onresult(Request $request)
    {
        $election_id = $request->election_id;

        $nom = Nominee::where('election_id', $election_id)->get();
        return view('vote.backend.results', compact('nom'));

    }
}
