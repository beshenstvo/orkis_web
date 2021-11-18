<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <title>Предварительный просмотр печати</title>
    <style>
        @media print {
            body{
                visibility: hidden;
            }
            .print{
                visibility: visible;
            }
            .noprint {
                visibility: hidden;
            }
        }
    </style>
</head>
<body>
    <div class="mt-3 print container">
    <table cellspacing="0" cellpadding="10" style="border: 1px solid; width: 80%; margin-left:auto; margin-right:auto;">
        <thead>
        </thead>
        <tbody>
            <tr>
            <th scope="row" style="text-align:end; width: 30%">Клиент</th>
            <td>{{ $data[0]->client_surname }} {{ $data[0]->client_name }} {{ $data[0]->client_patronymic }}</td>
            </tr>
            <tr>
            <th scope="row" style="text-align:end; width: 30%">Туристы</th>
            <td>{{ $data[0]->participant_fullname }} </td>
            </tr>
        </tbody>
    </table>

    <table cellspacing="0" cellpadding="10" style="border-left: 1px solid;
    border-right: 1px solid;;width: 80%;margin-left:auto; margin-right:auto; ">
        <thead>
        </thead>
        <tbody>
            <tr>
                <th scope="row" style="text-align:end;"></th>
                <td style="border-right: 1px solid;border-left: 1px solid;"></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <table cellspacing="0" cellpadding="10" style="border: 1px solid; width: 80%;margin-left:auto; margin-right:auto;">
        <thead>
        </thead>
        <tbody>
        <tr>
            <th scope="row" style="text-align:end; width: 30%">Период путешествия</th>
            <td>С {{ $data[0]->start_of_trip }} по {{ $data[0]->end_of_trip }}</td>
            </tr>
            <tr>
            <th scope="row" style="text-align:end; width: 30%">Страна</th>
            <td>{{ $data[0]->name_country }}: {{ $data[0]->name_city }}</td>
            </tr>
            <tr>
            <th scope="row" style="text-align:end; width: 30%">Вид транспорта</th>
            <td>{{ $data[0]->type_of_transport }}</td>
            </tr>
            <tr>
            <th scope="row" style="text-align:end; width: 30%">Проездные документы</th>
            <td>прилагаются/получите за 2 дня до даты от’езда</td>
            </tr>
            <tr>
            <th scope="row" style="text-align:end; width: 30%">Трансфер</th>
            <td> {{$data[0]->transfer}}</td>
            </tr>
        </tbody>
    </table>


    <table cellspacing="0" cellpadding="10" style="border-left: 1px solid;
    border-right: 1px solid;;width: 80%;margin-left:auto; margin-right:auto; ">
        <thead>
        </thead>
        <tbody>
            <tr>
                <th scope="row" style="text-align:end;"></th>
                <td style="border-right: 1px solid;border-left: 1px solid;"></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <table cellspacing="0" cellpadding="10" style="border: 1px solid;width: 80%;margin-left:auto; margin-right:auto; ">
        <thead>
        </thead>
        <tbody>
            <tr>
                <th scope="row" style="text-align:end; width: 30%">Проживание</th>
                <td>{{ $data[0]->name_hotel }} {{ $data[0]->address }}</td>
                <td>Номер: {{ $data[0]->type_room }} </br> Питание: {{ $data[0]->type_food }}</td>
            </tr>
            <tr>
                <th scope="row" style="text-align:end; width: 30%"></th>
                <td>Время заселения в гостиницу 12:00 </br> Время выезда из гостиницы 14:00</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <div class="mt-3 mb-3" style="width: 80%;margin-left:auto; margin-right:auto; ">
        Благодарим Вас, что Вы воспользовались услугами ООО «Мечта путешественника».</br></br>
        По всем вопросам во время путешествия обращайтесь в службу сопровождениях по тел. 8(800)200-00-00.</br></br>
        Приятного отдыха!</br>
         <div class='mt-3 noprint'>
            <a href="javascript:window.print()" class="btn btn-warning">Распечатать</a>
            <a href="/voucher" class="btn btn-secondary">Отменить</a>
         </div>
    </div>
    </div>
</body>
</html>