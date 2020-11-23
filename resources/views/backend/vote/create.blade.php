<form method="POST" class="d-block ajaxForm" action="{{ route('nominee.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">

            <div class="form-group row mb-3">
                <label class="col-md-3 col-form-label" for="example-fileinput">{{ translate('nominee_image') }}</label>
                <div class="col-md-9">
                    <input type="file" id="example-fileinput" name="nominee" class="form-control-file">
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="name">{{ translate('student') }}</label>
                <select name="name" id="name" class="form-control" required>
                    <option value="">{{ translate('please_select_the_election') }}</option>
                    @foreach (\App\Student::where('school_id', school_id())->get() as $department)
                        <option value="{{ $department->id }}">{{ $department->user->first_name }} {{ $department->user->middle_name }} {{ $department->user->other_name }}</option>
                    @endforeach
                </select>
                <small id="" class="form-text text-muted">{{ translate('select_student') }}.</small>
            </div>

            <div class="form-group col-md-12">
                <label for="class_id"> {{ translate('election') }}</label>
                    <select name="election_id" id="election_id" class="form-control" onchange="classWiseSection(this.value)" required>
                        <option value="all">Select An Election</option>
                        @foreach (App\Election::where('school_id', school_id())->get() as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                <small id="" class="form-text text-muted">{{ translate('select_election') }}.</small>
            </div>

            <div class="form-group col-md-12" id="section_content">

            </div>

            <div class="form-group col-md-12">
                <label for="motto">{{ translate('motto') }}</label>
                <input type="text" class="form-control" id="motto" name="motto" required>
                <small id="" class="form-text text-muted">{{ translate('provide_student_email') }}.</small>
            </div>

            <div class="form-group col-md-12">
                <label for="desc">{{ translate('description') }}</label>
                <textarea id="desc" name="desc" rows="4" cols="48"></textarea>
                <small id="" class="form-text text-muted">{{ translate('description') }}.</small>
            </div>

            <div class="form-group  col-md-12">
                <button class="btn btn-block btn-primary" type="submit">{{ translate('save') }}</button>
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

@section('scripts')
    <script>
        var form;
        function classWiseSection(election_id) {
            if(election_id > 0) {

            }else {
                console.log(123);
            }
            var url = '{{ route("section.show", "election_id") }}';
            url = url.replace('election_id', election_id);

            $.ajax({
                type : 'GET',
                url: url,
                success : function(response) {
                    $('#section_content').html(response);
                }
            });
        }

        function onChangeSection(position_id) {

        }

        $(".ajaxForm").validate({});
        $("#single_admission").submit(function(e) {

            form = $(this);
            ajaxSubmit(e, form, refreshForm);
        });

        var refreshForm = function () {
            form.trigger("reset");
        }

    </script>

