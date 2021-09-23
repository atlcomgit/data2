@extends('layouts.html')

@section('title', __('Авторизация'))

@section('content')
    <div class='container'>
        <div class="row">

            <div class="col-12 col-md-6 offset-md-3">
                <x-form-login action="{{ route('login.store') }}" method="POST" />
            </div>

        </div>
    </div>
@endsection
