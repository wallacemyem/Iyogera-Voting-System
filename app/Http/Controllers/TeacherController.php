<?php

namespace App\Http\Controllers;

use App\user;
use App\userPermission;
use Illuminate\Http\Request;
use Hash;
use Auth;

class TeacherController extends Controller
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
        $title = translate('user');
        return view('backend.'.Auth::user()->role.'.user.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.'.Auth::user()->role.'.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(count(User::where('email', $request->email)->get()) == 0) {
            $user = new User;
            $user->first_name = $request->first_name;
            $user->other_name = $request->other_name;
            $user->middle_name = $request->middle_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = "voter";
            $user->school_id = school_id();
            $user->phone = $request->phone;
            $user->address = $request->address;
            // $user->birthday = strtotime($request->birthday);
            $user->gender = $request->gender;
            $user->blood_group = $request->blood_group;
            if($user->save()) {
                $user = new user;
                $user->department_id = $request->department;
                $user->designation = $request->designation;
                $user->user_id = $user->id;
                $user->school_id = school_id();
                $user->save();

                //$this->add_to_user_permission($user->id);

                $data = array(
                    'status' => true,
                    'notification' => translate('user_added_successfully')
                );
            }
        }else {
            $data = array(
                'status' => false,
                'notification' => translate('email_duplication')
            );
        }

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show($department_id)
    {
        return view('backend.'.Auth::user()->role.'.user.list', compact('department_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = user::find($id);
        return view('backend.'.Auth::user()->role.'.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = user::find($id);
        if(count(User::where('email', $request->email)->where('id', '!=', $user->user->id)->get()) == 0) {
            $user = User::find($user->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = "user";
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->blood_group = $request->blood_group;
            if($user->save()) {
                $user->department_id = $request->department;
                $user->designation = $request->designation;
                $user->school_id = school_id();
                $user->save();

                $data = array(
                    'status' => true,
                    'notification' => translate('user_updated_successfully')
                );
            }
        }else {
            $data = array(
                'status' => false,
                'notification' => translate('email_duplication')
            );
        }

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = user::find($id);
        $user->delete();
        $user->user->delete();
        return array(
            'status' => true,
            'notification' => translate('user_has_been_deleted_successfully')
        );
    }


    // Add to user_permission table
    public function add_to_user_permission($user_id) {
        $user_permission = new userPermission;
        $user_permission->user_id = $user_id;
        $user_permission->save();
    }

    public function assigned_permissions($user_id) {
        $user_details = user::find($user_id);
        $user_permission = new userPermission;
        $permissions = $user_permission::where('user_id', $user_id)->get();
        return view('backend.'.Auth::user()->role.'.user.permission', compact('permissions', 'user_details'));
    }
}
