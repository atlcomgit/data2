@extends('extends.html')

@section('page-align-h', 'center')
@section('page-align-v', 'top')

@section('module')
    <x-module>{{ Str::ucfirst($module) }}</x-module>
@endsection

@section('content')
    @include("extends.$module")
@endsection
