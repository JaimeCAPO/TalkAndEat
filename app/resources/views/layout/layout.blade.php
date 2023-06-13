<!DOCTYPE html>
<html lang="en">
<?php $url =$_SERVER["REQUEST_URI"];?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> TalkAndEat - @yield('title') </title>
    <link rel="stylesheet" href=" <?php if($url=="/") echo 'css/style.css'; else echo '../css/style.css';?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">


</head>

<body>
    @if (Auth::check())
    <!--CONTENIDO NAVBAR (log)-->
    <nav class="talkAndEat-menu container">
        <a href="{{route('home')}}">
            <img src="<?php if($url=="/") echo 'img/logo.png'; else echo '../img/logo.png';?>" class="img-fluid" alt="appLogo">
        </a>

        <div class="talkAndEat-menu-pages big d-none d-lg-flex">
            <div>
                <a href="{{route('home')}}">
                    <h3 <?php if($url=="/" || $url=='/home') echo 'class="active"';?>>Home</h3>
                </a>
            </div>
            <div>
                <a href="{{route('explore')}}">
                    <h3 <?php if(strpos($url, 'explore') || strpos($url, 'post')) echo 'class="active"';?>>Explore</h3>
                </a>
            </div>
            <div>
                <a href="{{route('notifications')}}">
                    <h3 <?php if($url=="/notifications") echo 'class="active"';?>>News</h3>
                </a>
            </div>
        </div>

        <div class="talkAndEat-menu-pages litle d-md-flex d-lg-none ">
            <a href="{{route('home')}}"><i class="fa-solid fa-tower-observation <?php if($url=="/"||$url=='/home') echo 'active';?>"></i></a>
            <a href="{{route('explore')}}"><i class="fa-solid fa-eye <?php if(strpos($url, 'explore') || strpos($url, 'post')) echo 'active';?>"></i></a>
            <a href="{{route('notifications')}}"><i class="fa-solid fa-bell <?php if($url=="/notifications") echo 'active';?>"></i></a>
        </div>

        <div class="talkAndEat-menu-profile mt-2">
            <a href="{{route('newpost')}}" class="me-2"><i class="fa-solid fa-square-plus"></i></a>
            <a href="{{route('account')}}" class="me-2"><i class="fa-solid fa-user"></i></a>
            <a href="{{route('settings')}}" class="me-2"><i class="fa-solid fa-sliders fa-rotate-270"></i></a>
        </div>
    </nav>

    <header class="talkAndEat-header d-flex  align-items-center gap-3 container">
        <h1>@yield('title')</h1>
        <?php if(strpos($url, 'account')) { ?>
        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="btn btn-unlog"><i class="fa-solid fa-right-from-bracket"></i></button>
        </form>
        <?php } ?>
    </header>
    @else
    <!--CONTENIDO NAVBAR (no log)-->
    <nav class="talkAndEat-empty-menu container">
        <img src="<?php if($url=="/") echo 'img/logo.png'; else echo '../img/logo.png';?>" class="img-fluid" alt="appLogo">

        <div class="talkAndEat-empty-menu-actions">
            <a href="{{route('login')}}" class="<?php if($url=="/login") echo 'active';?>">Login</a>
            <a href="{{route('register')}}" class="<?php if($url=="/register") echo 'active';?>">Register</a>
        </div>
    </nav>
    @endif

    @yield('content')

    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <hr class="col-12">
                <div class="about col-12 col-lg-5">
                    <h3>About</h3>
                    <p>¡Bienvenidos a TalkAndEat, la red social gastronómica donde, ya sea que seas un chef experimentado o un novato en la cocina, te deleitarás con las mejores recetas del mundo! Nuestra plataforma te invita a sumergirte en un universo culinario donde los usuarios comparten sus creaciones más deliciosas. Desde platos exquisitos y postres tentadores hasta recetas saludables y opciones para dietas especiales, aquí encontrarás una fuente inagotable de inspiración.</p>
                </div>
    
                <div class="links col-6 d-flex flex-column gap-2 col-lg-3 offset-0 offset-lg-1 ">
                    <h3>Quick Links</h3>
                    <a href="http://api.talkandeat.es/">Web Service</a>
                    <a href="http://talkandeat.es/admin">Administrator</a>
                    <a href="http://talkandeat.es/">Accesibility</a>
                    <a href="https://mestre.iessanclemente.net/user/profile.php?id=235">Mestre Jaime</a>
                </div>

                <div class="me col-6 col-lg-2">
                    <h3>Me</h3>
                    <p><b>Who am I?</b> Jaime Cabaleiro Poceiro</p>
                    <p><b>From:</b> C. Sineiro, O Grove, Pontevedra, Galicia</p>
                    <p><b>Ocupation:</b> Im a web developer student from IES San Clemente, Santiago</p>
                    <p><b>Contact:</b> +34 645 97 54 93</p>
                </div>

                <hr class="col-12 mt-3">
                <p class="col-6 ">Copyright © 2023 All Rights Reserved by <a href="http://talkandeat.es">TalkAndEat</a></p>
                <div class="col-4 col-mg-3 col-lg-2 offset-1 offset-md-2 offset-lg-3 justify-content-end mb-3">
                    <div class="row">
                    <img  class="img-fluid col-6 col-md-3 mt-2" src="<?php if(strpos($url, 'post')|| strpos($url, 'user') || strpos($url, 'explore')) echo "../img/facebook.png"; else echo "./img/facebook.png";?>" width="40" height="40" alt="facebook account">
                    <a class="col-6 col-md-3 mt-2" href="https://www.instagram.com/jaimecabaleiro_/"><img class="img-fluid " src=" <?php if(strpos($url, 'post')|| strpos($url, 'user') || strpos($url, 'explore')) echo "../img/instagram.png"; else echo "./img/instagram.png";?> " width="40" height="40" alt="instagram account"></a>
                    <a class="col-6 col-md-3 mt-2" href="https://twitter.com/JaimeP90527"><img class="img-fluid " src=" <?php if(strpos($url, 'post')|| strpos($url, 'user') || strpos($url, 'explore')) echo "../img/gorjeo.png"; else echo "./img/gorjeo.png";?> " width="40" height="40" alt="twitter account"></a>
                    <a class="col-6 col-md-3 mt-2" href="mailto:a20jaimecp@iessanclemente.net"><img class="img-fluid " src=" <?php if(strpos($url, 'post')|| strpos($url, 'user') || strpos($url, 'explore')) echo "../img/gmail.png"; else echo "./img/gmail.png";?> " width="40" height="40" alt="gmail contact"></a>
                    </div>
                    
                </div>
            </div>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/d3a8692d96.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>


</body>

</html>