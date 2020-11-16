<form method="POST" class="d-block ajaxForm" action="{{ route('user.update', $user->id) }}">
        @csrf
        @method('PATCH')
        <div class="form-row">
        <div class="form-group col-md-12">
                <label for="name">{{ translate('user_first_name') }}</label>
                <input type="text" class="form-control" id="first_name" name = "first_name" required value="{{ $user->user->first_name }}">
                <small id="" class="form-text text-muted">{{ translate('provide_user_first_name') }}.</small>
            </div>

            <div class="form-group col-md-12">
                <label for="name">{{ translate('user_last_name') }}</label>
                <input type="text" class="form-control" id="other_name" name = "other_name" required value="{{ $user->user->other_name }}">
                <small id="" class="form-text text-muted">{{ translate('provide_user_last_name') }}.</small>
            </div>

            <div class="form-group col-md-12">
                <label for="name">{{ translate('user_other_name') }}</label>
                <input type="text" class="form-control" id="middle_name" name = "middle_name" value="{{ $user->user->middle_name }}">
                <small id="" class="form-text text-muted">{{ translate('provide_user_other_name') }}.</small>
            </div>

            <div class="form-group col-md-12">
                    <label for="email">{{ translate('email') }}</label>
                <input type="email" class="form-control" id="email" name = "email" required value="{{ $user->user->email }}">
                <small id="" class="form-text text-muted">{{ translate('provide_user_email') }}.</small>
            </div>

            <div class="form-group col-md-12">
                    <label for="designation">{{ translate('matriculation') }}</label>
                <input type="text" class="form-control" id="matric" name = "matric" required value="{{ $user->code }}">
                <small id="" class="form-text text-muted">{{ translate('provide_user_matriculation') }}.</small>
            </div>

            <div class="form-group  col-md-12">
                <button class="btn btn-block btn-primary" type="submit">{{ translate('update_user') }}</button>
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
