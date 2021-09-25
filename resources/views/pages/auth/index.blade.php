@extends('extends.html')

@section('title', __('Авторизация'))
@section('page-align-h', 'center')
@section('page-align-v', 'middle')

@section('content')
    <div class='container'>
        <div class="row">

            <div class="col-12 col-md-4 offset-md-4">
                <x-form-login action="{{ route('pages.auth.login.check') }}" />
            </div>

        </div>
    </div>
@endsection

@once
    @push('css')
        <link rel="stylesheet" href="/css/login.css">
    @endpush

    @push('js')
        {{-- <script src="/js/login.js"></script> --}}
    @endpush
@endonce

{{-- {{ dd(auth('web')) }} --}}