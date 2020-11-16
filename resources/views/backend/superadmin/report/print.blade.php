<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
        <title>Result Sheet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Best school ERP" name="description" />
    <meta content="Iyogera NG" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="https://iyogera.dev/torkuma/backend/images/student_image/preview.png">
    <link href="https://iyogera.dev/torkuma/backend/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="https://iyogera.dev/torkuma/backend/css/vendor/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="https://iyogera.dev/torkuma/backend/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="https://iyogera.dev/torkuma/backend/css/fontawesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <link href="https://iyogera.dev/torkuma/backend/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="https://iyogera.dev/torkuma/backend/css/vendor/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="https://iyogera.dev/torkuma/backend/css/vendor/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="https://iyogera.dev/torkuma/backend/css/vendor/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="https://iyogera.dev/torkuma/backend/css/vendor/select.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="https://iyogera.dev/torkuma/backend/css/main.css" rel="stylesheet" type="text/css" />
    <link href="https://iyogera.dev/torkuma/backend/css/toast.css" rel="stylesheet" type="text/css" />
    <link href="https://iyogera.dev/torkuma/backend/css/tble.css" rel="stylesheet" type="text/css" />
    <link href="https://iyogera.dev/torkuma/backend/css/notyf.min.css" rel="stylesheet" type="text/css" />
    <link href="https://iyogera.dev/torkuma/backend/css/exam.css" rel="stylesheet" type="text/css" />
    <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
</head>

<body  class="enlarged" data-keep-enlarged="true"  >
<!-- Begin page -->
<h2 style="text-align: center; color: black">
    Exams Sheet for National diploma I
</h2>
<table>
  <tr style="color: black"> 
          
    <th rowspan="2">S/NO</th>     
      
    <th rowspan="2">Matric</th>
    <th rowspan="2">Name of student</th>
    @foreach( $subject as $subname)
    <th colspan="2">{{$subname->short_name}} ({{$subname->gp}})</th>
    @endforeach
    <th rowspan="2">Tot. Cr. Hrs</th>
    <th rowspan="2">Tot. Pts. Obt</th>
    <th rowspan="2">G.P.A</th>
    <th rowspan="2">Remarks</th>
</tr> 
<tr style="color: black">
@foreach ($subject as $key)
    <th colspan="1">M</th>
    <th colspan="1">GP</th>
@endforeach
</tr>
@php $i=0;@endphp
@foreach ($students as $student)
@php $i++;@endphp
  <tr>
   
    <td style="color: black">        
     {{$i}}
    </td>
    
    <td style="color: black">{{$student->student->code}}</td>
    <td style="color: black">{{$student->student->user->first_name}}</td>
    @foreach ($subject as $subjects)
    @php
      $marks = \App\Mark::where('subject_id', $subjects->id)->where('student_id', $student->student->id)->where('class_id', $class_id)->where('section_id', $section_id)->where('exam_id', $exam_id)->where('session', $running_session)->where('school_id', $school_id)->get();
      
  @endphp
@foreach ($marks as $mark)
    @if ($mark->mark_total < 39 ) 
        <td style="color: grey;">
            {{ $mark->mark_total }}
        </td>
        @else
        <td style="color: black">
            {{ $mark->mark_total }}
        </td>
    @endif
    
        <td style="color: black">
            {{ $mark->gp }}
        </td>
    
    @endforeach
    @endforeach

    <td style="color: black">{{$subjectk}}</td>
    @php
        $markss1 = \App\Mark::where('student_id', $student->student->id)->where('class_id', $class_id)->where('section_id', $section_id)->where('exam_id', $exam_id)->where('session', $running_session)->where('school_id', $school_id)->sum('gp');
        $sum1 = 0;
    @endphp
    <td style="color: black">
    @php
                                
        $total1 = $markss1;
        $sum1 =  $sum1 + $total1;
        
    @endphp
    @if ($sum1 > 0) 
    
        {{number_format((float)$sum1, 2, '.', '')}}
    @else
          0;
    @endif
    </td>
    <td style="color: black">
    @php
    $rty = $sum1 / $subjectk
    @endphp
    {{number_format((float)$rty, 2, '.', '')}}
    </td>
      
    <td style="color: black">
    @if ( number_format((float)$rty, 2, '.', '') >= 2.00 )
        {{'P'}}
      @else
        {{'F'}}
      @endif
    </td> 
  
</tr>
@endforeach
</table>
<script src="https://iyogera.dev/torkuma/backend/js/app.min.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/vendor/Chart.bundle.min.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/pages/demo.dashboard.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/vendor/jquery.dataTables.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/vendor/dataTables.bootstrap4.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/vendor/dataTables.responsive.min.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/vendor/responsive.bootstrap4.min.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/vendor/dataTables.buttons.min.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/vendor/buttons.bootstrap4.min.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/vendor/buttons.html5.min.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/vendor/buttons.flash.min.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/vendor/buttons.print.min.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/vendor/dataTables.keyTable.min.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/vendor/dataTables.select.min.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/pages/demo.datatable-init.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/pages/demo.form-wizard.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/vendor/jquery-ui.min.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/vendor/fullcalendar.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/main.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/toast.js"></script>
    <script src="https://iyogera.dev/torkuma/backend/js/notyf.min.js"></script>
    
    


    
    <script>
        function initDataTable(tableId) {
            $("#"+tableId).DataTable({
                keys: !0,
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    }
                },
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                }
            });
        }
    </script>
    </body>
</html>