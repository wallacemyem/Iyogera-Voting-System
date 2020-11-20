<?php

namespace App\Http\Controllers;

use App\Enroll;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
            $user->email = $request->first_name.'.'.$request->other_name.'@iyogera.com';
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
            $student->temp_pass = $rad_code;
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
     * @param $id
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

    public function passwordchange(){

        return view('vote.backend.sec');
    }

    public function password(Request $request)
    {

        $find = $request->matric;
        $time = Carbon::now();

        $old_pass = $request->password1;
        $password = $request->password;
        $con_pass = $request->con_password;

        $check = Student::where('code', $find)->first();

        $check2 = User::where('id', $check->user_id)->first();
        //dd($check2);

        if ($check2->temp_pass === $old_pass){

                if ($password === $con_pass) {

                    $student = Student::where('code', $find)->first();
                    $id = $student->user_id;
                    $user_id = User::where('id', $id)->first();

                    $user_id = User::find($user_id->id);
                    $user_id->password = Hash::make($con_pass);
                    $user_id->temp_pass = $con_pass;
                    //$user_id->temp = 0;
                    $user_id->save();

                    flash(translate('password_set_successfully'))->success();
                    return view('vote.backend.sec', compact('time','id'));

                } else {

                    flash(translate('password_mismatch'))->error();
                    return view('vote.backend.change', compact('find'));
                }
        }else{

            flash(translate('wrong_password'))->error();
            return view('vote.backend.change', compact('find'));
        }
    }

    public function check(Request $request)
    {
            $find = $request->matric;
            $student = Student::where('code', $find)->first();

            if ( $student != null) {

                $id = $student->user_id;

                $user = User::where('id', $student->user_id)->first();

                if ($user->temp == 1) {


                    if ($id === null) {

                        flash(translate('matriculation_number_not_found'))->error();
                        return redirect()->back();

                    } else {

                        flash(translate('change_temporary_password'))->error();
                        return view('vote.backend.change', compact('find', 'user'));
                    }
                } else {

                    flash(translate('one_last_detail'))->success();
                    return view('vote.backend.check', compact('id', 'user'));
                }
            }else{

                flash(translate('matriculation_number_not_found'))->error();
                return redirect()->back();
            }

    }

    public function apps(Request $request)
    {
        $id = $request->matric;
        $find = Student::where('code', $id)->first();

        if ( $find === null) {
            return response()->json([[
                'status' => 'error',
                'message' => 'Matric Number not found'
            ]]);
        }else{
            return response()->json([
                'status' => 'success',
                'message' => $find->code
            ]);
        }

    }

    public function security(Request $request){

            $q1 = $request->a1;
            $q2 = $request->a2;

            $a1 = $request->q1;
            $a2 = $request->q2;

            $id = $request->id;

            $user = User::find($id);
            $user->remember_token1 = $q1;
            $user->remember_token2 = $q2;
            $user->question_1 = $a1;
            $user->question_2 = $a2;
            $user->temp = 0;
            $user->save();

            flash(translate('security_questions_set_successfully'))->success();

            return view('vote.backend.elections');

    }

    public function elections(){
        return view('vote.backend.elections');
    }

    public function checksec(Request $request){

        $a1 = $request->a1;
        $a2 = $request->a2;

        $id = $request->id;

        $user = User::where('id', $id)->first();

        if ( $user->remember_token1 == $a1 && $user->remember_token2 == $a2){

            $userdata = array(
                    'email'     => $user->email,
                    'password'  => $user->temp_pass
                );

            if (Auth::attempt($userdata)) {

            flash(translate('welcome'.' '.$user->first_name.' '.$user->middle_name.' '.$user->other_name))->success();
            return view('vote.backend.elections', compact('user', 'id'));
                }

        }else{

            flash(translate('wrong_security_questions_answer'))->error();
            return view('vote.backend.check', compact('user', 'id'));
        }
    }
}
