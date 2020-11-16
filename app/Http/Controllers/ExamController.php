<?php

namespace App\Http\Controllers;
use App\Section;
use App\Classes;
use App\Subject;
use App\Enroll;
use App\Mark;
use App\Result;
use App\Student;
use App\Session;
use App\School;
use App\Exam;
use Auth;
use Illuminate\Http\Request;

class ExamController extends Controller
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
        $title = translate('exam');
        
        return view('backend.'.Auth::user()->role.'.exam.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.'.Auth::user()->role.'.exam.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exam = new Exam;
        $exam->name = $request->name;
        $exam->starting_date = strtotime($request->starting_date);
        $exam->ending_date = strtotime($request->ending_date);
        $exam->school_id = school_id();
        $exam->session = get_schools();

        if($exam->save()){
            flash(translate('exam_added_successfully'))->success();
               
        }else {
            flash('an_error_occured_when_adding_exam')->error();
            
        }

        return redirect()->back();
           
    }

    public function print4cumm(Request $request)
    {

        # code...

        $exam_id = $request->exam_id;
        $section_id = $request->section_id;
        $section  = Section::find($section_id);
        $class_id = $section->class_id;
        $running_session = get_schools();
        $school_id = school_id();

        $class          = Classes::find($class_id);
        //$section        = Section::find($InputSectionId);
        $exam           = Exam::find($exam_id);

        $class_name = $class->name;
        $exam_name = $exam->name;
        //dd($section);



        $subject = Subject::where(['class_id' => $class_id, 'session' => $running_session, 'school_id' => $school_id])->get();
        $subjectk = Subject::where(['class_id' => $class_id, 'session' => $running_session, 'school_id' => $school_id])->sum('gp');

        $students = Enroll::where(['section_id' => $section_id, 'class_id' => $class_id, 'session' => $running_session, 'school_id' => $school_id])->get();
        //dd($students);
        //all subject list in a specific class/section
        $subject_ids        = [];
        $subject_strings    = '';
        $marks_string       = '';
        foreach ($students as $SingleStudent) {
            foreach ($subject as $subjects) {
                //dd($SingleStudent->student_id);
                $stu_id = $SingleStudent->id;
                $sub_id = $subjects->id;
                //dd($students);
                $subject_strings    = (empty($subject_strings)) ? $subjects->name : $subject_strings . ',' . $subjects->name;
                //dd($subject_strings);
                $getMark            =  Mark::where(['student_id' => $stu_id, 'subject_id' => $sub_id, 'section_id' => $section_id, 'class_id' => $class_id, 'session' => $running_session, 'school_id' => $school_id])->first();

                $marks            =  Mark::where(['student_id' => $stu_id, 'subject_id' => $sub_id, 'section_id' => $section_id, 'class_id' => $class_id, 'session' => $running_session, 'school_id' => $school_id])->get();
                $tpo = $request->tpo;
                $tch = $request->tch;
                $gpa = $request->gpa;

                //dd($subjectk);
                if (empty($getMark->mark_total)) {
                    $FinalMarks = 0;
                } else {
                    $FinalMarks = $getMark->mark_total;
                }
                $marks_string = (empty($marks_string)) ? $FinalMarks : $marks_string . ',' . $FinalMarks;
                //dd($marks_string);
                $mark_grade = \App\Grade::where([['mark_from', '<=', $FinalMarks], ['mark_upto', '>=', $FinalMarks]])->get();
                //dd($mark_grade);

            }

            //$gtr = $mark_grade->grade_point * $subjects->gp;
            //$gt = (empty($gt)) ? $gtr : $gt . ',' . $gtr;
            //dd($gtr);

            //end subject list for specific section/class
            $sexy = Result::where(['student_id' => $stu_id])->exists();
            //dd($sexy);
            //$alldata = Result::where(['exam_id' => $exam_id, 'class_id' => $class_id])->get();
            //dd($alldata);

            $result = Mark::where(['student_id' => $stu_id, 'section_id' => $section_id, 'class_id' => $class_id, 'session' => $running_session, 'school_id' => $school_id])->get();
            //dd(collect($yourArray)->sortBy('Key','ASC'));

            $total_marks = Mark::where(['student_id' => $stu_id, 'section_id' => $section_id, 'class_id' => $class_id, 'exam_id' => $exam_id, 'session' => $running_session, 'school_id' => $school_id])->sum('mark_total');

            $sum_of_mark = ($total_marks == 0) ? 0 : $total_marks;
            //dd($sum_of_mark);
            $marks_count = $result->count();
            $average_Mark = ($total_marks == 0) ? 0 : ($total_marks / $result->count()); //get average number
            //dd($average_Mark);
            $average_mark = number_format($average_Mark, 2, '.', '');

            $full_name          =   $SingleStudent->student->user->other_name.' '.$SingleStudent->student->user->first_name.' '.$SingleStudent->student->user->middle_name;                 //get name
            //dd($full_name);
            $admission_no       =   $SingleStudent->student->code;           //get admission no

        }
        //end loop eligible_students



        $allresult_data = Result::where(['student_id' => $stu_id, 'session' => $running_session, 'school_id' => $school_id, 'exam_id' => $exam_id, 'class_id' => $class_id, 'section_id' => $section_id])->orderBy('position', 'asc')->get();

        /*$merit_serial = 1;
           *foreach ($allresult_data as $row) {
            *$D = Result::find($row->id);
            *$D->position = $merit_serial++;
            *$D->save();

            }*/

        return view('backend.'.Auth::user()->role.'.report.cumm', compact('students', 'stu_id', 'exam_id', 'subject', 'tch', 'tpo', 'gpa', 'subjects', 'section_id', 'class_id', 'running_session', 'school_id', 'marks', 'section', 'total_marks', 'marks_count', 'allresult_data', 'subjectk'))->render();

    }

    public function print4exam(Request $request)
    {
        
    	# code...
    	$exam_id = $request->exam_id;   
        $section_id = $request->section_id;
        $section  = Section::find($section_id);
        $class_id = $section->class_id;
        $running_session = get_schools();
        $school_id = school_id();

        $class          = Classes::find($class_id);
        //$section        = Section::find($InputSectionId);
        $exam           = Exam::find($exam_id);

        $class_name = $class->name;
		$exam_name = $exam->name;
		//dd($section);
		
		

		        $subject = Subject::where(['class_id' => $class_id, 'session' => $running_session, 'school_id' => $school_id])->get();
                $subjectk = Subject::where(['class_id' => $class_id, 'session' => $running_session, 'school_id' => $school_id])->sum('gp');
		        
		        $students = Enroll::where(['section_id' => $section_id, 'class_id' => $class_id, 'session' => $running_session, 'school_id' => $school_id])->get();
		        //dd($students);
		        	//all subject list in a specific class/section
		            $subject_ids        = [];
		            $subject_strings    = '';
		            $marks_string       = '';
		            foreach ($students as $SingleStudent) {
		                foreach ($subject as $subjects) {
		                	//dd($SingleStudent->student_id);
		                	$stu_id = $SingleStudent->id;
		                    $sub_id = $subjects->id;
		                    //dd($students);
		                    $subject_strings    = (empty($subject_strings)) ? $subjects->name : $subject_strings . ',' . $subjects->name;
		                    //dd($subject_strings);
		                    $getMark            =  Mark::where(['student_id' => $stu_id, 'subject_id' => $sub_id, 'section_id' => $section_id, 'class_id' => $class_id, 'session' => $running_session, 'school_id' => $school_id])->first();

		                    $marks            =  Mark::where(['student_id' => $stu_id, 'subject_id' => $sub_id, 'section_id' => $section_id, 'class_id' => $class_id, 'session' => $running_session, 'school_id' => $school_id])->get();


		                    	//dd($subjectk);
		                    if (empty($getMark->mark_total)) {
		                        $FinalMarks = 0;
		                    } else {
		                        $FinalMarks = $getMark->mark_total;
		                    }
		                    $marks_string = (empty($marks_string)) ? $FinalMarks : $marks_string . ',' . $FinalMarks;
		                   //dd($marks_string);
                           $mark_grade = \App\Grade::where([['mark_from', '<=', $FinalMarks], ['mark_upto', '>=', $FinalMarks]])->get();
                          //dd($mark_grade); 

		                }

                            //$gtr = $mark_grade->grade_point * $subjects->gp;
                            //$gt = (empty($gt)) ? $gtr : $gt . ',' . $gtr;
                            //dd($gtr);
		            
		                //end subject list for specific section/class
		                $sexy = Result::where(['student_id' => $stu_id])->exists();
						//dd($sexy);
		                //$alldata = Result::where(['exam_id' => $exam_id, 'class_id' => $class_id])->get();
		                //dd($alldata);

		            $result = Mark::where(['student_id' => $stu_id, 'section_id' => $section_id, 'class_id' => $class_id, 'session' => $running_session, 'school_id' => $school_id])->get();
		            //dd(collect($yourArray)->sortBy('Key','ASC'));

		            $total_marks = Mark::where(['student_id' => $stu_id, 'section_id' => $section_id, 'class_id' => $class_id, 'exam_id' => $exam_id, 'session' => $running_session, 'school_id' => $school_id])->sum('mark_total');

		            	$sum_of_mark = ($total_marks == 0) ? 0 : $total_marks;
		            	//dd($sum_of_mark);
		            	$marks_count = $result->count();
		                $average_Mark = ($total_marks == 0) ? 0 : ($total_marks / $result->count()); //get average number 
		                //dd($average_Mark);
						$average_mark = number_format($average_Mark, 2, '.', '');
						
						$full_name          =   $SingleStudent->student->user->other_name.' '.$SingleStudent->student->user->first_name.' '.$SingleStudent->student->user->middle_name;                 //get name 
                        //dd($full_name);
		                $admission_no       =   $SingleStudent->student->code;           //get admission no

		        	}
		            //end loop eligible_students
                     
        		
           
	            $allresult_data = Result::where(['student_id' => $stu_id, 'session' => $running_session, 'school_id' => $school_id, 'exam_id' => $exam_id, 'class_id' => $class_id, 'section_id' => $section_id])->orderBy('position', 'asc')->get();
			
				/*$merit_serial = 1;
	               *foreach ($allresult_data as $row) {
	                *$D = Result::find($row->id);
	                *$D->position = $merit_serial++;
	                *$D->save();
	            
	            	}*/

        return view('backend.'.Auth::user()->role.'.report.print', compact('students', 'stu_id', 'exam_id', 'subject', 'subjects', 'section_id', 'class_id', 'running_session', 'school_id', 'marks', 'section', 'total_marks', 'marks_count', 'allresult_data', 'subjectk'))->render();
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    public function list()
    {
        return view('backend.'.Auth::user()->role.'.exam.list')->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam = Exam::find($id);
        return view('backend.'.Auth::user()->role.'.exam.edit', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $exam = Exam::find($id);
        $exam->name = $request->name;
        $exam->starting_date = strtotime($request->starting_date);
        $exam->ending_date = strtotime($request->ending_date);
        $exam->school_id = school_id();
        $exam->session = get_schools();
        if($exam->save()){

            flash(translate('exam_updated_successfully'))->success();
               
        }else {
            flash('an_error_occured_when_updating_exam')->error();
            
        }

        return redirect()->back();
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Exam::destroy($id)){

            flash(translate('exam_deleted_successfully'))->success();
               
        }else {
            flash('an_error_occured_when_deleting_exam')->error();
            
        }

        return redirect()->back();
            
    }
}
