@extends ('layout')
@section ('content')

<div class="d-flex flex-row justify-content-between">
    <div>
        <h2>Ваучеры готовые на выдачу</h2>
    </div>
</div>

    <div class='card' style='
        width: 50%;
        margin-left: auto;
        margin-right: auto;
        margin-top: 30px;'
    >
    <form action="{{ route('voucher.getData') }}" method="get">
        <div class="card-body">
            <div class="mb-3">
                <label for="organization" class="form-label">Организация</label>
                <select onchange="getOrganization(this.value)" name="organization" id="organization" class="form-select" aria-label="Default select example" required>
                    <option disabled>-- Выберите организацию --</option>
                    @foreach ($vouchers as $voucher)
                        <option value="{{ $voucher->org_id }}">{{ $voucher->organization_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="contract" class="form-label">Номер договора</label>
                <select name="contract" id="contract" class="form-select">
                    <option disabled>-- Выберите договор --</option>
                </select>
            </div>
            <div class="p-2 bd-highlight d-flex  align-items-end">
                <div>
                    <!-- href="javascript:window.print()"  " -->
                        <button type="submit" class="btn btn-warning" >Предварительный просмотр данных</button>
                </div>
            </div>
        </div>
    </form>
    </div>
      



@endsection

@section ('title')
<title>Ваучеры</title>
@endsection
<script>
    let vouchers = <?php echo json_encode($vouchers); ?>;
    console.log(vouchers);
    function getOrganization(idOrganization){
        removeOption('contract');
        console.log(idOrganization);
        vouchers.map(function(element){
            if(element.org_id == idOrganization){
                let el = element.id_contract.split(',');
                console.log(el)
                el.map(function(innerElement){
                    console.log(innerElement)
                    let newOption = new Option(innerElement, innerElement);
                    contract.append(newOption);
                    newOption.selected = true;
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
</script>