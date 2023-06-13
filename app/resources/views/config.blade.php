@extends('layout.layout')

@section('title','Config')

@section('content')

<div class="id d-none">{{$id}}</div>
<div class="config-screen container mt-3">
    <div class="row">
        <div class="config-screen-categories col-12 col-md-5">
            <div>
                <div class="config-screen-brand d-flex align-items-center">
                    <img src="img/logo.png" alt="logo" width="50px" height="50px">
                    <h2>TalkAndEat</h2>
                </div>
                <p class="config-screen-username"><b>@</b>{{$username}}</p>
                <div class="config-screen-sections">
                    <h3>Settings</h3>
                    <ul class="list-settings">
                        <li class="list-item general active">General</li>
                        <li class="list-item profile ">Profile</li>
                        <li class="list-item help">Help</li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="config-screen-settings col-12 col-md-7">
            <form class="form-update" action="{{route('updateUser')}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-profile me-4 ms-4 mb-4">
                    <h2 class="settings-title col-12 mt-0 mb-2">Profile</h2>
                    <div class="settings-option row align-items-center mt-3">
                        <div class="col-12 col-md-4 ">
                            <label class="form-label" for="username">Username </label>
                        </div>
                        <div class="col-12 col-md-8">
                            @if ($id==10)
                            <input class="form-control" type="text" name="username" id="username" placeholder="{{$username}} " disabled>
                            @else
                            <input class="form-control" type="text" name="username" id="username" placeholder="{{$username}} ">
                            @endif
                        </div>
                    </div>
                    <div class="settings-option row align-items-baseline mt-3">
                        <div class="col-12 col-md-4 ">
                            <label class="form-label" for="bio">Biografy </label>
                        </div>
                        <div class="col-12 col-md-8">
                            <textarea class="form-control" name="bio" id="bio" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="d-none settings-option row align-items-center mt-3">
                        <div class="col-12 col-md-4 ">
                            <label class="form-label" for="img">Profile Image </label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input class="form-control" type="file" name="img" id="img">
                        </div>
                    </div>
                </div>

                <div class="form-general me-4 ms-4 mb-4">
                    <h2 class="settings-title col-12 mt-0 mb-2">General</h2>
                    <div class="settings-option row align-items-center mt-3">
                        <div class="col-8 col-md-4">
                            <label class="form-label" for="dark">Dark mode </label>
                        </div>
                        <div class="col-4 col-md-8">
                            <input type="checkbox" name="dark" id="dark">
                        </div>
                    </div>
                </div>

                <div class="form-help me-4 ms-4 mb-4">
                    <h2 class="settings-title col-12 mt-0 mb-2">Help</h2>
                    <div class="settings-option row align-items-center mt-3">
                        <p>If you have any question about the web page or you need some help, please, contact with the next email direction: <a href="mailto:a20jaimecp@iessanclemente.net">mail</a>. </p>
                    </div>
                </div>



                <div class="btns d-flex justify-content-end">
                    <button type="reset" class="btn btn-reset">Reset</button>
                    <button type="submit" class="btn btn-save">Save</button>

                </div>

            </form>

            <form action="{{route('deleteUser')}}" method="post" class="form-delete me-4 ms-4 mb-4">
                @csrf
                @method('DELETE')
                <h2 class="settings-title col-12 mt-0 mb-2">Delete Account</h2>
                <div class="settings-option mt-3">
                    <button type="submit" class="btn btn-delete-account disabled">Delete</button>
                    @if ($id==10)
                    <div class="gap-2 pt-3 d-flex">
                        <input type="checkbox" name="delete" id="delete" disabled>
                        <label for="delete" class="form-label">The admin user can´t change his username or delete his account</label>
                    </div>
                    @else
                    <div class="gap-2 pt-3 d-flex">
                        <input type="checkbox" name="delete" id="delete">
                        <label for="delete" class="form-label"> ¿Are you sure to delete that account? You will lose everything.</label>
                    </div>
                    @endif

                </div>
            </form>
        </div>
    </div>

</div>
<script src="js/configVal.js"></script>
@endsection