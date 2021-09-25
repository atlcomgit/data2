@section('title', 'Online')

@empty($data)
    Нет данных
    @else
        <x-table module="{{ $module }}" columns="Город, Название, Статус">
            @foreach ($data as $db)
                <tr>
                    <td><div>{{ module_column('olnCityName',$db) }}</div></td>
                    <td><div>{{ module_column('olnAgencyName',$db) }}</div></td>
                    <td><div>{{ module_column('olnStatus',$db) }}</div></td>
                </tr>
            @endforeach
        </x-table>
@endempty
