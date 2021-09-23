@extends('layouts.html')

@section('title', 'Модули')

@section('content')

    <h1>Модули</h1>
    @if (empty($_modules))

        Нет модулей

    @else

        @foreach ($_modules as $_module)
            <div>
                <a href="{{ route('module.show', $_module->name) }}">{{ $_module->title }}</a>
            </div>
        @endforeach
    @endif


@endsection
