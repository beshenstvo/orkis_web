@extends ('layout')
@section ('content')
<h1>Главная</h1></br></br>
<div class="container">
    <h4>Добро пожаловать, {{ Auth::user()->name }} , на сайт туристического агенства!</h4>
</div>
@endsection