@extends('signon.layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('signon.layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                   
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">

                            {{ $find->code }} {{ __(' Change Password') }}
                           
                            <br>
                            
                        </div>
                        <form role="form" method="POST" action="{{ route('change.pass') }}">
                            @csrf

                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="em em-lock" aria-role="presentation" aria-label="LOCK"></i></span>
                                    </div>
                                    <input class="form-control" name="password1" placeholder="{{ __('Temporary Password') }}" type="password" value="" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="em em-lock" aria-role="presentation" aria-label="LOCK"></i></span>
                                    </div>
                                    <input class="form-control" name="password" placeholder="{{ __('New Password') }}" type="password" value="" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="em em-lock" aria-role="presentation" aria-label="LOCK"></i></span>
                                    </div>
                                    <input class="form-control" name="con_password" placeholder="{{ __('Confirm Password') }}" type="password" value="" required>
                                </div>
                            </div>

                            <input name="matric" type="hidden" value="{{ $find->code }}" >

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Change') }}</button>
                            </div>
                        </form>
                    </div>
					
                </div>
                
            </div>
        </div>
    </div>
@endsection