@props([
    'module' => 'Модуль',
    'columns' => 'Название',
    'click' => '',
])

@php
    $module = __(data2()->config('modules')[$module]);
    $columns = explode(',',$columns);
@endphp

<table class="table table-striped table-data table-sm" {{ $attributes }}> 
    <thead>
        @isset($module)
            <tr>
                <th colspan="10" class="title bg-primary border-bottom text-center">{{ $module }}</th>
            </tr>
        @endisset
        <tr>
            @foreach ($columns as $column)
                <th scope="col">{{ trim($column) }}</th>    
            @endforeach
        </tr>
    </thead>

    <tbody> 
        {{$slot}}
    </tbody>
</table>
