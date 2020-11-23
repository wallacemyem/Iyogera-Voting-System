@extends('backend.layout.main')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box ">
                <h4 class="page-title"> <i class="em em-heart_decoration" aria-role="presentation" aria-label="HEART DECORATION"></i> {{ translate('dashboard') }} </h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row ">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">{{ translate('overview') }}</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card widget-flat" id="student" style="on">
                                        <div class="card-body">
                                            <div class="float-right">
                                                <i class="mdi mdi-account-multiple widget-icon"></i>
                                            </div>
                                            <h5 class="text-muted font-weight-normal mt-0" title="Number of Student"> <i class="mdi mdi-account-group title_icon"></i>  {{ translate('students') }} <a href="#" style="color: #6c757d; display: none;" id = "student_list"><i class = "mdi mdi-export"></i></a></h5>
                                            <h3 class="mt-3 mb-3">
                                                @php
                                                    $students = \App\Student::where(['school_id' => school_id()])->get();
                                                    echo count($students);
                                                @endphp
                                            </h3>
                                            <p class="mb-0 text-muted">
                                                <span class="text-nowrap">{{ translate('total_number_of_student') }}</span>
                                            </p>
                                        </div> <!-- end card-body-->
                                    </div> <!-- end card-->
                                </div> <!-- end col-->

                                <div class="col-lg-6">
                                    <div class="card widget-flat" id="teacher" style="on">
                                        <div class="card-body">
                                            <div class="float-right">
                                                <i class="mdi mdi-account-multiple widget-icon"></i>
                                            </div>
                                            <h5 class="text-muted font-weight-normal mt-0" title="Number of Voters"> <i class="mdi mdi-account-group title_icon"></i> {{ translate('voters') }}  <a href="#" style="color: #6c757d; display: none;" id = "teacher_list"><i class = "mdi mdi-export"></i></a></h5>
                                            <h3 class="mt-3 mb-3">
                                                @php
                                                    $teachers = \App\User::where(['school_id' => school_id(), 'temp' => '0'])->get();
                                                    echo count($teachers);
                                                @endphp
                                            </h3>
                                            <p class="mb-0 text-muted">
                                                <span class="text-nowrap">{{ translate('total_number_of_voters') }}</span>
                                            </p>
                                        </div> <!-- end card-body-->
                                    </div> <!-- end card-->
                                </div> <!-- end col-->
                            </div> <!-- end row -->

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card widget-flat" id = "parent">
                                        <div class="card-body">
                                            <div class="float-right">
                                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                            </div>
                                            <h5 class="text-muted font-weight-normal mt-0" title="Number of Elections"> <i class="mdi mdi-account-group title_icon"></i> {{ translate('elections') }}  <a href="{{ route('parent.index') }}" style="color: #6c757d; display: none;" id = "parent_list"><i class = "mdi mdi-export"></i></a></h5>
                                            <h3 class="mt-3 mb-3">
                                                @php
                                                    $parents = \App\Election::where(['school_id' => school_id()])->get();
                                                    echo count($parents);
                                                @endphp
                                            </h3>
                                            <p class="mb-0 text-muted">
                                                <span class="text-nowrap">{{ translate('total_number_of_elections') }}</span>
                                            </p>
                                        </div> <!-- end card-body-->
                                    </div> <!-- end card-->
                                </div> <!-- end col-->

                                <div class="col-lg-6">
                                    <div class="card widget-flat">
                                        <div class="card-body">
                                            <div class="float-right">
                                                    <i class="mdi mdi-account-multiple widget-icon"></i>
                                            </div>
                                            <h5 class="text-muted font-weight-normal mt-0" title="Number of Staff"> <i class="mdi mdi-account-group title_icon"></i> {{ translate('staff') }}</h5>
                                            <h3 class="mt-3 mb-3">
                                                @php
                                                    $accountants = \App\User::where(['role' => 'vote', 'school_id' => school_id()])->get();

                                                    echo count($accountants);
                                                @endphp
                                            </h3>
                                            <p class="mb-0 text-muted">
                                                <span class="text-nowrap">{{ translate('total_number_of_staff') }}</span>
                                            </p>
                                        </div> <!-- end card-body-->
                                    </div> <!-- end card-->
                                </div> <!-- end col-->
                            </div> <!-- end row -->
                        </div>
                    </div>
                </div> <!-- end col -->
                <div class="col-xl-4">
                    <div class="card bg-primary">
                        <div class="card-body">
                            <h4 class="header-title text-white mb-2">{{ translate('registered_voters') }}</h4>
                            <div class="text-center">
                                <h3 class="font-weight-normal text-white mb-2">
                                    @php

                                                    $teacher2s = \App\User::where(['school_id' => school_id(), 'temp' => '0'])->get();

                                                  echo count($teacher2s);

                                                @endphp
                                </h3>
                                <p class="text-light text-uppercase font-13 font-weight-bold">{{ translate('students') }}</p>
                                <a href="#" class="btn btn-outline-light btn-sm mb-1">{{ translate('go_to_users') }}
                                    <i class="mdi mdi-arrow-right ml-1"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title"> {{ translate('recent_elections') }}<a href="{{ route('event_calendar.index') }}" style="color: #6c757d;"><i class = "mdi mdi-export"></i></a></h4>
                            @include('backend.'.Auth::user()->role.'.dashboard.events')
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col-->
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            initDataTable("expense-datatable");
        });

        $(".widget-flat").mouseenter(function() {
            var id = $(this).attr('id');
            $('#'+id+'_list').show();
        }).mouseleave(function() {
            var id = $(this).attr('id');
            $('#'+id+'_list').hide();
        });
    </script>
@endsection
