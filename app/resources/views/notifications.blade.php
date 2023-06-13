@extends('layout.layout')
@section('title','News')
@section('content')
<div class="d-none" id="id"><?php echo $me ?></div>

<div class="notifications-screen container">
    <div class="row no-notifications align-items-center mt-5 mb-5">
        <div class="col-12 col-lg-8 text-center mt-3 mb-3">
            <h2>You don´t have news</h2>
            <h3>Let´s Chill!!</h3>
        </div>
        <img src="./img/no-notifications.png" class="img-fluid offset-2 col-8 offset-lg-0 col-lg-3" />
    </div>

    <div class="row notifications align-items-center mt-5 mb-5">
        <div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-10 offset-1">

        </div>
    </div>
</div>

<script src="./js/notifications.js"></script>

@endsection