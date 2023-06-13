@extends('layout.layout')
@section('title', 'Explore')
@section('content')

<div class="explore-screen mt-4">
    @csrf
    <form action="{{ route('explore') }}" class="container explore-screen-explorebar d-flex">
        <input type="text" name="explore" id="explore" class="form-control" placeholder="Title for recipes or @username for users">
        <button class="btn">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>
    <div class="container explore-screen-content">
        <div class="row">
            <div class="explore-screen-ingredients col-12  col-md-4 p-3">
                <form action="{{ route('explore') }}" method="get" class="row">
                    @csrf
                    <h2>Filters</h2>
                    <div class="ingredients-dificult d-flex align-items-center justify-content-center gap-2">
                        <h3>Dificult</h3>
                        <button class="btn btn-filter"><i class="fa-solid fa-filter"></i></button>
                    </div>

                    <div class="col-12 col-lg-6">
                        <input type="radio" name="dif" id="facil" value="facil" class="form-check-inline">
                        <label for="facil" class="form-label">Easy</label>
                    </div>
                    <div class="col-12 col-lg-6">
                        <input type="radio" name="dif" id="medio" value="medio" class="form-check-inline">
                        <label for="medio" class="form-label">Medium</label>
                    </div>
                    <div class="col-12 col-lg-6">
                        <input type="radio" name="dif" id="dificil" value="dificil" class="form-check-inline">
                        <label for="dificil" class="form-label">Hard</label>
                    </div>
                    <div class="ingredients-ingredients d-flex align-items-center justify-content-center gap-2">
                        <h3>Ingredients</h3>
                        <button class="btn btn-filter"><i class="fa-solid fa-filter"></i></button>
                    </div>


                </form>
            </div>
            <div class="col-12 col-md-8">
                <div class="explore-screen-recipes row">
                    <div class="col-12 error">
                        <h2>No se encontraron resultados :(</h2>
                    </div>
                    <div class="col-12 success">
                        <h2>Hay x resultados :)</h2>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/explore.js"></script>
<script src="js/search.js"></script>
<script src="js/filter.js"></script>
@endsection