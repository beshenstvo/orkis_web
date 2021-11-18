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
                    <h2>Изменить сотрудника c id: {{ $employee->id }}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-warning" href="{{ route('employees.index') }}">Вернуться назад</a>
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

        <form action="{{ route('employees.update',$employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="mb-3">
                        <strong>Имя:</strong>
                        <input type="text" name="name" value="{{ $employee->name }}" class="form-control" >
                </div>
                <div class="mb-3">
                        <strong>Фамилия:</strong>
                        <input type="text" name="surname" value="{{ $employee->surname }}" class="form-control" >
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <strong>Имя:</strong>
                        <input type="text" name="patronymic" value="{{ $employee->patronymic }}" class="form-control" >
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <strong>Дата рождения:</strong>
                        <input type="date" name="bth" value="{{ $employee->bth }}" class="form-control" >
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <strong>Фото:</strong>
                        <input type="text" id='photo' name="photo" value="{{ $employee->photo }}"  class="form-control" disabled>
                        <input type="file" id='photo' name="photo"  class="form-control" >
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <strong>Должность:</strong>
                        <select id="position" name='type_position' class="form-select" aria-label="Default select example" required >
                            <option <?php if($employee->type_position == 'Бухгалтер') echo("selected"); ?>  value="1">Бухгалтер</option>
                            <option <?php if($employee->type_position == 'Администратор') echo("selected"); ?>  value="2">Администратор</option>
                            <option <?php if($employee->type_position == 'Менеджер') echo("selected"); ?>  value="3">Менеджер</option>
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

