@extends('layouts.app')

@section('content')
    @component('components.full-page-section')

        @if (session('status'))
            <div class="notification is-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @component('components.card')
            @slot('title')
                <span class="icon"><i class="mdi mdi-lock-open"></i></span>
                <span>{{ __('Reset Password') }}</span>
            @endslot

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="field">
                    <label class="label" for="email">{{ __('E-Mail Address') }}</label>
                    <div class="control">
                        <input id="email" type="email" class="input @error('email') is-danger @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    @error('email')
                        <p class="help is-danger" role="alert">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <hr>

                <div class="field is-form-action-buttons">
                    <button type="submit" class="button is-black">
                        {{ __('Send Password Reset Link') }}
                    </button>

                    <a class="button is-black is-outlined" href="{{ route('login') }}">
                        {{ __('Back') }}
                    </a>
                </div>

            </form>

        @endcomponent
    @endcomponent
@endsection
