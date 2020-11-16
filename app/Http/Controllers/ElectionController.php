<?php

namespace App\Http\Controllers;

use App\BookIssue;
use App\Election;
use App\Enroll;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ElectionController extends Controller
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
        $title     = translate('election');

        return view('backend.'.Auth::user()->role.'.election.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.'.Auth::user()->role.'.election.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $start_format = Carbon::createFromIsoFormat('L', $request->start_date, null, 'en');
        $start_date = $start_format->isoFormat('D-M-YYYY');

        $end_format = Carbon::createFromIsoFormat('L', $request->end_date, null, 'en');
        $end_date = $end_format->isoFormat('D-M-YYYY');

        $start = $start_date.' '.$request->start_time.':00';
        $end = $end_date.' '.$request->end_time.':00';

        $book_issue = new Election;
        $book_issue->name    = $request->name;
        $book_issue->start   = $start;
        $book_issue->end     = $end;
        $book_issue->status  = 1;

        if($book_issue->save()){

            flash(translate('elections_created_successfully'))->success();
               
        }else {
            flash(translate('an_error_occurred'))->error();
            
        }

        return redirect()->back();
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookIssue  $bookIssue
     * @return \Illuminate\Http\Response
     */
    public function show(BookIssue $bookIssue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookIssue  $bookIssue
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book_issue = BookIssue::find($id);
        return view('backend.'.Auth::user()->role.'.book_issue.edit', compact('book_issue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookIssue  $bookIssue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book_issue = BookIssue::find($id);
        $book_issue->book_id    = $request->book_id;
        $book_issue->class_id   = $request->class_id;
        $book_issue->student_id = $request->student_id;
        $book_issue->issue_date = strtotime($request->issue_date);
        $book_issue->school_id  = school_id();
        $book_issue->session    = get_schools();

        if($book_issue->save()){
            flash(translate('book_issued_successfully'))->success();
               
        }else {
            flash('an_error_occured_when_issuing_book')->error();
            
        }

        return redirect()->back();
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookIssue  $bookIssue
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(BookIssue::destroy($id)){
            flash(translate('book_issue_info_deleted_successfully'))->success();
               
        }else {
            flash('an_error_occured_when_deleting_book_issue_info')->error();
            
        }

        return redirect()->back();
            
    }

    public function return($id)
    {
        $book_issue = BookIssue::find($id);
        $book_issue->status = 1;
        if($book_issue->save()){
            flash(translate('book_returned_successfully'))->success();
               
        }else {
            flash('an_error_occured_when_returning_book')->error();
            
        }

        return redirect()->back();
            
    }

    public function student($class_id) {
        $running_session = get_schools();
        $school_id = school_id();
        $students = Enroll::where(['class_id' => $class_id, 'session' => $running_session, 'school_id' => $school_id])->get();
        return view('backend.'.Auth::user()->role.'.book_issue.student', compact('students'));
    }

    public function list(Request $request)
    {
        $date = explode('-', $request->date);
        $date_from = strtotime($date[0].' 00:00:00');
        $date_to   = strtotime($date[1].' 23:59:59');
        return view('backend.'.Auth::user()->role.'.book_issue.list', compact('date_from', 'date_to'))->render();
    }
}
