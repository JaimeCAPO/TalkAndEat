@extends('layout.layout')
@section('title','Post')
@section('content')

<form class="post-receta container" action="{{route('account')}}" method="get">
  @csrf
  <input class="d-none" type="text" name="id" id="id" value="{{$me}}">
  <div class="d-none btn-add-img">
    <div>
      <h2>Image</h2>
      <i class="fa-solid fa-icons"></i>
    </div>
    <input type="file" class="form-control" name="image" id="image" />
  </div>
  <div>
    <div class="receta">
      <div class="receta-header">
        <div class="receta-header-title">
          <label class="form-label" for="title">Title </label>
          <input type="text" class="form-control" name="title" id="title" required />
        </div>
        <hr />
        <div class="receta-details">
          <div class="preparation-time">
            <label class="form-label details-title" for="time">Tiempo de preparación</label>
            <div class="time-mins">
              <input class="form-control" type="number" name="time" id="time" required />
              <label class="form-label" for="time">mins</label>
            </div>
          </div>

          <div class="preparation-dificult">
            <label for="dificultad" class="form-label details-title">Dificultad</label>
            <select class="form-select" name="dificultad" id="dificultad" required>
              <option value="Fácil" selected>Fácil</option>
              <option value="Medio">Medio</option>
              <option value="Dificil">Dificil</option>
            </select>
          </div>
        </div>
      </div>
      <div class="receta-summary">
        <h2>Resumen</h2>
        <textarea name="summary" id="summary" class="form-control" cols="30" rows="5" required></textarea>
      </div>
      <div class="receta-ingredients">
        <h2>Ingredientes</h2>
        <div class="lista">
          <button class="btn-new-step-container btn">
            <i class="fa-solid fa-square-plus btn-new-ingredient"></i>
          </button>
        </div>
      </div>
      <div class="receta-elaboration">
        <h2>Elaboración</h2>

        <button class="btn-new-step-container btn">
          <i class="fa-solid fa-square-plus btn-new-step"></i>
        </button>

      </div>
    </div>
  </div>
  <button type="submit" class="btn-post-receta">
    <i class="fa-solid fa-shrimp"></i>
  </button>
</form>

<script src="js/newPost.js"></script>
<script src="js/addpost.js"></script>
@endsection