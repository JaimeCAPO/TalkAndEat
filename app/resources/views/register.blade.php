@extends('layout.layout')

@section('title','Register')

@section('content')

<div class="container register-screen">
    <div class="row align-items-center">
        <form class="col-12 col-md-4 offset-lg-1 col-lg-3 order-2 order-md-1" action="{{route('login')}}" method="post">
            @csrf
            <h1>Register</h1>
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" placeholder="Ex: jaimecabaleiro_" class="form-control mb-3">
            <p class="error username">* Username required*</p>
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" placeholder="@gmail.com" class="form-control mb-3">
            <p class="error email">* Email required*</p>

            <label for="passwd" class="form-label">Password</label>
            <input type="password" name="passwd" id="passwd" placeholder="*****" class="form-control mb-3">
            <p class="error passwd">* Password required*</p>

            <label for="passwdagain" class="form-label">Repeat Password</label>
            <input type="password" name="passwdagain" id="passwdagain" placeholder="*****" class="form-control mb-3">
            <p class="error passwdagain">* Invalid Second password*</p>


            <div>
                <a href="/login" class="btn">Back</a>
                <input type="submit" value="Register" class="btn btn-register">
            </div>

        </form>

        <div class="offset-0 col-12 offset-md-1 col-md-6 offset-lg-1 col-lg-5 order-1 order-md-2">
            <img src="./img/TalkAndEat.png" class="img-fluid" height="100%" width="auto" alt="TalkAndEat">
        </div>

    </div>

</div>
<script src="js/registerVal.js"></script>

@endsection