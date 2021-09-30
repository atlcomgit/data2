@extends('extends.html')

@section('page-align-h', 'center')
@section('page-align-v', 'top')

@section('module')
    <x-module>{{ Str::ucfirst($module) }}</x-module>
@endsection

@section('content')
    <style>
        #content_vue {
            position: absolute; left: 0; right: 0; top: 0; bottom: 0;
            width:100%; height:100%; overflow-x:hidden; overflow-y:auto;
            }
    </style>

    <x-vue id="content_vue">
        @include("extends.$module")
    </x-vue>
@endsection

@once
    @push('js')
        <script> var module_name = '{{ $module }}'; </script>
        <script type="module" src="{{ asset("js/module.js?v=").md5(File::lastModified(public_path("/js/module.js"))) }}"></script>
    @endpush
@endonce
