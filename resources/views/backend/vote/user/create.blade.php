<form method="POST" class="d-block ajaxForm" action="{{ route('user.store') }}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="first_name">{{ translate('student_first_name') }}</label>
                <input type="text" class="form-control" id="first_name" name = "first_name" required>
                <small id="" class="form-text text-muted">{{ translate('provide_student_first_name') }}.</small>
            </div>

            <div class="form-group col-md-12">
                <label for="last_name">{{ translate('student_last_name') }}</label>
                <input type="text" class="form-control" id="other_name" name = "other_name" >
                <small id="" class="form-text text-muted">{{ translate('provide_student_last_name') }}.</small>
            </div>

            <div class="form-group col-md-12">
                <label for="other_name">{{ translate('student_other_name') }}</label>
                <input type="text" class="form-control" id="middle_name" name = "middle_name">
                <small id="" class="form-text text-muted">{{ translate('provide_student_other_name') }}.</small>
            </div>

            <div class="form-group col-md-12">
                <label for="matric">{{ translate('matriculation_number') }}</label>
                <input type="matric" class="form-control" id="matric" name = "matric" required>
                <small id="" class="form-text text-muted">{{ translate('matriculation_number') }}.</small>
            </div>

            <div class="form-group col-md-12">
                <label for="level">{{ translate('level') }}</label>
                <select name="level" id="level" class="form-control" required>
                    <option value="">{{ translate('please_select_a_level') }}</option>

                        <option value="100">100 Level</option>
                        <option value="200">200 Level</option>
                        <option value="300">300 Level</option>
                        <option value="400">400 Level</option>

                </select>
                <small id="" class="form-text text-muted">{{ translate('provide_level') }}.</small>
            </div>

            <div class="form-group  col-md-12">
                <button class="btn btn-block btn-primary" type="submit">{{ translate('create_user') }}</button>
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

