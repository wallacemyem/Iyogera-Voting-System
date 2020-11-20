@extends('vote.backend.layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('vote.backend.layouts.headers.vue')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">

                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">

                            {{ __('Provide your Matriculation Number') }}

                            <br>

                        </div>
                        <form role="form" method="POST" action="{{ route('get.matric') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="em em-1234" aria-role="presentation" aria-label="INPUT SYMBOL FOR NUMBERS"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="{{ __('Matriculation Number') }}" type="text" name="matric"  value="" required autofocus>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Start') }}</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
