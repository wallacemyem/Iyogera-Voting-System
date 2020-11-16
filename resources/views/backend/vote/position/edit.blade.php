<form method="POST" class="d-block ajaxForm" action="{{ route('position.update', $user->id) }}">
        @csrf
        @method('PATCH')
        <div class="form-row">
        <div class="form-group col-md-12">
                <label for="name">{{ $user->name }}</label>
                <input type="text" class="form-control" id="name" name = "name" required value="{{ $user->name }}">
                <small id="" class="form-text text-muted">{{ translate('provide_user_first_name') }}.</small>
            </div>

            <div class="form-group col-md-12">
                <label for="election">{{ translate('election') }}</label>
                <select name="election_id" id="election_id" class="form-control" required>
                    <option value="">{{ $user->election->name }}</option>
                    @foreach (\App\Election::where('school_id', school_id())->get() as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                <small id="" class="form-text text-muted">{{ translate('provide_election') }}.</small>
            </div>

            <div class="form-group  col-md-12">
                <button class="btn btn-block btn-primary" type="submit">{{ translate('update') }}</button>
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
