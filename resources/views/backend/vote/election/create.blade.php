<form method="POST" class="d-block ajaxForm" action="{{ route('election.store') }}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name">{{ translate('election_name') }}</label>
                <input type="text" class="form-control" id="name" name = "name" required>
                <small id="" class="form-text text-muted">{{ translate('provide__name') }}.</small>
            </div>

            <div class="form-group col-md-12">
                <label for="start_date">{{ translate('start_date') }}</label>
                <input type="text" class="form-control date" id="issue_date" data-toggle="date-picker" data-single-date-picker="true" name = "start_date" value="" required>
                <small id="" class="form-text text-muted">{{ translate('start_date') }}.</small>
            </div>

            <div class="form-group col-md-12">
                <label for="start_time">{{ translate('start_time') }}</label>
                <input type="time" id="start_time" class="form-control timepicker" name="start_time"/>
                <small id="" class="form-text text-muted">{{ translate('start_time') }}.</small>
            </div>

            <div class="form-group col-md-12">
                <label for="end_date">{{ translate('end_date') }}</label>
                <input type="text" class="form-control date" id="end_date" data-toggle="date-picker" data-single-date-picker="true" name = "end_date" value="" required>
                <small id="" class="form-text text-muted">{{ translate('end_date') }}.</small>
            </div>

            <div class="form-group col-md-12">
                <label for="end_time">{{ translate('end_time') }}</label>
                <input type="time" id="end_time" class="form-control timepicker" name="end_time"/>
                <small id="" class="form-text text-muted">{{ translate('end_time') }}.</small>
            </div>

            <div class="form-group  col-md-12">
                <button class="btn btn-block btn-primary" type="submit">{{ translate('create') }}</button>
            </div>
        </div>
    </form>

    <script>

        $(document).ready(function() {
            $('#issue_date').daterangepicker();
        });

        $(document).ready(function() {
            $('#end_date').daterangepicker();
        });


            $(document).ready(function() {
                $('#end_time').timepicker();
            });

        $(".ajaxForm").validate({});
        $(".ajaxForm").submit(function(e) {
            var form = $(this);
            ajaxSubmit(e, form, departmentWiseFilter);
        });
    </script>

