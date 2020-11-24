@extends('signon.layouts.app', ['class' => 'bg-default'])

@section('content')

    @include('signon.layouts.headers.guest')

    <div class="container mt--8 pb-5">

        <div class="row justify-content-center">

            <div class="col-lg-5 col-md-7">

                <div class="card bg-secondary shadow border-0">

                    <div class="card-body px-lg-5 py-lg-5">

                        <div class="text-center text-muted mb-4">

                            {{ __(' Select Elections and Position') }}

                            <br>

                        </div>

                        <form role="form" method="POST" action="{{ route('sec.q') }}">

                            @csrf

                            <div class="dropdown">

                                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 mb-3 mb-lg-0">

                                    <select class="form-control" name="election_id" id="election_id">

                                        <option value="all">{{ __('Select an Election') }}</option>

                                         @foreach (App\Election::where('school_id', school_id())->get() as $class)

                                         <option value="{{ $class->id }}">{{ $class->name }}</option>

                                         @endforeach

                                    </select>

                                </div>

                            </div>

                            <div class="form-group col-md-12" id="section_content">

                            </div>

                            <div class="text-center">

                                <button type="submit" class="btn btn-primary my-4">{{ __('Sign in') }}</button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
@section('js')

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
    @endsection
