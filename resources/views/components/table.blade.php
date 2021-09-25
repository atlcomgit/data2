@props([
    'module' => 'Модуль',
    'columns' => 'Название',
])

@php
    $module = __(data2()->config('modules')[$module]);
    $columns = explode(',',$columns);
@endphp

<style>
    .div-content                {position: absolute; left: 0; right: 0; top: 0; bottom: 0;
                                    width:100%; height:100%; overflow-x:hidden; overflow-y:auto;}
    .table-data                 {-moz-user-select:none; -webkit-user-select:none; -ms-user-select:none; -o-user-select:none; user-select:none; cursor:default;} 
    .table-data th.title        {position:sticky; position:-webkit-sticky; top:0; text-align: center; color: white}
    .table-data td              {}
    .table-data td:nth-child(1) {width:20vw; text-align: left}
    .table-data td:nth-child(2) {width:50vw; text-align: left}
    .table-data td:nth-child(3) {width:20vw; text-align: center}
    .table-data td div          {white-space: nowrap; text-overflow: ellipsis; overflow: hidden; min-width: 0; overflow-wrap: break-word; width: inherit;}
</style>

<div class="div-content" style="">
    <table class="table table-striped table-data table-sm"> 
        <thead>
            @isset($module)
                <tr>
                    <th colspan="10" class="title bg-primary border-bottom">{{ $module }}</th>
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
</div>
