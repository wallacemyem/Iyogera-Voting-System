@php
    if(isset($department_id) && $department_id > 0){
        $teachers = \App\Election::get();
    }else {
        $teachers = \App\Election::get();
    }
@endphp
@if (count($teachers) > 0)
<div class="table-responsive-sm">
    <table id="basic-datatable" class="table table-striped dt-responsive nowrap" width="100%">
        <thead class="thead-dark">
            <tr>
                <th>{{ translate('name') }}</th>
                <th>{{ translate('start_date_and_time') }}</th>
                <th>{{ translate('end_date_and_time') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $teachers as $teacher)
                <tr>
                    
                    <td> {{ $teacher->name }} </td>
                    <td>{{ $teacher->start }}</td>
                    <td>{{ $teacher->end }}</td>
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
