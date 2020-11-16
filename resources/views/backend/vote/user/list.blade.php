@php
    if(isset($department_id) && $department_id > 0){
        $teachers = \App\Student::where('school_id', school_id())->get();
    }else {
        $teachers = \App\Student::where('school_id', school_id())->get();
    }
@endphp
@if (count($teachers) > 0)
<div class="table-responsive-sm">
    <table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
        <thead class="thead-dark">
            <tr>
                <th>{{ translate('name') }}</th>
                <th>{{ translate('matriculation_number') }}</th>
                <th>{{ translate('temp_password') }}</th>
                <th>{{ translate('option') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $teachers as $teacher)
                <tr>
                    
                    <td> {{ $teacher->user->other_name }} {{ $teacher->user->first_name }} {{ $teacher->user->middle_name }} </td>
                    @if( empty($teacher->code))
                    <td></td>
                    @else
                    <td> {{ $teacher->code }} </td>
                    @endif
                    @if( $teacher->user->temp == "1")
                    <td> {{ $teacher->user->temp_pass }} </td>
                    @else
                        <td>{{ translate('password_set') }}</td>
                    @endif
                    <td>
                        <div class="btn-group mb-2">
                            <button type="button" class="btn btn-icon btn-secondary btn-sm" style="margin-right:5px;" onclick="showAjaxModal('{{ route('user.edit', $teacher->id) }}', '{{ translate('update_user') }}')"
                                data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ translate('update_user') }}"> <i class="mdi mdi-wrench"></i> </button>
                            <button type="button" class="btn btn-icon btn-dark btn-sm" style="margin-right:5px;" onclick="confirm_modal('{{ route('user.destroy', $teacher->id) }}', departmentWiseFilter )"
                                data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ translate('delete_user') }}"> <i class="mdi mdi-window-close"></i> </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
    <div style="text-align: center;">
            <img src="{{ asset('backend/images/no-data.png') }}" alt="" class="empty-box">
            <p>{{ translate('no_data_found') }}</p>
    </div>
@endif
