@extends('layouts.app')

@section('content')
    @component('components.full-page-section')

        @if (session('resent'))
            <div class="notification is-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        @component('components.card')
            @slot('title')
                <span class="icon"><i class="mdi mdi-account-box-outline"></i></span>
                <span>{{ __('Verify Your Email Address') }}</span>
            @endslot

            <div class="content">
                <p>
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                </p>
                <p>
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </p>
            </div>
        @endcomponent
    @endcomponent
@endsection
