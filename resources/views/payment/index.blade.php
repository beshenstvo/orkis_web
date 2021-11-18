@extends ('layout')
@section ('content')

<div class="d-flex flex-row justify-content-between">
<div><h2>Оплаченные договора</h2></div>
<div class="d-flex justify-content-end" style="align-self: center;"><a href="payment/create" class="btn btn-primary mb-2">Создать новый платеж</a></div>
</div>

<div class="d-flex flex-column bd-highlight mb-3 align-items-center">
        <table class="table table-striped ">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Номер договора</th>
            <th scope="col">Дата оплаты</th>
            <th scope="col">Организация</th>
            <th scope="col">Бухгалтер</th>
            <th scope="col">Сумма в рублях</th>
            <!-- <th scope="col">Действия</th> -->
            </tr>
        </thead>
        <tbody>
        @foreach ($payments as $payment)
            <tr>
            <th scope="row">{{ $payment->id }}</th>
            <td>{{ $payment->id_contract }}</td> 
            <td>{{ $payment->date_of_payment }}</td>
            <td>{{ $payment->organization_name }}</td> 
            <td> {{ $payment->employee_surname }}  {{ $payment->employee_name }} {{ $payment->employee_patronymic }}</td> 
            <td>{{ $payment->amount_in_rubels }}</td>
            <td><div class="p-2 bd-highlight d-flex  align-items-end">
                <!-- <div>
                    <a class="btn btn-warning" href="{{ route('payment.edit', $payment->id) }}">Изменить</a>
                </div> -->
                <!-- <div>
                    <form action="{{ route('payment.destroy',$payment->id) }}" method="post">
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
<title>Платежи</title>
@endsection