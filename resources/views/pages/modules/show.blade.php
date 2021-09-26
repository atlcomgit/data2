@extends('extends.html')

@section('page-align-h', 'center')
@section('page-align-v', 'top')

@section('module')
    <x-module>{{ Str::ucfirst($module) }}</x-module>
@endsection

@section('content')
    <x-vue-content>
        @include("extends.$module")
    </x-vue-content>
@endsection

@once
    @push('js')
        <script src="/js/app.vue.js"></script>
    @endpush
@endonce
