@extends ('layout')
@section ('content')

<div class="d-flex flex-row justify-content-between">
<div><h2>Не оплаченные договора</h2></div>
<div class="d-flex justify-content-end" style="align-self: center;"><a href="contract/create" class="btn btn-primary mb-2">Создать новый договор</a></div>
</div>

<div class="d-flex flex-column bd-highlight mb-3 align-items-center">
<table class="table table-sm table-striped ">
    <thead>
        <tr>
        <th scope="col">Договор</th>
        <th scope="col">Согл.</th>
        <th scope="col">Дата создания контракта</th>
        <th scope="col">Агент</th>
        <th scope="col">Организация</th>
        <th scope="col">Клиент</th>
        <th scope="col">Участник(и)</th>
        <th scope="col">Страна, город</th>
        <th scope="col">Гостиница</th>
        <th scope="col">Тип номера</th>
        <th scope="col">Тип питания</th>
        <th scope="col">Начало поездки</th>
        <th scope="col">Конец поездки</th>
        <th scope="col">Стоимость в валюте</th>
        <!-- <th scope="col">Действия</th> -->
        </tr>
    </thead>
    <tbody>
    @foreach ($contracts as $contract)
        <tr>
        <th scope="row">{{ $contract->id }}</th>
        <th>{{ $contract->id_agreement }}</th>
        <td>{{ $contract->contract_created_at }}</td>
        <td>{{ $contract->agent_surname}} {{ $contract->agent_name}} {{ $contract->agent_patronymic}}</td>
        <td>{{ $contract->organization_name }}</td>
        <td>{{ $contract->client_surname }} {{ $contract->client_name }} {{ $contract->client_patronymic }}</td>
        <td>{{ $contract->participant_fullname }}</td>
        <td>{{ $contract->name_country }} {{ $contract->name_city }}</td>
        <td>{{ $contract->hotel_name }}</td>
        <td>{{ $contract->type_room }}</td>
        <td>{{ $contract->type_food }}</td>
        <td>{{ $contract->start_of_trip }}</td>
        <td>{{ $contract->end_of_trip }}</td>
        <td>{{ $contract->amount_in_currency }}</td>
        <td><div class="p-2 bd-highlight d-flex  align-items-end">
            <!-- <div>
                <a class="btn btn-warning" href="{{ route('contract.edit', $contract->id) }}">Изменить</a>
            </div> -->
            <!-- <div>
                <form action="{{ route('contract.destroy',$contract->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button  type="submit"  class="btn btn-danger ms-2">Удалить</button>
                </form>
            </div> -->
        </div>
    </td>
        </tr>
        @endforeach
    </tbody>
    
</table>
</div>



@endsection

@section ('title')
<title>Договоры</title>
@endsection