@if (isset($students))
    @if (count($students) > 0)
       

<div class="row justify-content-md-center">
    <div class="col-md-4 mt-2">
        <div class="card text-white bg-secondary">
            <div class="card-body">
                <div class="toll-free-box text-center">
                    @php
                        $current_session = App\Session::find(get_schools());
                    @endphp
                    <h4> <i class="mdi mdi-border-left"></i> {{ translate('result_sheet_for') }}</h4>
                    <h5>{{ translate('class') }}: {{ $section->class->name }}</h5>
                    <h5>{{ translate('level') }}: {{ $section->name }}</h5>
                    <h5>{{ translate('session') }}: {{ $current_session->name }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-primary">
    
            <div class="table-responsive-sm">
                <table id="basic-datatable" class="table table-striped dt-responsive" width="100%">
                    <thead class="thead-dark">
                        <tr>
                        @php
                            $hello = 0;
                        @endphp
                            
                            <th rowspan="2" style="text-align: left;">
                                Reg NO
                            </th>
                            
                        @foreach ($subject as $subname)
                            <th colspan="4" style="text-align: center;">
                                {{$subname->short_name}} ({{$subname->gp}})
                            </th>
                        @endforeach   

                            <th rowspan="2" style="text-align: center;">{{translate('total_cr_hrs')}}</th>
                            <th rowspan="2" style="text-align: center;">{{translate('total_pts_obt')}}</th>
                            <th rowspan="2" style="text-align: center;">{{translate('GPA')}}</th>
                            
                        </tr>
                        <tr>

                        @foreach ($subject as $key)

                            <th colspan="2">M</th>
                            <th colspan="2">GP</th>
                        @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                    
                        <tr>
                            
                            <td style="text-align: left;">
                                {{$student->student->code}}
                            </td>
                            
                        @foreach ($subject as $subjects)
                            @php
                                $marks = \App\Mark::where('subject_id', $subjects->id)->where('student_id', $student->student->id)->where('class_id', $class_id)->where('section_id', $section_id)->where('exam_id', $exam_id)->where('session', $running_session)->where('school_id', $school_id)->get();
                                
                            @endphp
                        @foreach ($marks as $mark)

                            <td colspan="2" style="text-align: center;">
                                @if ($mark->mark_total > 0) 
                                    {{$mark->mark_total}}
                                @else
                                     0
                                @endif
                            </td>
                            <td colspan="2" style="text-align: center;">
                                
                                {{ $mark->gp }}
                                
                            </td> 
                                
                        @endforeach    
                        @endforeach 
                            @php
                                $markss = \App\Mark::where('student_id', $student->student->id)->where('class_id', $class_id)->where('section_id', $section_id)->where('exam_id', $exam_id)->where('session', $running_session)->where('school_id', $school_id)->sum('mark_total');
                                $sum = 0;
                            @endphp

                            <td style="text-align: center;">
                                {{$subjectk}} 
                            </td>
                            @php
                                $markss1 = \App\Mark::where('student_id', $student->student->id)->where('class_id', $class_id)->where('section_id', $section_id)->where('exam_id', $exam_id)->where('session', $running_session)->where('school_id', $school_id)->sum('gp');
                                $sum1 = 0;
                            @endphp
                            <td style="text-align: center;">
                                @php
                                
                                    $total1 = $markss1;
                                    $sum1 =  $sum1 + 3;
                                    
                                @endphp
                               @if ($sum1 > 0) 
                                
                                    {{number_format((float)$markss1, 2, '.', '')}}
                                @else
                                     $hello;
                                @endif
                            </td>
                            <td style="text-align: center;">
                                @php
                                $rty = $markss1 / $subjectk
                                @endphp
                                {{number_format((float)$rty, 2, '.', '')}}
                            </td>
                        
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                <center>
                <form method="POST" action=" {{ route('exam.4print') }} " >
                        @csrf
                        <input type="hidden" name="exam_id" value="{{$exam_id}}">
                        <input type="hidden" name="section_id" value="{{$section_id}}">
                        <button type="submit" formtarget="_blank" class="btn btn-primary"><i class="mdi mdi-printer"></i> Print
                        </button>
                    </form>
                </center>
                <center>
                    <form method="POST" action=" {{ route('exam.4cumm') }} " >
                        @csrf
                        <input type="hidden" name="exam_id" value="{{$exam_id}}">
                        <input type="hidden" name="tch" value="{{$subjectk}}">
                        <input type="hidden" name="tpo" value="{{$sum1}}">
                        <input type="hidden" name="gpa" value="{{$rty}}">
                        <input type="hidden" name="section_id" value="{{$section_id}}">
                        <button type="submit" formtarget="_blank" class="btn btn-primary"><i class="mdi mdi-printer"></i> Grad Class
                        </button>
                    </form>
                </center>
            </div>
        
</div>



    @else
        <div style="text-align: center;">
                <img src="{{ asset('backend/images/no-data.png') }}" alt="" class="empty-box">
                <p>{{ translate('no_data_found') }}</p>
        </div>
    @endif
@else
<div style="text-align: center;">
        <img src="{{ asset('backend/images/no-data.png') }}" alt="" class="empty-box">
        <p>{{ translate('no_data_found') }}</p>
</div>
@endif
