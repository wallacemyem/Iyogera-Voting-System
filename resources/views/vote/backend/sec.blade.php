@extends('signon.layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('signon.layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">

                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">

                            {{ __(' Add Security Question') }}

                            <br>

                        </div>
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf


                                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 mb-3 mb-lg-0">
                                    <select class="form-control" name="q1" id="q1">
                                        <option value="all">{{ __('Select a Question') }}</option>

                                            <option value="1">What primary school did you attend?</option>
                                            <option value="2">What is the middle name of your oldest sibling?</option>
                                             <option value="3">In what town or city did your parents meet?</option>

                                    </select>
                                </div>

                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">

                                    </div>
                                    <input class="form-control" name="password" placeholder="{{ __('New Password') }}" type="password" value="" required>
                                </div>
                            </div>

                                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 mb-3 mb-lg-0">
                                    <select class="form-control" name="q2" id="q2">
                                        <option value="all">{{ __('Select a Question') }}</option>

                                        <option value=""></option>

                                    </select>
                                </div>

                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        
                                    </div>
                                    <input class="form-control" name="con_password" placeholder="{{ __('Confirm Password') }}" type="password" value="" required>
                                </div>
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
