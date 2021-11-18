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
                    <h2>Изменить соглашение №: {{ $agreements[0]->id }}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-warning" href="{{ route('agreement.index') }}">Вернуться назад</a>
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
        <form method="post" action="{{ route('agreement.update',$agreements[0]->id)  }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <input type="hidden" value="{{ $agreements[0]->id }}" name="IdAgreement">
            <div class="mb-3">
                <label for="date" class="form-label">Дата создания соглашения:</label>
                <input type="date" name='date' class="form-control" id="date" value="{{ $agreements[0]->date }}">
            </div>
            <div class="mb-3">
                <label for="org" class="form-label">Организация:</label>
                <select id="org" name='Id_organization' class="form-select" aria-label="Default select example" required >
                    @foreach($listOrganizations as $organization)
                    <option value="{{ $organization->id }}" @if ( $agreements[0]->organization_id == $organization->id) { selected } @endif>{{ $organization->organization_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Страна посещения:</label>
                <select onchange="getCountry(this.value)" id="country"  class="form-select" aria-label="Default select example" required >
                    <option disabled>-- Выберите страну посещения --</option>
                    @foreach($listCountry as $country)
                        <option value="{{ $country->id }}" @if ( $agreements[0]->country_id == $country->id) { selected } @endif >{{ $country->name_country }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="Id_city" class="form-label">Город посещения:</label>
                <select  id="Id_city" name='Id_city' class="form-select" aria-label="Default select example" required >
                    <option disabled>-- Выберите город посещения --</option>
                </select>
            </div>
            <div class="mb-3">
            <label for="client" class="form-label">Клиент:</label>
                <select id="client" name='Id_client' class="form-select" aria-label="Default select example" required >
                    <option disabled>-- Выберите клиента --</option>
                    @foreach($listClient as $client)
                        <option value="{{ $client->id }}" @if ( $agreements[0]->client_id == $client->id) { selected } @endif>{{ $client->surname }} {{ $client->name }}  {{ $client->patronymic }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
            <label for="agent" class="form-label">Агент:</label>
                <select id="agent" name='Id_Agent' class="form-select" aria-label="Default select example" required >
                    <option disabled>-- Выберите агента --</option>
                    @foreach($listAgent as $agent)
                        <option value="{{ $agent->id }}" @if ( $agreements[0]->agent_id == $agent->id) { selected } @endif >{{ $agent->surname }} {{ $agent->name }}  {{ $agent->patronymic }}</option>
                    @endforeach
                </select>
            </div>    
            <div class="mb-3">
                <label for="count" class="form-label">Количество участников поездки:</label>
                <input id='count' type="text" name='number_of_participants' class="form-control"  value="{{ $agreements[0]->number_of_participants }}">
            </div>
            <div class="mb-3">
                <label for="date_start" class="form-label">Дата начала поездки:</label>
                <input id='date_start' type="date" name='start_of_trip' class="form-control" value="{{ $agreements[0]->start_of_trip }}" >
            </div>
            <div class="mb-3">
                <label for="date_end" class="form-label">Дата окончания поездки:</label>
                <input id='date_end' type="date" name='end_of_trip' class="form-control" value="{{ $agreements[0]->end_of_trip }}" >
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </div>
        </form>
    </div>
    <script>
        //$agreements[0]->city_id - это то что выбрано 
        console.log(<?php echo json_encode($agreements[0]->city_id); ?>)
        let cities = <?php echo json_encode($listCity); ?>;
        let countries = <?php echo json_encode($listCountry); ?>;
        function getCountry(country) {
            var i, L = document.getElementById('country').options.length - 1;
            for(i = L; i >= 0; i--) {
                document.getElementById('Id_city').remove(i);
            } 
            let defaultOption = new Option('-- Выберите город посещения --', 0)
            Id_city.append(defaultOption);
            defaultOption.disabled = true;
            console.log(country);
            cities.map(function(element, index){
                if (element.Id_country == country){
                    let newOption = new Option(element.name_city, element.id);
                    Id_city.append(newOption);
                }
                
            })  
        }
        let value = document.getElementById('country').value;
        cities.map(function(element, index){
                if (element.Id_country == value){
                    let newOption = new Option(element.name_city, element.id);
                    Id_city.append(newOption);
                    if(element.id == <?php echo json_encode($agreements[0]->city_id); ?>){
                        console.log('совпало');
                        newOption.selected = true;
                    }
                }
            })  
    </script>
</body>
</html>


