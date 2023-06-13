@extends('layout.layout')
@section('title', 'Account')
@section('content')
<?php $url = $_SERVER['REQUEST_URI']; ?>

<div class="follows-screen modal-mask">
    <div class="modal-container container">
        <button class="btn btn-close"></button>
        <h3 class="text-center m-auto"><b>@</b>{{ $username }}</h3>
        <div class="header-btns mt-4">
            <button class="btn follows">Follows</button>
            <button class="btn followers">Followers</button>
        </div>
        <div class="userslist overflow-scroll mt-3 p-1 row">
        </div>
    </div>
</div>

<div class="container account-screen-profile">
    <div class="row align-items-center mt-4 mb-5">
        <div class="col-6 offset-3 offset-md-2 col-md-3">
            <img src="<?php if (strpos($url, 'account')) {
                            echo 'img/no-profile.png';
                        } else {
                            echo '../img/no-profile.png';
                        } ?>" class="img-fluid" width="80%" height="auto" alt="" />
        </div>
        <div class="col-8 offset-2 offset-md-0 col-md-5 g-1">
            <div class="account-screen-userstats">
                <h2><b>@</b>{{ $username }}</h2>
                <h3 class="d-flex">#<div class="id">{{ $id }}</div>
                </h3>
            </div>
            <div class="account-screen-follows">
                <h3>Follows: 1000</h3>
                <h3>Followers: 1000</h3>
            </div>
            <div class="account-screen-biografy">{{ $descripcion }}</div>
            @if (strpos($url, 'user'))
            @if ($follow)
            <form action="{{ route('deleteFollow') }}" method="post">
                @method('delete')
                @else
                <form action="{{ route('follow') }}" method="post">
                    @endif
                    @csrf
                    <input class="d-none" type="text" name="id" id="id" value="{{ $id }}">
                    @if ($follow)
                    <button class="btn btn-following" type="submit">following</button>
                    @else
                    <button class="btn btn-follow" type="submit">follow</button>
                    @endif
                </form>
                @endif
        </div>
    </div>
</div>

<div class="row account-screen-typeposts">
    <h2 class="col-5 offset-1 text-center active">Own Posts</h2>
    <h2 class="col-5 text-center">Saved Posts</h2>
</div>

<hr class="col-10 offset-1 account-screen-divisor-bar" />
<div class="container">
    <div class="account-screen-postcollection row">
    </div>
</div>

<script defer src="<?php if (strpos($url, 'account')) {
                        echo 'js/account.js';
                    } else {
                        echo '../js/account.js';
                    } ?>"></script>

<script defer src="../js/follow.js"></script>

@endsection