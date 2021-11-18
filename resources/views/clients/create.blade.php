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
<h1>Создание нового клиента</h1>
<form method="post" action="/clients">
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
        <label for="serialPassport" class="form-label">Серия паспорта:</label>
        <input type="text" name='series_passport' class="form-control" id="serialPassport" placeholder="0987">
        <div id="nameSerialPassport" class="form-text"> Мы никому не сообщим ваши паспортные данные.</div>
    </div>
    <div class="mb-3">
        <label for="numberPassport" class="form-label">Номер паспорта:</label>
        <input type="text" name='number_passport' class="form-control" id="numberPassport" placeholder="123456">
        <div id="nameNumberPassport" class="form-text">Мы никому не сообщим ваши паспортные данные.</div>
    </div>
    <div class="mb-3">
        <label for="dateOfIssue" class="form-label">Дата выдачи:</label>
        <input type="date" name='date_of_issue' class="form-control" id="dateOfIssue" >
    </div>
    <div class="mb-3">
        <label for="expirationDate" class="form-label">Срок окончания действия:</label>
        <input type="date" name='expiration_date' class="form-control" id="expirationDate">
    </div>
    <div class="mb-3">
        <label for="governmentAgency" class="form-label">Орган выдавший документ:</label>
        <input type="text" name='government_agency' class="form-control" id="governmentAgency" placeholder="МВД России по г Москва">
    </div>
    <div class="mb-3">
        <label for="placeOfBirth" class="form-label">Место рождения:</label>
        <input type="text" name='place_of_birth' class="form-control" id="placeOfBirth" placeholder="Денискино">
    </div>
    <div class="mb-3">
        <label for="sex" class="form-label">Пол:</label>
        <select id="sex" name='type_sex' class="form-select" aria-label="Default select example" required >
            <option disabled>-- Выберите пол клиента --</option>
            <option value="1">Женский</option>
            <option value="2">Мужской</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="typeClient" class="form-label">Статус:</label>
        <select id="typeClient" name='type_client' class="form-select" aria-label="Default select example" required >
            <option disabled>-- Выберите статус клиента --</option>
            <option value="1">Привилегированный</option>
            <option value="2">VIP</option>
            <option value="3">Обычный</option>
        </select>
    </div>
    <div class="md-3">
        <button type="submit" class="btn btn-primary">Добавить</button>
        <a href="/clients" class="btn btn-secondary">Отменить</a>
    </div>
    
</form>
</div>

</body>
</html>


