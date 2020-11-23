<?php

namespace App\Http\Controllers;

use App\Election;
use App\Expense;
use App\Nominee;
use App\Position;
use App\Student;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ResultController extends Controller
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
        $title = translate('Results');

        return view('backend.'.Auth::user()->role.'.result.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.'.Auth::user()->role.'.nom.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->name;
        $first = Student::find($id);
        $second = User::find($first->user_id);
        $name = $second->first_name.' '.$second->middle_name.' '.$second->other_name;
        $file = $first->id;

        if ($request->hasFile('nominee')) {
            $dir  = 'images/nominee';
            $student_image = $request->file('nominee');
            $student_image->move($dir, $file.".jpg");
        }
        //dd($request->hasFile('nominee'));
        $expense = new Nominee;
        $expense->name = $name;
        $expense->student_id = $file;
        $expense->position_id = $request->position_id;
        $expense->election_id = $request->election_id;
        $expense->motto = $request->motto;
        $expense->description = $request->desc;
        $expense->image = $dir.'/'.$file.'jpg';
        $expense->school_id = school_id();
        //dd($expense);
        if($expense->save()){

            flash(translate('nominee_added_successfully'))->success();
               
        }else {
            flash('an_error_occurred')->error();
            
        }

        return redirect()->back();
           
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Nominee::find($id);
        return view('backend.'.Auth::user()->role.'.nom.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $expense = Nominee::find($id);
        $expense->date = strtotime($request->date);
        $expense->amount = $request->amount;
        $expense->expense_category_id = $request->expense_category_id;
        $expense->school_id = school_id();
        if($expense->save()){
            flash(translate('expense_updated_successfully'))->success();
               
        }else {
            flash('an_error_occured_when_updating_expense')->error();
            
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Expense::destroy($id)){
            flash(translate('expense_deleted_successfully'))->success();
               
        }else {
            flash('an_error_occured_when_deleting_expense')->error();
            
        }

        return redirect()->back();
            
    }

    public function list(Request $request)
    {
        $date = explode('-', $request->date);
        $date_from = strtotime($date[0].' 00:00:00');
        $date_to   = strtotime($date[1].' 23:59:59');
        $expense_category_id = $request->expense_category_id;
        return view('backend.'.Auth::user()->role.'.expense.list', compact('date_from', 'date_to', 'expense_category_id'))->render();
    }
}
