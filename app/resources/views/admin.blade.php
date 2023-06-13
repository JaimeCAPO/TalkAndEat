@extends('layout.layout')
@section('title','Admin')
@section('content')

<div class="container-fluid admin-screen mt-5 mb-5">
        <div class="admin-users col-10 mb-2 p-4">
            <div class="row">
                <div class="offset-md-1 col-md-7 offset-1 col-10 order-2 order-md-1 table-responsive table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Posts</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        
                    </table>
                </div>
                <div class="head offset-md-0 col-md-4  offset-1 col-10 order-1 order-md-2 ">USERS</div>
            </div>
        </div>
        <div class="admin-posts offset-2 col-10 mb-2 p-4">
            <div class="row">
                <div class="head offset-md-0 col-md-4 offset-1 col-10">POSTS</div>

                <div class="offset-md-0 col-md-7 offset-1 col-10 order-2 order-md-1 table-responsive table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID_user</th>
                                <th>Title</th>
                                <th>Dificult</th>
                                <th>Comments</th>
                                <th>Steps</th>
                                <th>Ingredients</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>            
        </div>
        <div class="admin-visualizer col-10 mb-2 p-4">
            <div class="row">
                <div class="offset-md-1 col-md-7 offset-1 col-10 order-2 order-md-1 console  ">
                    

                </div>
                <div class="head offset-md-0 col-md-4  offset-1 col-10 order-1 order-md-2 d-flex flex-col ">
                    <div>LOGS</div>
                    <button class="btn btn-clean">Clean Logs</button>
                </div>
            </div>        
        </div>
    </div>

    <script src="js/admin.js"></script>

@endsection
