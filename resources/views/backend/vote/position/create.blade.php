<form method="POST" class="d-block ajaxForm" action="{{ route('position.store') }}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">{{ translate('name') }}</label>
                <input type="text" class="form-control" id="name" name = "name" required>
                <small id="" class="form-text text-muted">{{ translate('provide_name') }}.</small>
            </div>

            <div class="form-group col-md-12">
                <label for="election">{{ translate('election') }}</label>
                <select name="election_id" id="election_id" class="form-control" required>
                    <option value="">{{ translate('please_select_the_election') }}</option>
                    @foreach (\App\Election::where('school_id', school_id())->get() as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                <small id="" class="form-text text-muted">{{ translate('provide_election') }}.</small>
            </div>

            <div class="form-group  col-md-12">
                <button class="btn btn-block btn-primary" type="submit">{{ translate('create') }}</button>
            </div>
        </div>
    </form>

    <script>
        $(".ajaxForm").validate({});
        $(".ajaxForm").submit(function(e) {
            var form = $(this);
            ajaxSubmit(e, form, departmentWiseFilter);
        });
    </script>

