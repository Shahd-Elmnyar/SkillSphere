@extends('web.layout')
@section('title')
{{__('web.verifyEmail')}}
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">

                            <div class="alert alert-success" role="alert">
                                {{ __('A new verification link has been sent to the email address you provided during registration') }}
                            </div>


                        <div class="mt-4 text-center">
                            <form method="POST" action="{{ url('email/verification-notification') }}">
                                @csrf

                                <button type="submit" class="main-button icon-button pull-right">>
                                    {{ __('Resend Verification Email') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
