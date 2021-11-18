<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.9.1/jquery.tablesorter.min.js" integrity="sha512-mWSVYmb/NacNAK7kGkdlVNE4OZbJsSUw8LiJSgGOxkb4chglRnVfqrukfVd9Q2EOWxFp4NfbqE3nDQMxszCCvw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Города</title>
</head>
<body>
<div class="container p-5">
<h1>Добавьте города посещения</h1>
<form method="post" action="/agreement/addedcity" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class='card' style='margin-top: 20px; margin-bottom: 20px;'>
    <div class="card-header">Города посещения для соглашения: {{ $idAgreement }}</div>
    <div class="card-body">
        <div class="d-flex flex-row justify-content-between bd-highlight mb-3">
            <!-- <div class='flex-fill'>
                <input id='city' type="text" name='city' class="form-control" placeholder='Название города'>
            </div> -->
            <input type="hidden" value="{{ $idAgreement }}" name="idAgreement">
            <div class='flex-fill'>
                <select id="city" name='city' class="form-select" aria-label="Default select example" required >
                    <option disabled>-- Выберите город посещения --</option>
                    @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name_city }}</option>
                    @endforeach
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
            <tbody id='table'>
                
            </tbody>
        </table>
        <input type="hidden" id="name_order" value="asc">

    </div>
    </div>
    <div class="md-3">
        <button type="submit" class="btn btn-primary">Добавить</button>
        <a href="/agreement/create" class="btn btn-secondary">Отменить</a>
    </div>
</div>
</form>
    <script>
    var count = 1;
    function getNewCity() {
        let n = document.getElementById("city").options.selectedIndex;
        var txt = document.getElementById("SelectMyLove").options[n].text;
        let tr = document.createElement('tr');
        tr.innerHTML = "<th scope='row'>"+count+"</th><td>"+txt+"</td>";
        table.append(tr); 
        count++;
        document.getElementById("city").value = '';
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
</script>
</body>
</html>