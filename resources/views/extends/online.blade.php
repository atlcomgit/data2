@section('title', Str::ucfirst($module))

@section('content-style')
    <style>
        .table-data                 {-moz-user-select:none; -webkit-user-select:none; -ms-user-select:none; -o-user-select:none; user-select:none; cursor:default;} 
        .table-data th:nth-child(1), .table-data td:nth-child(1) {width:25vw; text-align: left}
        .table-data th:nth-child(2), .table-data td:nth-child(2) {width:50vw; text-align: left}
        .table-data th:nth-child(3), .table-data td:nth-child(3) {width:20vw; text-align: center}
        .table-data th.title        {position:sticky; position:-webkit-sticky; top:0; text-align: center; color: white}
        .table-data td              {}
        .table-data td div          {white-space: nowrap; text-overflow: ellipsis; overflow: hidden; min-width: 0; overflow-wrap: break-word; width: inherit;}

        .table-modal th:nth-child(1), .table-modal td:nth-child(1) {width:25vw; text-align: left}
        .table-modal th:nth-child(2), .table-modal td:nth-child(2) {width:50vw; text-align: right}
    </style>
@endsection

<v-modal>
    <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">{{ __('Информация о пользователе') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div v-if="modal_data === null">
            {{ __('Информация не найдена') }}
        </div>
        <div v-else>
            <x-table class="table-modal w-100 h-100">
                <tr><td>{{ __('Время') }}</td>      <td>@{{ column_data('olnDate') }} в @{{ column_data('olnTime') }}</td></tr>
                <tr><td>{{ __('Город') }}</td>      <td>@{{ column_data('olnCityName') }}</td></tr>
                <tr><td>{{ __('Агентство') }}</td>  <td><b>@{{ column_data('olnAgencyName') }}</b></td></tr>
                <tr><td>{{ __('Имя') }}</td>        <td>@{{ column_data('olnUserName') }}</td></tr>
                <tr><td>{{ __('Телефон') }}</td>    <td><a :href="'tel:'+modal_data.olnUserPhone" class="link-primary">@{{ column_data('olnUserPhone') }}</a></td></tr>
                <tr><td>{{ __('ASN') }}</td>        <td>@{{ column_data('olnUserASN') }}</td></tr>
                <tr><td>{{ __('Активация') }}</td>  <td>@{{ column_data('olnTermTo') }} <span :class="column_class('olnTermDays')"><b>(@{{ column_data('olnTermDays') }})</b></span></td></tr>
                <tr><td>{{ __('В онлайне') }}</td>  <td>@{{ column_data('olnCheckDT') }}</td></tr>
                <tr><td>{{ __('IP адрес') }}</td>   <td>@{{ column_data('olnIP') }}</td></tr>
                <tr><td>{{ __('Страница') }}</td>   <td><a :href="'https://'+modal_data.olnPageUrl" class="link-primary" target="_blank">@{{ column_data('olnPageUrl') }}</a></td></tr>
                <tr><td colspan="2"><hr></td></tr>
                <tr><td colspan="2">
                        <div class="container-sm">
                            <div class="d-inline-flex px-2 py-1 me-2 bg-primary text-white" v-if="is_operator()">{{ __('Оператор') }}</div>
                            <div class="d-inline-flex px-2 py-1 me-2 bg-danger text-white" v-else-if="modal_data.olnTermTo < today && modal_data.olnUserCode != ''">{{ __('Отключен') }}</div>
                            <div class="d-inline-flex px-2 py-1 me-2 bg-warning" v-else-if="modal_data.olnUserCode == ''">{{ __('Гость') }}</div>
                            <div class="d-inline-flex px-2 py-1 me-2 bg-success text-white" v-else>{{ __('Активный') }}</div>
                            
                            <div class="d-inline-flex px-2 py-1 me-2 bg-info" v-if="modal_data.olnFree == true && !is_operator()">{{ __('Бесплатный') }}</div>
                            <div class="d-inline-flex px-2 py-1 me-2 bg-light text-danger" v-if="modal_data.olnDolgFree == true && !is_operator()">{{ __('Долг') }}</div>
                            <div class="d-inline-flex px-2 py-1 me-2 bg-dark text-white" v-if="modal_data.olnLocal == true && !is_operator()">{{ __('Local') }}</div>
                            
                            <div class="d-inline-flex px-2 py-1 me-2 bg-secondary text-white" v-if="modal_data.olnBye == true">{{ __('Вышел') }}</div>
                            <div class="d-inline-flex px-2 py-1 me-2 bg-primary text-white" v-if="modal_data.olnIP == '{{ $ip }}'">{{ __('Мой IP') }}</div>
                        </div>
                    </td>
                </tr>
                </tr>
            </x-table>
        </div>
    </div>
    <div class="modal-footer">
        {{-- <button type="button" class="btn btn-primary">{{ __('OK') }}</button> --}}
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Закрыть') }}</button>
    </div>
</v-modal>

<div v-if="content_starting || content_getting">Загрузка...</div>
<div v-else>
    <div v-if="content_data.length == 0">Нет данных</div>
    <div v-else>
        <x-table-content module="{{ $module }}" columns="Город, Название, Статус">
            <tr :class="['default', (content.sid == modal_sid ? 'bg-primary text-white' : content.class)]" v-for="content in content_data" @click="moduleShowModal" :sid="content.sid">
                    <td><div>@{{ content.city }}</div></td>
                    <td><div>@{{ content.agency }}</div></td>
                    <td><div :class="[((parseInt(content.status) > 0) ? 'text-success' : '')]">@{{ content.status }}</div></td>
                </td>
        </x-table-content>

    </div>
</div>
