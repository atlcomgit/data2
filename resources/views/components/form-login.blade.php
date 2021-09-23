<div class="card">
    <x-form-login-header>{{ __('Авторизация') }}</x-form-login-header>

    <div class="card-body">
        <form {{ $attributes }}>
            @csrf
            <x-input label="{{ __('Логин') }}" name="login" type="email" placeholder="login" required autofocus />
            <x-input label="{{ __('Пароль') }}" name="password" type="password" placeholder="..." required />
            <x-checkbox label="{{ __('Запомнить') }}" name="remember" checked />
            <x-button label="{{ __('Войти') }}" type="submit" />
        </form>
    </div>

</div>
