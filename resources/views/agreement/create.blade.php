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
<h1>Создание нового соглашения</h1>
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
<form method="post" action="/agreement" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="mb-3">
        <label for="date" class="form-label">Дата создания соглашения:</label>
        <input type="date" name='date' class="form-control" id="date" value="<?php echo date("Y-m-d");?>">
    </div>
    <div class="mb-3">
        <label for="org" class="form-label">Организация:</label>
        <select onchange="getOrganization(this.value)" id="org" name='organization_name' class="form-select" aria-label="Default select example" required >
            <option disabled>-- Выберите организацию --</option>
            @foreach($listOrganizations as $organization)
            <option value="{{ $organization->id }}">{{ $organization->organization_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="country" class="form-label">Страна посещения:</label>
        <select onchange="getCountry(this.value)" id="country" name='country' class="form-select" aria-label="Default select example" required >
            <option disabled>-- Выберите страну посещения --</option>
            @foreach($listCountry as $country)
                <option value="{{ $country->id }}">{{ $country->name_country }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
    <label for="client" class="form-label">Клиент:</label>
        <select id="client" name='client' class="form-select" aria-label="Default select example" required >
            <option disabled>-- Выберите клиента --</option>
            @foreach($listClient as $client)
                <option value="{{ $client->id }}">{{ $client->surname }} {{ $client->name }}  {{ $client->patronymic }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
    <label for="agent" class="form-label">Агент:</label>
        <select id="agent" name='agent' class="form-select" aria-label="Default select example" required >
            <option disabled>-- Выберите агента --</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="count" class="form-label">Количество участников поездки:</label>
        <input id='count' type="text" name='count' class="form-control"  placeholder='x'>
    </div>
    <div class="mb-3">
        <label for="date_start" class="form-label">Дата начала поездки:</label>
        <input id='date_start' type="date" name='date_start' class="form-control"  >
    </div>
    <div class="mb-3">
        <label for="date_end" class="form-label">Дата окончания поездки:</label>
        <input id='date_end' type="date" name='date_end' class="form-control"  >
    </div>
    <div class='card' style='margin-top: 20px; margin-bottom: 20px;'>
    <div class="card-header">Города посещения:</div>
    <div class="card-body">
        <div class="d-flex flex-row justify-content-between bd-highlight mb-3">
            <div class='flex-fill'>
                <select id="Id_city" name='Id_city' class="form-select" aria-label="Default select example" required >
                    <option disabled value="-1">-- Выберите город посещения --</option>
                </select>
            </div>
            <div style="margin-right: 10px;">
                <button type="button" class="btn btn-outline-primary" onclick="getNewCity()">+</button>
            </div>
            <div>
                <button type="button" class="btn btn-outline-success" onclick="SortStraight()">По алфавиту</button>
            </div>
        </div>           
        <table class="table table-striped" id="mytable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Город</th>
                </tr>
            </thead>
            <tbody id='table' style="margin-bottom: 0;">
                <input type="hidden" id="cities" name="cities" value="">
            </tbody>
        </table>
        <input type="hidden" id="name_order" value="asc">

    </div>
    </div>
    <div class="md-3">
        <button type="submit" class="btn btn-primary">Добавить</button>
        <a href="/agreement" class="btn btn-secondary">Отменить</a>
    </div>
</form>

</div>

</body>
</html>
<script>
    var count = 1;
    var array_cities = [];
    let listAgent = <?php echo json_encode($listAgent); ?>;
    function getOrganization(organization){
        var i, L = document.getElementById('agent').options.length - 1;
        for(i = L; i >= 0; i--) {
            document.getElementById('agent').remove(i);
        } 
        console.log(organization);
        listAgent.map(function(element){
            if (element.Id_organization == organization){
                var newOptionAgent = new Option(element.name+' '+element.surname+' '+element.patronymic, element.id);
                agent.append(newOptionAgent);
                newOptionAgent.selected = true;
            }
        })
    };
    function getNewCity() {
        let i = document.getElementById("Id_city").options.selectedIndex;
        var val = document.getElementById("Id_city").options[i].value;
        console.log(val);
        array_cities.push(val);
        if(val != -1) {
            document.getElementById('cities').value = array_cities;
            console.log(array_cities);

            let n = document.getElementById("Id_city").options.selectedIndex;
            var txt = document.getElementById("Id_city").options[n].text;
            let tr = document.createElement('tr');
            tr.innerHTML = "<th scope='row'>"+count+"</th><td>"+txt+"</td>";
            table.append(tr); 
            count++;
            document.getElementById("Id_city").value = '';
            listCity(val);
        }
    }

    function SortStraight(){
        var table=$('#mytable');
        var tbody =$('#table');

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
    let cities = <?php echo json_encode($listCity);?>;
    function getCountry(country) {
        count = 1;
        //обнулить hidden
        array_cities = [];
        document.getElementById('cities').value = array_cities;
        var e = document.getElementById('table');
        while ( e.rows[0] ) {
            e.deleteRow(0);
        }

        var i, L = document.getElementById('country').options.length - 1;
        for(i = L; i >= 0; i--) {
            document.getElementById('Id_city').remove(i);
        } 
        let defaultOption = new Option('-- Выберите город посещения --', -1)
        Id_city.append(defaultOption);
        defaultOption.disabled = true;
        defaultOption.selected = true;
        cities.map(function(element){
        if(element.Id_country == country){
            let newOption = new Option(element.name_city, element.id);
            Id_city.append(newOption);
            //наращивать hidden
        }
    });
    };
    function listCity(cityId) {
        var i, L = document.getElementById('Id_city').options.length - 1;
        for(i = L; i >= 0; i--) {
            console.log('Город из списка: '+document.getElementById('Id_city').options[i].value);
            console.log('Выбранный город: '+cityId);
            if(document.getElementById('Id_city').options[i].value == cityId) {
                console.log('совпадение города из списка: '+document.getElementById('Id_city').options[i].value);
                console.log('Выбранный город: '+cityId);
                document.getElementById('Id_city').remove(i);
            }
               // document.getElementById('Id_city').options[0].selected = true;
            if(document.getElementById("Id_city").length > 0){
                document.getElementById('Id_city').options[0].selected = true;
            }else{
                console.log('нет отелей')
                let op = new Option('--- Нет городов ---', -1);
                Id_city.append(op);
                op.disabled = true;
            }
        }
    }

</script>


