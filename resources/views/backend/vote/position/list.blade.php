@php
    if(isset($department_id) && $department_id > 0){
        $teachers = \App\Position::get();
    }else {
        $teachers = \App\Position::get();
    }
@endphp
@if (count($teachers) > 0)
<div class="table-responsive-sm">
    <table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
        <thead class="thead-dark">
            <tr>
                <th>{{ translate('name') }}</th>
                <th>{{ translate('elections') }}</th>
                <th>{{ translate('option') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $teachers as $teacher)
                <tr>
                    
                    <td> {{ $teacher->name }} </td>
                    @if( empty($teacher->id))
                    <td></td>
                    @else
                    <td> {{ $teacher->election->name }} </td>
                    @endif
                    <td>
                        <div class="btn-group mb-2">
                            <button type="button" class="btn btn-icon btn-secondary btn-sm" style="margin-right:5px;" onclick="showAjaxModal('{{ route('position.edit', $teacher->id) }}', '{{ translate('update_position') }}')"
                                data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ translate('update_position') }}"> <i class="mdi mdi-wrench"></i> </button>
                            <button type="button" class="btn btn-icon btn-dark btn-sm" style="margin-right:5px;" onclick="confirm_modal('{{ route('position.destroy', $teacher->id) }}', departmentWiseFilter )"
                                data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ translate('delete_position') }}"> <i class="mdi mdi-window-close"></i> </button>
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
