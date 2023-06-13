@extends('layout.layout')

@section('title','Uips')

@section('content')
<?php $url = $_SERVER['REQUEST_URI']; ?>

<div class="container error-screen mb-5">
    <img src="<?php if (strpos($url, 'user') || strpos($url, 'explore') || strpos($url, 'post')) {
                    echo '../img/400.png';
                } else {
                    echo 'img/400.png';
                } ?>" class="img-fluid" alt="error404">
    <h2>What are those paramethers <i class="fa-solid fa-cubes"></i> ?? </h2>
    <h3>let me help you <i class="fa-solid fa-handshake-angle"></i></h3>
    <div class="d-flex mt-4 row">
        <a href="{{route('home')}}" class="col-6 col-md-3 mb-3">
            <button class="btn">Home</button>
        </a>
        <a href="{{route('explore')}}" class="col-6 col-md-3 mb-3">
            <button class="btn">Explore</button>
        </a>
        <a href="{{route('account')}}" class="col-6 col-md-3 mb-3">
            <button class="btn">Account</button>
        </a>
        <a href="http://api.talkandeat.es/" class="col-6 col-md-3 mb-3">
            <button class="btn">API</button>
        </a>
    </div>
</div>

@endsection