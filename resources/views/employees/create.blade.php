<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
</head>
<body>

<div class="container p-5" style="margin-bottom: 100px;">
<h1>Создание нового сотрудника</h1>
<form method="post" action="/employees" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="mb-3">
        <label for="name" class="form-label">Имя:</label>
        <input type="text" name='name' class="form-control" id="name"  placeholder="Руфина">
    </div>
    <div class="mb-3">
        <label for="surname" class="form-label">Фамилия:</label>
        <input type="text" name='surname' class="form-control" id="surname" placeholder="Гатауллина">
    </div>
    <div class="mb-3">
        <label for="patronymic" class="form-label">Отчество:</label>
        <input type="text" name='patronymic' class="form-control" id="patronymic" placeholder="Ринатовна">
    </div>
    <div class="mb-3">
        <label for="bth" class="form-label">День рождения:</label>
        <input type="date" name='bth' class="form-control" id="bth" >
    </div>
    <div class="mb-3">
        <label for="photo" class="form-label">Фото:</label>
        <input type="file" name='photo' class="form-control" id="photo" >
    </div>
    <div class="mb-3">
        <label for="position" class="form-label">Должность сотрудника:</label>
        <select id="position" name='type_position' class="form-select" aria-label="Default select example" required >
            <option disabled>-- Выберите должность сотрудника --</option>
            <option value="1">Бухгалтер</option>
            <option value="2">Администратор</option>
            <option value="3">Менеджер</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="Id_organization" class="form-label">Организация:</label>
        <select id="Id_organization" name='Id_organization' class="form-select" aria-label="Default select example" required >
            <option disabled>-- Выберите организацию --</option>
            @foreach($listOrganizations as $organization)
                <option value="{{ $organization->id }}">{{ $organization->organization_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="md-3">
        <button type="submit" class="btn btn-primary">Добавить</button>
        <a href="/employees" class="btn btn-secondary">Отменить</a>
    </div>
    
</form>
</div>

</body>
</html>


