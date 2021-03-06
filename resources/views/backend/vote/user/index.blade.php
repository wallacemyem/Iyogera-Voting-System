@extends('backend.layout.main')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box ">
                <h4 class="page-title"> <i class="mdi mdi-account-circle title_icon"></i> {{ translate('users') }}
                <button type="button" class="btn btn-icon btn-success btn-rounded alignToTitle" onclick="showAjaxModal('{{ route('user.create') }}', '{{ translate('create_new_user') }}')"> <i class="mdi mdi-plus"></i> {{  translate('add_new_user') }}</button>
                </h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row ">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    
                    <div id = "teacher_content">
                        @include('backend.'.Auth::user()->role.'.user.list')
                    </div> <!-- end table-responsive-->
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection

@section('scripts')
    <script>
        var departmentWiseFilter = function() {
            var department_id = $('#department_id').val();
            var url = '{{ route("user.show", "department_id") }}';
            url = url.replace('department_id', department_id);

            $.ajax({
                type : 'GET',
                url: url,
                success : function(response) {
                    $('#teacher_content').html(response);
                    initDataTable("basic-datatable");
                }
            });
        }
    </script>
@endsection
