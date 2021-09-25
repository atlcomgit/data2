{{-- <x-form-login action="{{ route('login.store') }}" /> --}}

@props([
    'method' => 'POST',
])

@php
    $method = strtoupper($method);
    $method_is_getpost = in_array($method, ['GET', 'POST']);
@endphp


<div class="card">
    <x-form-login-header>{{ __('Авторизация') }}</x-form-login-header>

    <div class="card-body">
        <form
            {{ $attributes }}
            method="{{ $method_is_getpost ? $method : 'POST' }}"
        >
            @csrf

            @unless($method_is_getpost)
                @method($method)
            @endunless

            <x-input label="{{ __('Логин') }}" name="login" type="text" placeholder="login" required autofocus />
            @error('email') error {{$message}} @enderror

            <x-input label="{{ __('Пароль') }}" name="password" type="password" placeholder="..." required />
            <x-checkbox label="{{ __('Запомнить') }}" name="remember" checked />
            <x-button class="col-4" label="{{ __('Войти') }}" type="submit" />
        </form>
    </div>

</div>
