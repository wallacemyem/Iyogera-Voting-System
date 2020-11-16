<?php

namespace App\Http\Controllers;

use App\Parents;
use App\Position;
use App\User;
use Hash;
use Auth;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = translate('Position');

        return view('backend.'.Auth::user()->role.'.position.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.'.Auth::user()->role.'.position.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $user = new Position;

            $user->name = $request->name;
            $user->election_id = $request->election_id;
            $user->school_id = school_id();

            if($user->save()) {

            flash(translate('position_created'))->success();
                }else{
                flash(translate('error_occurred'))->error();
            }
            return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Parent  $parent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Position::find($id);
        return view('backend.'.Auth::user()->role.'.parent.children', compact('user'));
    }

    public function list()
    {
        return view('backend.'.Auth::user()->role.'.position.list')->render();
    }

    /**
     * Show the form for editing the specified resource.
     *s
     * @param  \App\Parent  $parent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Position::find($id);
        return view('backend.'.Auth::user()->role.'.position.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parent  $parent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Position::find($id);

        $user->name = $request->name;
        $user->election_id = $request->election_id;
        $user->school_id = school_id();

        if($user->save()) {

            flash(translate('position_updated'))->success();
        }else{
            flash(translate('error_occurred'))->error();
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parent  $parent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Position::find($id);
        $user->status = 0;
        $user->save();
         flash(translate('position_has_been_deleted_successfully'))->success();
         return redirect()->back();

    }
}
