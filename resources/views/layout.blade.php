<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
   @yield('title')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: rgb(205, 247, 220) !important;">
        <div class="container-fluid">
            <!-- <a class="navbar-brand" href="#">Тур агенство</a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if(Auth::user()->name == "Manager" || Auth::user()->name == "Agent" || Auth::user()->name == "Accountant" || Auth::user()->name == "Admin")
                    <li class="nav-item">
                        <a class="nav-link" href="/">Главная</a>
                    </li>
                @endif
                @if(Auth::user()->name == "Manager" || Auth::user()->name == "Agent" || Auth::user()->name == "Admin")
                    <li class="nav-item">
                        <a class="nav-link" href="/clients">Клиенты</a>
                    </li>
                @endif
                @if(Auth::user()->name == "Manager" || Auth::user()->name == "Admin")
                    <li class="nav-item">
                        <a class="nav-link" href="/employees">Сотрудники</a>
                    </li>
                @endif
                @if(Auth::user()->name == "Manager" || Auth::user()->name == "Agent" || Auth::user()->name == "Admin")
                    <li class="nav-item">
                        <a class="nav-link" href="/agreement">Соглашения</a>
                    </li>
                @endif
                @if(Auth::user()->name == "Manager" || Auth::user()->name == "Agent" || Auth::user()->name == "Admin")
                    <li class="nav-item">
                        <a class="nav-link" href="/contract">Договоры</a>
                    </li>
                @endif
                @if(Auth::user()->name == "Accountant"|| Auth::user()->name == "Admin" )
                    <li class="nav-item">
                        <a class="nav-link" href="/payment">Платежи</a>
                    </li>
                @endif
                @if(Auth::user()->name == "Manager"|| Auth::user()->name == "Admin")
                    <li class="nav-item">
                        <a class="nav-link" href="/voucher">Ваучеры</a>
                    </li>
                @endif
                @if(Auth::user()->name == "Accountant"|| Auth::user()->name == "Admin")
                    <li class="nav-item">
                        <a class="nav-link" href="/currency">Валюты</a>
                    </li>
                @endif
                @guest
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Войти</a>
                    </li>
                    @else 
                    <li>
                        <a href="{{ route('logout') }}" class="nav-link"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Выйти
                        </a>
                        <form action="{{ route('logout') }}" method="post" id='logout-form' style="display:none" role="form">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
            @yield('form')
            </div>
        </div>
    </nav>
    <div class="container" style="margin-top: 10px;">
@yield('content')  
    </div>

</body>
</html>