<?php

namespace App\Http\Controllers;

use App\Enroll;
use App\Student;
use App\User;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(){

    	$title = translate('users');

    	return view('backend.'.Auth::user()->role.'.user.index', compact('title'));
    }

    public function store(Request $request)
    {
        $rad_code = str_pad(mt_rand(1,99999),5,'0',STR_PAD_LEFT);

        if(count(User::where('email', $request->email)->get()) == 0) {
            $user = new User;
            $user->first_name = $request->first_name;
            $user->other_name = $request->other_name;
            $user->middle_name = $request->middle_name;
            $user->email = $request->email;
            $user->password = Hash::make($rad_code);
            $user->role = "voter";
            $user->temp_pass = $rad_code;
            //$user->gender = $request->gender;
            $user->school_id = school_id();
            $user->save();

            $user_id = $user->id;

            $student = new Student;
            $student->user_id = $user_id;
            $student->code = $request->matric;
            $student->level = $request->level;
            //$student->profile_pix = $file_name_path;
            $student->school_id = school_id();
            $student->save();

            flash(translate('student_added_successfully'))->success();

        }else {
            flash(translate('email_duplication'))->error();
        }

        return redirect()->back();
    }

    public function show($department_id)
    {
        return view('backend.'.Auth::user()->role.'.user.list', compact('department_id'));
    }

    public function create()
    {
        return view('backend.'.Auth::user()->role.'.user.create');
    }

    public function edit($id)
    {
        $user = Student::find($id);
        //dd($user);
        return view('backend.'.Auth::user()->role.'.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if(count(User::where('email', $request->email)->where('id', '!=', $student->user->id)->get()) == 0) {
            $user = User::find($student->user_id);
            $user->first_name = $request->first_name;
            $user->other_name = $request->other_name;
            $user->middle_name = $request->middle_name;
            $user->email = $request->email;
            $user->role = "voter";
            if($user->save()) {
                $student->code = $request->matric;
                $student->school_id = school_id();
                $student->save();

                flash(translate('student_updated_successfully'))->success();
            }
            }else {
                flash(translate('email_duplication'))->error();
            }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Student::find($id);
        $user->delete();
        $user->user->delete();

        flash(translate('user_has_been_deleted_successfully'))->success();
        return redirect()->back();
    }

    public function password()
    {

    }

    public function check(Request $request)
    {
            $id = $request->matric;
            $find = Student::first($id);

            return response()->json([
            'status' => 'success',
            'message'=> $find->code
        ]);

    }
}
