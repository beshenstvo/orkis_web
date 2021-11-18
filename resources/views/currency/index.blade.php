@extends ('layout')
@section ('content')

<div class="d-flex flex-row justify-content-between">
<div><h2>Валюты на дату: {{ $date }}</h2></div>
</div>

<div class="d-flex flex-column bd-highlight mb-3 align-items-center">
<table class="table table-sm table-striped ">
    <thead>
        <tr>
            <th scope="col">Код</th>
            <th scope="col">Наименование</th>
            <th scope="col">Курс</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data => $value)
                <tr>
                    <th scope="row p-3" style='vertical-align: middle;'><img src="https://img.icons8.com/stickers/100/000000/money.png"/ width='30' class='me-3'>{{ $value['NumCode'] }}</th>
                    <td class="p-3">{{ $value['Name'] }}</td>
                    <td class="p-3">{{ $value['Value'] }}</td>
                </tr>
        @endforeach

    </tbody>
</table>
</div>



@endsection

@section ('title')
<title>Валюты</title>
@endsection