@extends('signon.layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('vote.backend.layouts.headers.check')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">

                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">

                            {{ __(' Verify Security Question') }}

                            <br>

                        </div>
                        <form role="form" method="POST" action="{{ route('vot.cast') }}">
                            @csrf

                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="em em-grey_question" aria-role="presentation" aria-label="WHITE QUESTION MARK ORNAMENT"></i></span>
                                    </div>
                                    <input class="form-control" name="q1" placeholder="{{ $user->sec->name }}" type="text" value="" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="em em-capital_abcd" aria-role="presentation" aria-label="INPUT SYMBOL FOR LATIN CAPITAL LETTERS"></i></span>
                                    </div>
                                    <input class="form-control" name="a1" placeholder="{{ __('Your Answer') }}" type="text" value="" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="em em-grey_question" aria-role="presentation" aria-label="WHITE QUESTION MARK ORNAMENT"></i></span>
                                    </div>
                                    <input class="form-control" name="q2" placeholder="{{ $user->seq->name }}" type="text" value="" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="em em-capital_abcd" aria-role="presentation" aria-label="INPUT SYMBOL FOR LATIN CAPITAL LETTERS"></i></span>
                                    </div>
                                    <input class="form-control" name="a2" placeholder="{{ __('Your Answer') }}" type="text" value="" required>
                                </div>
                            </div>

                            <div>
                                <input type="hidden" class="form-control" name="id"  value="{{$id}}" >
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Verify') }}</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
