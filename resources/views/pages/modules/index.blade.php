@extends('extends.html')

@section('title', 'Модули')
@section('page-align-h', 'center')
@section('page-align-v', 'middle')

@section('content')
    <h1 class="mb-4">Модули</h1>
    @if (empty($_modules))
        {{ __('Нет доступных модулей') }}
    @else
        @foreach ($_modules as $_module)
            <div class="row ps-4 pe-4">
                <a class="btn btn-primary btn-lg btn-block mb-4 p-3" href="{{ route('pages.module.show', $_module->name) }}">
                    {{ $_module->title }}
                </a>
            </div>
        @endforeach
    @endif
@endsection
