@extends('layout.layout')
@section('title', 'Home')
@section('content')



<div class="home-screen mt-4">
    @if ($id)
    <div class="id d-none">{{$id}}</div>
    @endif
    <div class="home-screen-yourMates container">
        <hr>
        <h2>Your mates</h2>
        <hr>
    </div>
    <div class="home-screen-matescontent container">
        <div class="row g-3">

        </div>
        <div class="btn-vermas">
            <a href="{{route('explore')}}">Ver Mas</a>
        </div>
    </div>
    <div class="home-screen-othersForYou container">
        <hr>
        <h2>Others For You</h2>
        <hr>
    </div>
    <div class="home-screen-otherscontent container">
        <div class="row g-3">

        </div>
        <div class="btn-vermas">
            <a href="{{route('explore')}}">Ver Mas</a>
        </div>
    </div>
</div>

<script defer src="js/home.js"></script>
@endsection