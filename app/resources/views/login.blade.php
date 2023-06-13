@extends('layout.layout')
@section('title','Login')
@section('content')

@if (isset($a))
<div>{{ $a['passwd']}}</div>
@endif
<div class="container login-screen">
    <div class="row align-items-center">
        <form class="col-12 col-md-4 offset-lg-1 col-lg-3 order-2 order-md-1" action="{{route('home')}}" method="post">
            @csrf
            <h2>Login</h2>
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" placeholder="Ex: jaimecabaleiro_" class="form-control mb-3" required>
            <p class="error username">* Username required*</p>

            <label for="passwd" class="form-label">Password</label>
            <div class="password">
                <input type="password" name="passwd" id="passwd" placeholder="*******" class="form-control mb-3" required>
                <p class="error passwd">* Password required*</p>

                <a href="#" class="remember-password">?</a>
            </div>
            <div class="login-screen-separator">
                <hr>
                <p>O</p>
                <hr>
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{route('register')}}">Register</a>
            </div>
            <input type="submit" class="form-control btn-login" value="Log In">

        </form>

        <div class="offset-0 col-12 offset-md-1 col-md-6 offset-lg-1 col-lg-5 order-1 order-md-2">
            <img src="./img/TalkAndEat.png" class="img-fluid" height="100%" width="auto" alt="TalkAndEat">
        </div>

    </div>

</div>

<script src="js/loginVal.js"></script>

@endsection