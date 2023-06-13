@extends('layout.layout')
@section('title','Recipe')
@section('content')

<?php $url = $_SERVER['REQUEST_URI'];
$lastSlashPos = strrpos($url, '/');
$lastSegment = substr($url, $lastSlashPos + 1);
?>
<div class="d-none" id="id"><?php echo $me ?></div>
<div class="recipe-screen  pt-2 pb-5 container-fluid">

  <div class="d-none recipe-image-empty container p-2">
    <img src="../img/no-image.png" class="img-fluid rounded-3" alt="imagename" width="100" height="auto" />
  </div>
  <div class="recipe-content mt-5 p-6 container">
    <div class="recipe-header">
      <div class="d-flex justify-content-between">
        <h2>Receta de magdalenas artesanas</h2>
        <button class="btn btn-like">Like</button>
      </div>
      <hr />
      <div class="recipe-details row">
        <div class="preparation-time col-12 col-md-4">
          <h3>Tiempo de preparación</h3>
          <p>45 min</p>
        </div>
        <div class="preparation-persons col-6 col-md-4">
          <h3>Author</h3>
          <a>#</a>
        </div>
        <div class="preparation-dificult col-6 col-md-4">
          <h3>Dificultad</h3>
          <p>Fácil</p>
        </div>
      </div>
    </div>

    <div class="recipe-summary">
      <h2>Resumen</h2>
      <p>
        Te mostraremos una forma facil y sencilla de elaborar unas
        deliciosas magdalenas estupendas para desayunar, merendar o para que
        los mas peques las lleven al cole.
      </p>
    </div>

    <div class="recipe-ingredients">
      <h2>Ingredientes</h2>

    </div>

    <div class="recipe-elaboration mt-2 row">
      <h2 class="mb-3">Elaboración</h2>

    </div>
  </div>

  <div class="recipe-comments mt-4 rounded-4 container">
    <h2>Comentarios</h2>
    <div class="coments-content rounded-3">
      <form action="../post/{{$lastSegment}}" method="post" class="d-flex m-auto mt-5 mb-4 gap-2 newcomment">
        @csrf
        <input type="text" name="msg" id="msg" placeholder="Escribe un mensaje..." class="form-control" required>
        <input type="text" name="id" id="id" class="d-none id">
        <button type="submit" class="btn">
          <i class="fa-solid fa-paper-plane"></i>
        </button>
      </form>
      <div class="nocomments d-none m-auto">
        <h3>Aun no hay comentarios</h3>
        <i class="fa-solid fa-face-rolling-eyes"></i>
      </div>

    </div>
  </div>
</div>

<script src="../js/recipe.js"></script>
@endsection