@extends ('layout')
@section ('content')

<div class="d-flex flex-row justify-content-between">
<div><h2>Соглашения без договора</h2></div>
<div class="d-flex justify-content-end" style="align-self: center;"><a href="agreement/create" class="btn btn-primary mb-2">Создать новое соглашение</a></div>
</div>

<div class="d-flex flex-column bd-highlight mb-3 align-items-center">
<div class="d-flex flex-row justify-content-between bd-highlight mb-3" >
    <table class="table table-striped ">
    <thead>
        <tr>
        <th scope="col">Согл.</th>
        <th scope="col">Дата оформления</th>
        <th scope="col">Количество участников</th>
        <th scope="col">Начало поездки</th>
        <th scope="col">Конец поездки</th>
        <th scope="col">Организация</th>
        <th scope="col">Агент</th>
        <th scope="col">Клиент</th>
        <th scope="col">Страна </th>
        <th scope="col">Город(а) </th>
        <!-- <th scope="col">Сотрудник</th> -->
        <th scope="col">Действия</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($agreements as $agreement)
        <tr>
        <th scope="row">{{ $agreement->id }}</th>
        <td>{{ $agreement->date }}</td>
        <td>{{ $agreement->number_of_participants}}</td>
        <td>{{ $agreement->start_of_trip }}</td>
        <td>{{ $agreement->end_of_trip }}</td>
        <td>{{ $agreement->organization_name }}</td>
        <td>{{ $agreement->agent_surname }} {{ $agreement->agent_name }} {{ $agreement->agent_patronymic }}</td>
        <td>{{ $agreement->client_surname }} {{ $agreement->client_name }} {{ $agreement->client_patronymic }}</td>
        <td>{{ $agreement->name_country }}</td>
        <td>{{ $agreement->cities }}</td>
        <!-- <td>{{ $agreement->employee_surname }}</td> -->
        <td><div class="p-2 bd-highlight d-flex  align-items-end">
            <!-- <div>
                <a class="btn btn-warning" href="{{ route('agreement.edit', $agreement->id) }}">Изменить</a>
            </div> -->
            <div>
                <form action="{{ route('agreement.destroy',$agreement->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button  type="submit"  class="btn btn-danger ms-2">Удалить</button>
                </form>
            </div>
        </div>
    </td>
        </tr>
        @endforeach
    </tbody>
    
    </table>


</div>


@endsection

@section ('title')
<title>Соглашения</title>
@endsection