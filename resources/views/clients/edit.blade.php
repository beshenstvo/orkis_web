<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <title>Edit</title>
</head>
<body>
    <div class='container p-4' style="margin-bottom: 100px;">
        <div class="row">
            <div class="d-flex flex-row justify-content-between bd-highlight col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Изменить клиента c id: {{ $client->id }}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-warning" href="{{ route('clients.index') }}">Вернуться назад</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('clients.update',$client->id) }}" method="POST">
            @csrf

            @method('PUT')
            <div class="row">
                <div class="mb-3">
                        <strong>Имя:</strong>
                        <input type="text" name="name" value="{{ $client->name }}" class="form-control" >
                </div>
                <div class="mb-3">
                        <strong>Фамилия:</strong>
                        <input type="text" name="surname" value="{{ $client->surname }}" class="form-control" >
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <strong>Имя:</strong>
                        <input type="text" name="patronymic" value="{{ $client->patronymic }}" class="form-control" >
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <strong>Дата рождения:</strong>
                        <input type="date" name="bth" value="{{ $client->bth }}" class="form-control" >
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <strong>Серия паспорта:</strong>
                        <input type="text" name="series_passport" value="{{ $client->series_passport }}" class="form-control" >
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <strong>Номер паспорта:</strong>
                        <input type="text" name="number_passport" value="{{ $client->number_passport }}" class="form-control" >
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <strong>Дата выдачи:</strong>
                        <input type="date" name="date_of_issue" value="{{ $client->date_of_issue }}" class="form-control" >
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <strong>Дата окончания срока действия:</strong>
                        <input type="date" name="expiration_date" value="{{ $client->expiration_date }}" class="form-control" >
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <strong>Орган выдавший документ:</strong>
                        <input type="text" name="government_agency" value="{{ $client->government_agency }}" class="form-control" >
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <strong>Место рождения:</strong>
                        <input type="text" name="place_of_birth" value="{{ $client->place_of_birth }}" class="form-control" >
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <strong>Пол:</strong>
                        <select id="sex" name='type_sex' class="form-select" aria-label="Default select example" required >
                            <option <?php if($client->type_sex == 'ж') echo("selected"); ?>  value="1">Женский</option>
                            <option <?php if($client->type_sex == 'м') echo("selected"); ?>  value="2">Мужской</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <strong>Статус:</strong>
                        <select id="typeClient" name='type_client' class="form-select" aria-label="Default select example" required >
                            <option <?php if($client->type_client == 'VIP') echo("selected"); ?> value="1">VIP</option>
                            <option <?php if($client->type_client == 'Привилегированный') echo("selected"); ?> value="2">Привилегированный</option>
                            <option <?php if($client->type_client == 'Обычный')  echo("selected"); ?>  value="3">Обычный</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </div>
            </div>
        </form>
    </div>

</body>
</html>