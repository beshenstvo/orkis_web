<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.9.1/jquery.tablesorter.min.js" integrity="sha512-mWSVYmb/NacNAK7kGkdlVNE4OZbJsSUw8LiJSgGOxkb4chglRnVfqrukfVd9Q2EOWxFp4NfbqE3nDQMxszCCvw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>

<div class="container p-5" style="margin-bottom: 100px;">
<h1>Создание нового договора</h1>
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
<form method="post" action="/contract" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="mb-3">
        <label for="date" class="form-label">Дата создания договора:</label>
        <input type="date" name='date' class="form-control" id="date" value="<?php echo date("Y-m-d");?>">
    </div>
    <div class="mb-3">
        <label for="id_agreement" class="form-label">Номер соглашения:</label>
        <select onchange="getAgreementId(this.value)" id="id_agreement" name='id_agreement' class="form-select" aria-label="Default select example" required id='id_agreement'>
            <option disabled>-- Выберите соглашение --</option>
            @foreach($listContract as $agreement)
            <option value="{{ $agreement->id_agreement_hasnt_contract }}">{{ $agreement->id_agreement_hasnt_contract }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="organization" class="form-label">Организация:</label>
        <select id="organization" name='organization' class="form-select" aria-label="Default select example" required id='organization'>
        </select>
    </div>
    <div class="mb-3">
        <label for="agent" class="form-label">Агент:</label>
        <select id="agent" name='agent' class="form-select" aria-label="Default select example" required >
        </select>
    </div>
    <div class="mb-3">
        <label for="client" class="form-label">Клиент:</label>
        <select id="client" name='client' class="form-select" aria-label="Default select example" required >
        </select>
    </div>
    <div class="mb-3">
        <label for="country" class="form-label">Страна:</label>
        <select id="country" name='country' class="form-select" aria-label="Default select example" required >
        </select>
    </div>
    <div class="mb-3">
        <label for="city" class="form-label">Город(а):</label>
        <select id="city" name='city' class="form-select" aria-label="Default select example" required >
        </select>
    </div>
     <div class="mb-3 ">
    <label class="form-label">Гостиниц(а/ы):</label>
            <div class="d-flex flex-row justify-content-between bd-highlight mb-3">
                <div class='flex-fill'>
                    <select id="hotel" name='hotel' class="form-select" style='background-color: rgb(234, 237, 240);' aria-label="Default select example"  >
                        <option disabled value="-1">-- Выберите гостиницу --</option>
                    </select>
                </div>
                <div style="margin-right: 10px;">
                    <button type="button" class="btn btn-outline-primary" onclick="getNewHotel()">+</button>
                </div>
                <div>
                    <button type="button" class="btn btn-outline-success" onclick="SortStraight()">По алфавиту</button>
                </div>
            </div>    
            <div class='card' style='background-color: rgb(234, 237, 240);'>       
            <table class="table table-striped" id="mytable" style="margin-bottom: 0;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Гостиница</th>
                    </tr>
                </thead>
                <tbody id='tablehotel' style="margin-bottom: 0;">
                    <input type="hidden" id="hotels" name="hotels" value="">
                </tbody>
            </table>
            <input type="hidden" id="name_order" value="asc">
        </div>
    </div>
    <div class="mb-3">
        <label for="type_room" class="form-label">Вид номера:</label>
        <select id="type_room" name='type_room' class="form-select" aria-label="Default select example" required >
            <option disabled>-- Выберите вид номера --</option>
            <option value="1">Стандарт одноместный</option>
            <option value="2">Стандарт двухместный</option>
            <option value="3">Делюкс</option>
            <option value="4">Люкс</option>
            <option value="5">Президентский</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="type_food" class="form-label">Вид питания:</label>
        <select id="type_food" name='type_food' class="form-select" aria-label="Default select example" required >
            <option disabled>-- Выберите вид питания --</option>
            <option value="1">RO</option>
            <option value="2">EP</option>
            <option value="3">BB</option>
            <option value="4">HB</option>
            <option value="5">FB</option>
            <option value="6">AL</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="type_transport" class="form-label">Вид транспорта:</label>
        <input type="text" value="" name="type_transport" id="type_transport" class="form-control" placeholder="Самолет/Поезд/Карета">
    </div>
    <div class="mb-3">
        <label for="transfer" class="form-label">Трансфер:</label>
        <select id="transfer" name='transfer' class="form-select" aria-label="Default select example" required>
            <option disabled>-- Выберите трансфер --</option>
            <option value="1">Включен</option>
            <option value="2">Не включен</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="start_trip" class="form-label">Начало поездки:</label>
        <input type="date" value="" name="start_trip" id="start_trip" class="form-control">
    </div>
    <div class="mb-3">
        <label for="end_trip" class="form-label">Конец поездки:</label>
        <input type="date" value="" name="end_trip" id="end_trip" class="form-control">
    </div>
    <div class="mb-3">
        <label for="number_of_participants" class="form-label">Участник(и):</label></br>
        <div class="d-flex flex-row justify-content-between bd-highlight mb-3">
            <input style="margin-right:15px; background-color: rgb(234, 237, 240);" type="text" name='name_participant' class="form-control" id="name_participant" placeholder='Имя' >
            <input style="margin-right:15px; background-color: rgb(234, 237, 240);" type="text" name='surname_participant' class="form-control" id="surname_participant" placeholder='Фамилия' >
            <input style="margin-right:15px; background-color: rgb(234, 237, 240);" type="text" name='patronymic_participant' class="form-control" id="patronymic_participant" placeholder='Отчество' >
            <button type="button" class="btn btn-outline-primary" onclick="getNewParticipants()">+</button>
        </div>
        <div class="mb-3 card" style='background-color: rgb(234, 237, 240);'>
            <table class="table" style="margin-bottom: 0;" >
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Фамилия</th>
                <th scope="col">Отчество</th>
                </tr>
            </thead>
            <tbody id='table'>
                <input type="hidden" name="participants" id='participants'>
            </tbody>
            </table>
        </div>
    </div>
    <div class="mb-3">
        <label for="amount_in_currency" class="form-label">Стоимость в валюте:</label>
        <input type="text" name='amount_in_currency' class="form-control" id="amount_in_currency" placeholder="000000.00">
    </div>
    
    <div class="md-3">
        <button type="submit" class="btn btn-primary">Добавить</button>
        <a href="/contract" class="btn btn-secondary">Отменить</a>
    </div>
</form>

</div>

</body>
</html>
<script>
    var counter = 1;
    var array_hotels = [];
     function getNewHotel() {
        let i = document.getElementById("hotel").options.selectedIndex;
        var val = document.getElementById("hotel").options[i].value;
        console.log(val);
        array_hotels.push(val);
        if(val != -1){
            document.getElementById('hotels').value = array_hotels;
            console.log(array_hotels);

            let n = document.getElementById("hotel").options.selectedIndex;
            var txt = document.getElementById("hotel").options[n].text;
            let tr = document.createElement('tr');
            tr.innerHTML = "<th scope='row'>"+counter+"</th><td>"+txt+"</td>";
            tablehotel.append(tr); 
            counter++;
            document.getElementById("hotel").value = '';
            listHotel(val);
        }
    }

    function SortStraight(){
        var table=$('#mytable');
        var tbody =$('#tablehotel');

        tbody.find('tr').sort(function(a, b) {
            if($('#name_order').val()=='asc') {
                return $('td:first', a).text().localeCompare($('td:first', b).text());
            } else {
                return $('td:first', b).text().localeCompare($('td:first', a).text());
            }
        }).appendTo(tbody);
            
        var sort_order=$('#name_order').val();
        if(sort_order=="asc") {
            document.getElementById("name_order").value="desc";
        }
        if(sort_order=="desc") {
            document.getElementById("name_order").value="asc";
        }
    }
    function listHotel(hotelId) {
        var i, L = document.getElementById('hotel').options.length - 1;
        for(i = L; i >= 0; i--) {
            console.log('Город из списка: '+document.getElementById('hotel').options[i].value);
            console.log('Выбранный город: '+hotelId);
            if(document.getElementById('hotel').options[i].value == hotelId) {
                console.log('совпадение города из списка: '+document.getElementById('hotel').options[i].value);
                console.log('Выбранный город: '+hotelId);
                document.getElementById('hotel').remove(i);
            }
            if(document.getElementById("hotel").length > 0){
                document.getElementById('hotel').options[0].selected = true;
            }else{
                console.log('нет отелей')
                let op = new Option('--- Нет отелей ---', -1);
                hotel.append(op);
                op.disabled = true;
            }
               
        }
    }

    let list = <?php echo json_encode($listContract);?>;
    let listHotels = <?php echo json_encode($listHotels);?>;
    let listAgents = <?php echo json_encode($listAgents);?>;
    console.log(list);
    console.log(listHotels);
    function getAgreementId(idAgreement) {
        //очищать списки отелей и вообще всех 
        removeOption('organization');
        removeOption('client');
        removeOption('city');
        removeOption('country');
        removeOption('hotel');
        removeOption('agent');
        list.map(function(element) {
            if(element.id_agreement_hasnt_contract == idAgreement){
                document.getElementById('start_trip').value = element.start_of_trip;
                document.getElementById('start_trip').setAttribute('min', element.start_of_trip);
                document.getElementById('start_trip').setAttribute('max', element.start_of_trip);
                document.getElementById('end_trip').value = element.end_of_trip;
                document.getElementById('end_trip').setAttribute('min', element.end_of_trip); 
                document.getElementById('end_trip').setAttribute('max', element.end_of_trip); 
                let optionOrganization = new Option(element.organization_name, element.organization_id);
                organization.append(optionOrganization);
                optionOrganization.selected = true;
                let optionClient = new Option(element.client_surname +' '+ element.client_name +' '+ element.client_patronymic, element.client_id);
                client.append(optionClient);
                optionClient.selected = true;
                let cityName = element.name_city.split(',');
                let id_city = element.city_id.split(',');
                let w = 0;
                cityName.map(function(e){
                    let optionCity = new Option(e, id_city[w]);
                    city.append(optionCity);
                    optionCity.selected = true;
                    w++;
                })
                let optionCountry = new Option(element.name_country, element.country_id);
                country.append(optionCountry);
                optionCountry.selected = true;
                listAgents.map(function(innerElement){
                    console.log(innerElement);
                    if(element.organization_id == innerElement.Id_organization){
                        let optionAgent = new Option(innerElement.surname +' '+ innerElement.name +' '+ innerElement.patronymic , innerElement.id);
                        agent.append(optionAgent);
                        optionAgent.selected = true;
                    }
                })
                id_city = element.city_id.split(',');
                console.log(id_city);
                id_city.map(function(id_city_inner){
                    listHotels.map(function(innerElement){
                        console.log(id_city_inner+'  '+innerElement.id_city_hotel);
                        
                        if(id_city_inner == innerElement.id_city_hotel){
                            console.log('Добавление отеля')
                            console.log(id_city_inner)
                            let optionHotel = new Option(innerElement.hotel_name+' '+innerElement.hotel_address, innerElement.hotel_id);
                            hotel.append(optionHotel);
                            optionHotel.selected = true;
                        }
                    })
                })
            }
        })
    }
    function removeOption(idElement){
        var i, L = document.getElementById(idElement).options.length - 1;
            for(i = L; i >= 0; i--) {
                document.getElementById(idElement).remove(i);
            } 
    }
    var count = 1;
    var array_participants = [];
    function getNewParticipants() {
        if( (document.getElementById('name_participant').value != '')&&(document.getElementById('surname_participant').value != '')&&(document.getElementById('patronymic_participant').value != '') ) {
            let name = document.getElementById('name_participant').value
            let surname = document.getElementById('surname_participant').value
            let patronymic = document.getElementById('patronymic_participant').value
            let tr = document.createElement('tr');
            tr.innerHTML = '<tr><th scope="row">'+count+'</th><td>'+name+'</td><td>'+surname+'</td><td>'+patronymic+'</td></tr>';
            table.append(tr);
            count++;
            document.getElementById('name_participant').value = '';
            document.getElementById('surname_participant').value = '';
            document.getElementById('patronymic_participant').value = '';
            array_participants.push({name: name, surname: surname, patronymic: patronymic});
            document.getElementById('participants').value =  JSON.stringify(array_participants);
            console.log(array_participants);
        }else{
            console.log(alert('Заполните полностью ФИО участника'));
        }
        
    }
</script>


