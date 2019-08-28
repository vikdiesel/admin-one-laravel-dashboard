@extends('layouts.app')

@section('content')
    @component('components.full-page-section')
        @component('components.card')
            @slot('title')
                <span class="icon"><i class="mdi mdi-laravel"></i></span>
                <span>Laravel Demo</span>
            @endslot

            <div class="content">
                <p>
                    Hi, this is Laravel Demo of <a href="https://justboil.me/bulma-admin-template/one">JustBoil Admin One</a> Bulma & Vue.js admin dashboard template.
                    Please, <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a>&hellip;
                </p>
                <p>
                    &mdash; <b>Login:</b> user@example.com<br>
                    &mdash; <b>Password:</b> secret
                </p>
            </div>
            <hr>
            <div class="buttons">
                <a href="{{ route('login') }}" class="button is-black">Login</a>
                <a href="{{ route('register') }}" class="button is-black is-outlined">Register</a>
            </div>
        @endcomponent
    @endcomponent
@endsection