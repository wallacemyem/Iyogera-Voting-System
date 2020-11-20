<?php

namespace App\Http\Controllers;

use App\ExpenseCategory;
use Auth;
use Illuminate\Http\Request;
use App\Nominee;
use App\User;
use App\Position;
use App\Student;
use App\Result;

class VotingController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $title = translate('expense_category');
        return view('backend.'.Auth::user()->role.'.expense_category.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.'.Auth::user()->role.'.expense_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return dd($request->all());
        $expense_category = new ExpenseCategory;
        $expense_category->name = $request->name;
        $expense_category->school_id = school_id();
        $expense_category->session = get_schools();
        if($expense_category->save()){

            flash(translate('expense_category_added_successfully'))->success();
               
        }else {
            flash('an_error_occured_when_adding_expense_category')->error();
            
        }

        return redirect()->back();
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        //
    }

    public function list()
    {
        return view('backend.'.Auth::user()->role.'.expense_category.list')->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense_category = ExpenseCategory::find($id);
        return view('backend.'.Auth::user()->role.'.expense_category.edit', compact('expense_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $expense_category = ExpenseCategory::find($id);
        $expense_category->name = $request->name;
        $expense_category->school_id = school_id();
        $expense_category->session = get_schools();
        if($expense_category->save()){

            flash(translate('expense_category_updated_successfully'))->success();
               
        }else {
            flash('an_error_occured_when_updating_expense_category')->error();
            
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(ExpenseCategory::destroy($id)){

            flash(translate('expense_category_deleted_successfully'))->success();
               
        }else {
            flash('an_error_occured_when_deleting_expense_category')->error();
            
        }

        return redirect()->back();
            
    }

    public function position($position_id)
    {

        $nom = Nominee::where('position_id', $position_id)->get();
        

        return view('vote.backend.voting', compact('nom'));
    }

    public function verify($verify)
    {
        $id = Auth::user()->id;

        $user = User::where('id', $id)->first();

        return view('vote.backend.verify', compact('verify', 'user'));
    }

    public function cast(Request $request)
    {
        $user = Auth::user()->id;
        $a1 = $request->a1;
        $a2 = $request->a2;

        $id = $request->id;

        $nom = Nominee::where('id', $id)->first(); 

        $student = Student::where('user_id', $user)->first();

        $check = Result::where('student_id', $student->id)->where('nominee_id', $nom->id)->where('election_id', $nom->election_id)->first();

        $position = Position::where('election_id', $nom->election_id)->first();

        if ( $check != null ) {
        

                if ( $user->remember_token1 == $a1 && $user->remember_token2 == $a2){

                    $i = new Result;
                    $i->student_id = $student->id;
                    $i->nominee_id = $nom->id;
                    $i->election_id = $nom->election_id;
                    $i->position_id = $nom->position_id;
                    $i->save();

                    flash(translate('congratulations_for_making_a_choice'));

                    return view('vote.backend.elections');

                    }
        }
    }
}
