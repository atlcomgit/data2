@section('title', 'Online')

@empty($data)
    {{-- Нет данных
    @else
        <x-modal-dialog title="Title" ok="Ok" cancel="Закрыть"></x-modal-dialog>

        <style>
            .table-data th:nth-child(1), .table-data td:nth-child(1) {width:25vw; text-align: left}
            .table-data th:nth-child(2), .table-data td:nth-child(2) {width:50vw; text-align: left}
            .table-data th:nth-child(3), .table-data td:nth-child(3) {width:20vw; text-align: center}
        </style>
        <x-table module="{{ $module }}" columns="Город, Название, Статус">
            @foreach ($data as $db)
                <tr class="{{ module_class($module,$db) }}">
                    <td><div>{{ module_column('olnCityName',$db) }}</div></td>
                    <td><div>{{ module_column('olnAgencyName',$db) }}</div></td>
                    <td><div>{{ module_column('olnStatus',$db) }}</div></td>
                </tr>
            @endforeach
        </x-table> --}}
@endempty
