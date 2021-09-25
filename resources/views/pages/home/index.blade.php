@extends('extends.html')

@section('title', 'Главная')
@section('page-align-h', 'center')
@section('page-align-v', 'middle')

@section('content')
    <a href="{{ route('pages.auth.login') }}" class="btn btn-primary btn-lg col-4" role="button">{{ __('Вход') }}</a>
@endsection

@once
    @push('css')
        <link rel="stylesheet" href="/css/home.css">
    @endpush
@endonce
