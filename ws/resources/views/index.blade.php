@extends('layout.layout')
@section('content')

<div class="ws-screen container">
  <div class="row">
    <img class="img-fluid col-8 offset-2 col-md-8 offset-md-2 col-lg-6 offset-lg-3" src="./img/TalkAndEat.png" width="auto" height="auto" alt="TalkAndEat" />
  </div>

  <div class="row">
    <div class="intro col-9 offset-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
      <p>
        API Rest dedicado al manejo de datos de la base de datos de
        TalkAndEat.
      </p>
      <p>
        Todas las llamadas espacificadas abajo serán a partir de la url de
        este APIRest:
      </p>
      <p class="url">http://api.talkandeat.es/</p>
    </div>
  </div>

  <div class="row">
    <div class="col-9 offset-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 mb-4">
      <h2>GETS</h2>
    </div>
  </div>

  <div class="get row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/users</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Posible Parameters</h3>
      <p>id -> ?id=7</p>
      <p>username -> ?username=jaime</p>
      <p>email -> ?email=jaime@gmail.com</p>
      <p>En caso de no expecificar devolverá todos</p>
    </div>
    <div class="collapse multi-collapse col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
  "ID_usuario": 5,
  "nombre": "user00",
  "contrasena": "abc123.",
  "correo_electronico": "a20jaimecp@iessanclemente.net",
  "biografia": null,
  "foto_perfil": null,
  "seguidos": 0,
  "seguidores": 2
}
          </pre>
    </div>
  </div>

  <div class="get row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/posts</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse2" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse2 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Posible Parameters</h3>
      <p>id -> ?id=7</p>
    </div>
    <div class="collapse multi-collapse2 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
  "ID_publicacion": 5,
  "ID_usuario": 5,
  "titulo": "Pollo Asado al horno con patatas y cebolla",
  "descripcion": "Receta de pollo asado al horno con patatas y cebolla. Esta elaboración es muy fácil de hacer y no requiere de mucho esfuerzo. Pero sin duda, lo mejor de todo, es lo bien que queda.",
  "pasos": [
      {
          "ID_paso": 1,
          "orden": 1,
          "texto": "Comenzamos pelando las patatas. Una vez peladas, las cortamos en rodajas finas, de no más de 1 centímetro de grosor. Después, las ponemos como base en una bandeja para horno. Pelamos también las cebollas y las cortamos en tiras finas. La ponemos sobre la patata y salpimentamos todo."
      },
      {
          "ID_paso": 2,
          "orden": 2,
          "texto": "A continuación ponemos los muslos encima de las patatas y la cebolla. Le añadimos a todo un vaso de agua y un chorrete de aceite de oliva. Así quedará mas jugoso mientras se hornea. Nos aseguramos que en el fondo de la fuente, haya siempre humedad. Así la guarnición no se va a quemar. Salpimentamos y añadimos un buen pellizco de tomillo seco a cada muslo (o al pollo completo, si has elegido la pieza completa)."
      },
      {
          "ID_paso": 3,
          "orden": 3,
          "texto": "Metemos el pollo al horno a 220ºC si utilizas muslos. calor arriba y abajo. Dejamos hornear unos 30 minutos, hasta que se dore bien. Si utilizas un pollo entero, horneamos a 190ºC."
      },
      {
          "ID_paso": 4,
          "orden": 4,
          "texto": "Cuando esté bien dorado, sacamos la bandeja del horno, le damos la vuelta a las piezas. Así, se cocinará el otro lado."
      },
      {
          "ID_paso": 5,
          "orden": 5,
          "texto": "Inmediatamente después, volvemos a meter la bandeja dentro del horno. Finalmente dejamos cocinar aproximadamente el mismo tiempo, hasta que todo quede bien cocinado."
      }
  ],
  "ingredientes": [
      {
          "nombre": "Pollo entero",
          "unidad": "Pollo entero",
          "cantidad": 1
      },
      {
          "nombre": "Muslo de pollo",
          "unidad": "Muslo de pollo",
          "cantidad": 4
      },
      {
          "nombre": "Patata",
          "unidad": "Patata",
          "cantidad": 4
      },
      {
          "nombre": "Cebolla",
          "unidad": "Cebolla",
          "cantidad": 4
      },
      {
          "nombre": "Aceite de oliva",
          "unidad": "chorro",
          "cantidad": 1
      },
      {
          "nombre": "Sal",
          "unidad": "Sal",
          "cantidad": 1
      },
      {
          "nombre": "Pimienta",
          "unidad": "Pimienta",
          "cantidad": 1
      },
      {
          "nombre": "Tomillo",
          "unidad": "Tomillo",
          "cantidad": 1
      }
  ],
  "imagen": null,
  "duracion": 40,
  "dificultad": "Fácil",
  "comentarios": [
      {
          "username": "jaime",
          "profile_img": null,
          "texto": "sdfgfdsg"
      },
      {
          "username": "jaime",
          "profile_img": null,
          "texto": "asdfsadf"
      }
  ],
  "likes": 1
},
          </pre>
    </div>
  </div>

  <div class="get row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/8posts</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse3" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse3 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Posible Parameters</h3>
      <p>null</p>
      <p>devuelve siempre 8 publicaciones aleatorias.</p>
    </div>
    <div class="collapse multi-collapse3 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
  "ID_publicacion": 7,
  "ID_usuario": 6,
  "titulo": "Muffins de chocolate",
  "descripcion": "Suaves, esponjosos y con un irresistible corazón de chocolate fundido, estos muffins de chocolate son una receta ideal para descubrir el placer de la repostería casera",
  "pasos": [
      {
          "ID_paso": 6,
          "orden": 1,
          "texto": "Precalentar el horno a 200° C."
      },
      {
          "ID_paso": 7,
          "orden": 2,
          "texto": "Fundir en el microondas, 100 g de chocolate troceado con la mantequilla. Remover hasta dejar una crema."
      },
      {
          "ID_paso": 8,
          "orden": 3,
          "texto": "En un bol, batir los huevos y el azúcar."
      },
      {
          "ID_paso": 9,
          "orden": 4,
          "texto": "Añadir la levadura y la harina tamizada y mezclar. Añadir la crema de chocolate y mezclar."
      },
      {
          "ID_paso": 10,
          "orden": 5,
          "texto": "Rellenar unos moldes para muffins con 3/4 de la masa. Colocar una onza de chocolate en el centro y hundir ligeramente en la masa."
      },
      {
          "ID_paso": 11,
          "orden": 6,
          "texto": "Picar el resto del chocolate en trocitos pequeños y espolvorear sobre cada muffin."
      },
      {
          "ID_paso": 12,
          "orden": 7,
          "texto": "Hornearlas a media altura unos 13- 15 minutos."
      }
  ],
  "ingredientes": [
      {
          "nombre": "Chocolate Negro",
          "unidad": "g",
          "cantidad": 170
      },
      {
          "nombre": "Huevos",
          "unidad": "Huevos",
          "cantidad": 3
      },
      {
          "nombre": "Mantequilla",
          "unidad": "g",
          "cantidad": 100
      },
      {
          "nombre": "Harina",
          "unidad": "g",
          "cantidad": 100
      },
      {
          "nombre": "Azucar",
          "unidad": "g",
          "cantidad": 100
      },
      {
          "nombre": "Levadura en polvo",
          "unidad": "cucharada",
          "cantidad": 1
      }
  ],
  "imagen": null,
  "duracion": 30,
  "dificultad": "Fácil",
  "comentarios": [],
  "likes": 1
},
          </pre>
    </div>
  </div>

  <div class="get row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/postswith</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse4" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse4 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Parameters</h3>
      <p>search (obligatorio) -> ?search=horno</p>
    </div>
    <div class="collapse multi-collapse4 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
  "ID_publicacion": 5,
  "ID_usuario": 5,
  "titulo": "Pollo Asado al horno con patatas y cebolla",
  "descripcion": "Receta de pollo asado al horno con patatas y cebolla. Esta elaboración es muy fácil de hacer y no requiere de mucho esfuerzo. Pero sin duda, lo mejor de todo, es lo bien que queda.",
  "pasos": [
      {
          "ID_paso": 1,
          "orden": 1,
          "texto": "Comenzamos pelando las patatas. Una vez peladas, las cortamos en rodajas finas, de no más de 1 centímetro de grosor. Después, las ponemos como base en una bandeja para horno. Pelamos también las cebollas y las cortamos en tiras finas. La ponemos sobre la patata y salpimentamos todo."
      },
      {
          "ID_paso": 2,
          "orden": 2,
          "texto": "A continuación ponemos los muslos encima de las patatas y la cebolla. Le añadimos a todo un vaso de agua y un chorrete de aceite de oliva. Así quedará mas jugoso mientras se hornea. Nos aseguramos que en el fondo de la fuente, haya siempre humedad. Así la guarnición no se va a quemar. Salpimentamos y añadimos un buen pellizco de tomillo seco a cada muslo (o al pollo completo, si has elegido la pieza completa)."
      },
      {
          "ID_paso": 3,
          "orden": 3,
          "texto": "Metemos el pollo al horno a 220ºC si utilizas muslos. calor arriba y abajo. Dejamos hornear unos 30 minutos, hasta que se dore bien. Si utilizas un pollo entero, horneamos a 190ºC."
      },
      {
          "ID_paso": 4,
          "orden": 4,
          "texto": "Cuando esté bien dorado, sacamos la bandeja del horno, le damos la vuelta a las piezas. Así, se cocinará el otro lado."
      },
      {
          "ID_paso": 5,
          "orden": 5,
          "texto": "Inmediatamente después, volvemos a meter la bandeja dentro del horno. Finalmente dejamos cocinar aproximadamente el mismo tiempo, hasta que todo quede bien cocinado."
      }
  ],
  "ingredientes": [
      {
          "nombre": "Pollo entero",
          "unidad": "Pollo entero",
          "cantidad": 1
      },
      {
          "nombre": "Muslo de pollo",
          "unidad": "Muslo de pollo",
          "cantidad": 4
      },
      {
          "nombre": "Patata",
          "unidad": "Patata",
          "cantidad": 4
      },
      {
          "nombre": "Cebolla",
          "unidad": "Cebolla",
          "cantidad": 4
      },
      {
          "nombre": "Aceite de oliva",
          "unidad": "chorro",
          "cantidad": 1
      },
      {
          "nombre": "Sal",
          "unidad": "Sal",
          "cantidad": 1
      },
      {
          "nombre": "Pimienta",
          "unidad": "Pimienta",
          "cantidad": 1
      },
      {
          "nombre": "Tomillo",
          "unidad": "Tomillo",
          "cantidad": 1
      }
  ],
  "imagen": null,
  "duracion": 40,
  "dificultad": "Fácil",
  "comentarios": [
      {
          "username": "jaime",
          "profile_img": null,
          "texto": "sdfgfdsg"
      },
      {
          "username": "jaime",
          "profile_img": null,
          "texto": "asdfsadf"
      }
  ],
  "likes": 1
},
          </pre>
    </div>
  </div>

  <div class="get row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/userswith</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse5" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse5 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Parameters</h3>
      <p>search (obligatorio) -> ?search=jaime</p>
    </div>
    <div class="collapse multi-collapse5 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
  "ID_usuario": 7,
  "nombre": "jaime",
  "contrasena": "$2y$10$uvgb.Cbx2m9cnLiBDq0xcuDJmHAi46mhXkfkI8ZcYZo7IMS/3mH4O",
  "correo_electronico": "jaime@gmail.com",
  "biografia": "asfdsadf",
  "foto_perfil": null,
  "seguidos": 2,
  "seguidores": 1
}
          </pre>
    </div>
  </div>

  <div class="get row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/users/{id}</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse6" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse6 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Parameters</h3>
      <p>id (url, obligatorio) -> /7</p>
    </div>
    <div class="collapse multi-collapse6 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
  "ID_usuario": 7,
  "nombre": "jaime",
  "contrasena": "$2y$10$uvgb.Cbx2m9cnLiBDq0xcuDJmHAi46mhXkfkI8ZcYZo7IMS/3mH4O",
  "correo_electronico": "jaime@gmail.com",
  "biografia": "asfdsadf",
  "foto_perfil": null,
  "seguidos": 2,
  "seguidores": 1
}
          </pre>
    </div>
  </div>

  <div class="get row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/posts/{id}</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse7" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse7 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Parameters</h3>
      <p>id (url, obligatorio) -> /7</p>
    </div>
    <div class="collapse multi-collapse7 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
          {
  "ID_publicacion": 5,
  "ID_usuario": 5,
  "titulo": "Pollo Asado al horno con patatas y cebolla",
  "descripcion": "Receta de pollo asado al horno con patatas y cebolla. Esta elaboración es muy fácil de hacer y no requiere de mucho esfuerzo. Pero sin duda, lo mejor de todo, es lo bien que queda.",
  "pasos": [
      {
          "ID_paso": 1,
          "orden": 1,
          "texto": "Comenzamos pelando las patatas. Una vez peladas, las cortamos en rodajas finas, de no más de 1 centímetro de grosor. Después, las ponemos como base en una bandeja para horno. Pelamos también las cebollas y las cortamos en tiras finas. La ponemos sobre la patata y salpimentamos todo."
      },
      {
          "ID_paso": 2,
          "orden": 2,
          "texto": "A continuación ponemos los muslos encima de las patatas y la cebolla. Le añadimos a todo un vaso de agua y un chorrete de aceite de oliva. Así quedará mas jugoso mientras se hornea. Nos aseguramos que en el fondo de la fuente, haya siempre humedad. Así la guarnición no se va a quemar. Salpimentamos y añadimos un buen pellizco de tomillo seco a cada muslo (o al pollo completo, si has elegido la pieza completa)."
      },
      {
          "ID_paso": 3,
          "orden": 3,
          "texto": "Metemos el pollo al horno a 220ºC si utilizas muslos. calor arriba y abajo. Dejamos hornear unos 30 minutos, hasta que se dore bien. Si utilizas un pollo entero, horneamos a 190ºC."
      },
      {
          "ID_paso": 4,
          "orden": 4,
          "texto": "Cuando esté bien dorado, sacamos la bandeja del horno, le damos la vuelta a las piezas. Así, se cocinará el otro lado."
      },
      {
          "ID_paso": 5,
          "orden": 5,
          "texto": "Inmediatamente después, volvemos a meter la bandeja dentro del horno. Finalmente dejamos cocinar aproximadamente el mismo tiempo, hasta que todo quede bien cocinado."
      }
  ],
  "ingredientes": [
      {
          "nombre": "Pollo entero",
          "unidad": "Pollo entero",
          "cantidad": 1
      },
      {
          "nombre": "Muslo de pollo",
          "unidad": "Muslo de pollo",
          "cantidad": 4
      },
      {
          "nombre": "Patata",
          "unidad": "Patata",
          "cantidad": 4
      },
      {
          "nombre": "Cebolla",
          "unidad": "Cebolla",
          "cantidad": 4
      },
      {
          "nombre": "Aceite de oliva",
          "unidad": "chorro",
          "cantidad": 1
      },
      {
          "nombre": "Sal",
          "unidad": "Sal",
          "cantidad": 1
      },
      {
          "nombre": "Pimienta",
          "unidad": "Pimienta",
          "cantidad": 1
      },
      {
          "nombre": "Tomillo",
          "unidad": "Tomillo",
          "cantidad": 1
      }
  ],
  "imagen": null,
  "duracion": 40,
  "dificultad": "Fácil",
  "likes": 1
},
          </pre>
    </div>
  </div>

  <div class="get row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/ingredients</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse8" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse8 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Parameters</h3>
      <p>id (url, obligatorio) -> /7</p>
    </div>
    <div class="collapse multi-collapse8 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
  "ID_ingrediente": 2,
  "nombre": "Pollo entero"
},
          </pre>
    </div>
  </div>

  <div class="get row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/postsBy</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse9" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse9 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Parameters</h3>
      <p>id ( obligatorio) -> ?id=7</p>
      <p>devuelve todas las publicacione de un usuario x</p>
    </div>
    <div class="collapse multi-collapse9 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
          {
  "ID_publicacion": 5,
  "ID_usuario": 5,
  "titulo": "Pollo Asado al horno con patatas y cebolla",
  "descripcion": "Receta de pollo asado al horno con patatas y cebolla. Esta elaboración es muy fácil de hacer y no requiere de mucho esfuerzo. Pero sin duda, lo mejor de todo, es lo bien que queda.",
  "pasos": [
      {
          "ID_paso": 1,
          "orden": 1,
          "texto": "Comenzamos pelando las patatas. Una vez peladas, las cortamos en rodajas finas, de no más de 1 centímetro de grosor. Después, las ponemos como base en una bandeja para horno. Pelamos también las cebollas y las cortamos en tiras finas. La ponemos sobre la patata y salpimentamos todo."
      },
      {
          "ID_paso": 2,
          "orden": 2,
          "texto": "A continuación ponemos los muslos encima de las patatas y la cebolla. Le añadimos a todo un vaso de agua y un chorrete de aceite de oliva. Así quedará mas jugoso mientras se hornea. Nos aseguramos que en el fondo de la fuente, haya siempre humedad. Así la guarnición no se va a quemar. Salpimentamos y añadimos un buen pellizco de tomillo seco a cada muslo (o al pollo completo, si has elegido la pieza completa)."
      },
      {
          "ID_paso": 3,
          "orden": 3,
          "texto": "Metemos el pollo al horno a 220ºC si utilizas muslos. calor arriba y abajo. Dejamos hornear unos 30 minutos, hasta que se dore bien. Si utilizas un pollo entero, horneamos a 190ºC."
      },
      {
          "ID_paso": 4,
          "orden": 4,
          "texto": "Cuando esté bien dorado, sacamos la bandeja del horno, le damos la vuelta a las piezas. Así, se cocinará el otro lado."
      },
      {
          "ID_paso": 5,
          "orden": 5,
          "texto": "Inmediatamente después, volvemos a meter la bandeja dentro del horno. Finalmente dejamos cocinar aproximadamente el mismo tiempo, hasta que todo quede bien cocinado."
      }
  ],
  "ingredientes": [
      {
          "nombre": "Pollo entero",
          "unidad": "Pollo entero",
          "cantidad": 1
      },
      {
          "nombre": "Muslo de pollo",
          "unidad": "Muslo de pollo",
          "cantidad": 4
      },
      {
          "nombre": "Patata",
          "unidad": "Patata",
          "cantidad": 4
      },
      {
          "nombre": "Cebolla",
          "unidad": "Cebolla",
          "cantidad": 4
      },
      {
          "nombre": "Aceite de oliva",
          "unidad": "chorro",
          "cantidad": 1
      },
      {
          "nombre": "Sal",
          "unidad": "Sal",
          "cantidad": 1
      },
      {
          "nombre": "Pimienta",
          "unidad": "Pimienta",
          "cantidad": 1
      },
      {
          "nombre": "Tomillo",
          "unidad": "Tomillo",
          "cantidad": 1
      }
  ],
  "imagen": null,
  "duracion": 40,
  "dificultad": "Fácil",
  "comentarios": [
      {
          "username": "jaime",
          "profile_img": null,
          "texto": "sdfgfdsg"
      },
      {
          "username": "jaime",
          "profile_img": null,
          "texto": "asdfsadf"
      }
  ],
  "likes": 1
},
          </pre>
    </div>
  </div>

  <div class="get row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/follows</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse10" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse10 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Parameters</h3>
      <p>id ( obligatorio) -> ?id=7</p>
    </div>
    <div class="collapse multi-collapse10 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
  "ID_usuario": 5,
  "nombre": "user00",
  "contrasena": "abc123.",
  "correo_electronico": "a20jaimecp@iessanclemente.net",
  "biografia": null,
  "foto_perfil": null
},
          </pre>
    </div>
  </div>

  <div class="get row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/followers</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse11" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse11 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Parameters</h3>
      <p>id ( obligatorio) -> ?id=7</p>
    </div>
    <div class="collapse multi-collapse11 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
  "ID_usuario": 5,
  "nombre": "user00",
  "contrasena": "abc123.",
  "correo_electronico": "a20jaimecp@iessanclemente.net",
  "biografia": null,
  "foto_perfil": null
},
          </pre>
    </div>
  </div>

  <div class="get row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/isfollow</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse12" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse12 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Parameters</h3>
      <p>ID_usuario_seguidor (obligatorio) -> ?ID_usuario_seguidor=7</p>
      <p>ID_usuario_seguido (obligatorio) -> ?ID_usuario_seguido=8</p>
    </div>
    <div class="collapse multi-collapse12 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <h4>Yes</h4>
      <pre>
{
  "status": 1,
  "msg": "Ok",
  "code": 200
}
          </pre>
      <h4>No</h4>
      <pre>
{
  "status": 0,
  "msg": "Not found",
  "code": 404
}
        </pre>
    </div>
  </div>

  <div class="get row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/followsPosts</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse13" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse13 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Parameters</h3>
      <p>id ( obligatorio) -> ?id=7</p>
    </div>
    <div class="collapse multi-collapse13 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
          {
  "ID_publicacion": 5,
  "ID_usuario": 5,
  "titulo": "Pollo Asado al horno con patatas y cebolla",
  "descripcion": "Receta de pollo asado al horno con patatas y cebolla. Esta elaboración es muy fácil de hacer y no requiere de mucho esfuerzo. Pero sin duda, lo mejor de todo, es lo bien que queda.",
  "pasos": [
      {
          "ID_paso": 1,
          "orden": 1,
          "texto": "Comenzamos pelando las patatas. Una vez peladas, las cortamos en rodajas finas, de no más de 1 centímetro de grosor. Después, las ponemos como base en una bandeja para horno. Pelamos también las cebollas y las cortamos en tiras finas. La ponemos sobre la patata y salpimentamos todo."
      },
      {
          "ID_paso": 2,
          "orden": 2,
          "texto": "A continuación ponemos los muslos encima de las patatas y la cebolla. Le añadimos a todo un vaso de agua y un chorrete de aceite de oliva. Así quedará mas jugoso mientras se hornea. Nos aseguramos que en el fondo de la fuente, haya siempre humedad. Así la guarnición no se va a quemar. Salpimentamos y añadimos un buen pellizco de tomillo seco a cada muslo (o al pollo completo, si has elegido la pieza completa)."
      },
      {
          "ID_paso": 3,
          "orden": 3,
          "texto": "Metemos el pollo al horno a 220ºC si utilizas muslos. calor arriba y abajo. Dejamos hornear unos 30 minutos, hasta que se dore bien. Si utilizas un pollo entero, horneamos a 190ºC."
      },
      {
          "ID_paso": 4,
          "orden": 4,
          "texto": "Cuando esté bien dorado, sacamos la bandeja del horno, le damos la vuelta a las piezas. Así, se cocinará el otro lado."
      },
      {
          "ID_paso": 5,
          "orden": 5,
          "texto": "Inmediatamente después, volvemos a meter la bandeja dentro del horno. Finalmente dejamos cocinar aproximadamente el mismo tiempo, hasta que todo quede bien cocinado."
      }
  ],
  "ingredientes": [
      {
          "nombre": "Pollo entero",
          "unidad": "Pollo entero",
          "cantidad": 1
      },
      {
          "nombre": "Muslo de pollo",
          "unidad": "Muslo de pollo",
          "cantidad": 4
      },
      {
          "nombre": "Patata",
          "unidad": "Patata",
          "cantidad": 4
      },
      {
          "nombre": "Cebolla",
          "unidad": "Cebolla",
          "cantidad": 4
      },
      {
          "nombre": "Aceite de oliva",
          "unidad": "chorro",
          "cantidad": 1
      },
      {
          "nombre": "Sal",
          "unidad": "Sal",
          "cantidad": 1
      },
      {
          "nombre": "Pimienta",
          "unidad": "Pimienta",
          "cantidad": 1
      },
      {
          "nombre": "Tomillo",
          "unidad": "Tomillo",
          "cantidad": 1
      }
  ],
  "imagen": null,
  "duracion": 40,
  "dificultad": "Fácil",
  "comentarios": [
      {
          "username": "jaime",
          "profile_img": null,
          "texto": "sdfgfdsg"
      },
      {
          "username": "jaime",
          "profile_img": null,
          "texto": "asdfsadf"
      }
  ],
  "likes": 1
},
          </pre>
    </div>
  </div>

  <div class="get row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/recipesIngredients</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse25" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse25 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Posible Parameters</h3>
      <p>ingredients (obligatorio) -> ?ingredients=[4,5]</p>
    </div>
    <div class="collapse multi-collapse25 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
  "ID_publicacion": 5,
  "ID_usuario": 5,
  "titulo": "Pollo Asado al horno con patatas y cebolla",
  "descripcion": "Receta de pollo asado al horno con patatas y cebolla. Esta elaboración es muy fácil de hacer y no requiere de mucho esfuerzo. Pero sin duda, lo mejor de todo, es lo bien que queda.",
  "pasos": [
      {
          "ID_paso": 1,
          "orden": 1,
          "texto": "Comenzamos pelando las patatas. Una vez peladas, las cortamos en rodajas finas, de no más de 1 centímetro de grosor. Después, las ponemos como base en una bandeja para horno. Pelamos también las cebollas y las cortamos en tiras finas. La ponemos sobre la patata y salpimentamos todo."
      },
      {
          "ID_paso": 2,
          "orden": 2,
          "texto": "A continuación ponemos los muslos encima de las patatas y la cebolla. Le añadimos a todo un vaso de agua y un chorrete de aceite de oliva. Así quedará mas jugoso mientras se hornea. Nos aseguramos que en el fondo de la fuente, haya siempre humedad. Así la guarnición no se va a quemar. Salpimentamos y añadimos un buen pellizco de tomillo seco a cada muslo (o al pollo completo, si has elegido la pieza completa)."
      },
      {
          "ID_paso": 3,
          "orden": 3,
          "texto": "Metemos el pollo al horno a 220ºC si utilizas muslos. calor arriba y abajo. Dejamos hornear unos 30 minutos, hasta que se dore bien. Si utilizas un pollo entero, horneamos a 190ºC."
      },
      {
          "ID_paso": 4,
          "orden": 4,
          "texto": "Cuando esté bien dorado, sacamos la bandeja del horno, le damos la vuelta a las piezas. Así, se cocinará el otro lado."
      },
      {
          "ID_paso": 5,
          "orden": 5,
          "texto": "Inmediatamente después, volvemos a meter la bandeja dentro del horno. Finalmente dejamos cocinar aproximadamente el mismo tiempo, hasta que todo quede bien cocinado."
      }
  ],
  "ingredientes": [
      {
          "nombre": "Pollo entero",
          "unidad": "Pollo entero",
          "cantidad": 1
      },
      {
          "nombre": "Muslo de pollo",
          "unidad": "Muslo de pollo",
          "cantidad": 4
      },
      {
          "nombre": "Patata",
          "unidad": "Patata",
          "cantidad": 4
      },
      {
          "nombre": "Cebolla",
          "unidad": "Cebolla",
          "cantidad": 4
      },
      {
          "nombre": "Aceite de oliva",
          "unidad": "chorro",
          "cantidad": 1
      },
      {
          "nombre": "Sal",
          "unidad": "Sal",
          "cantidad": 1
      },
      {
          "nombre": "Pimienta",
          "unidad": "Pimienta",
          "cantidad": 1
      },
      {
          "nombre": "Tomillo",
          "unidad": "Tomillo",
          "cantidad": 1
      }
  ],
  "imagen": null,
  "duracion": 40,
  "dificultad": "Fácil",
  "comentarios": [
      {
          "username": "jaime",
          "profile_img": null,
          "texto": "sdfgfdsg"
      },
      {
          "username": "jaime",
          "profile_img": null,
          "texto": "asdfsadf"
      }
  ],
  "likes": 1
},
          </pre>
    </div>
  </div>


  <div class="get row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/islike</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse26" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse26 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Posible Parameters</h3>
      <p>ID_usuario (obligatorio) -> ?ID_usuario=7</p>
      <p>ID_publicacion (obligatorio) -> ?ID_publicacion=5</p>
    </div>
    <div class="collapse multi-collapse26 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
YES:
{
  "status":1,
  "msg":"Ok",
  "code":200
}

NO:
{
  "status": 0,
  "msg": "Not found",
  "code": 404
}
          </pre>
    </div>
  </div>

  <div class="get row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/notifications</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse27" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse27 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Posible Parameters</h3>
      <p>null</p>

    </div>
    <div class="collapse multi-collapse27 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
  "ID_notificacion": 3,
  "ID_usuario": 5,
  "username": "username",
  "emisor": 7,
  "username_emisor": "jaime",
  "objetivo_post": 8,
  "fecha": "2023-06-12 17:10:42",
  "tipo": "like",
  "visible": 1
},
          </pre>
    </div>
  </div>


  <div class="get row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/notificationsBy</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse28" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse28 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Posible Parameters</h3>
      <p>ID_usuario (obligatorio) -> ?ID_usuario=7</p>

    </div>
    <div class="collapse multi-collapse28 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
  "ID_notificacion": 3,
  "ID_usuario": 5,
  "username": "username",
  "emisor": 7,
  "username_emisor": "jaime",
  "objetivo_post": 8,
  "fecha": "2023-06-12 17:10:42",
  "tipo": "like",
  "visible": 1
},
          </pre>
    </div>
  </div>


  <div class="row">
    <div class="col-9 offset-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 mb-4">
      <h2>POSTS</h2>
    </div>
  </div>

  <div class="post row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/post</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse14" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse14 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Body</h3>
      <pre>
{
  "ID_usuario":7,
  "titulo":"text",
  "descripcion":"text",
  "imagen":null,
  "duracion":30,
  "dificultad":"Fácil",
  "ingredientes":{ 
      "ingrediente":{
          "nombre": "Sal",
          "cantidad": 30,
          "unidad": "g"
      }
   },
  "pasos":{
      "paso":{
          "orden":"1",
          "texto":"test"
          }
  }
}
            </pre>
    </div>
    <div class="collapse multi-collapse14 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
  "status": 1,
  "msg": "Ok",
  "code": 200
}
          </pre>
    </div>
  </div>

  <div class="post row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/follow</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse15" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse15 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Body</h3>
      <pre>
{
  "ID_usuario_seguidor":7,
  "ID_usuario_seguido":11
}
        </pre>
    </div>
    <div class="collapse multi-collapse15 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
"status": 1,
"msg": "Ok",
"code": 200
}
      </pre>
    </div>
  </div>

  <div class="post row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/comment</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse18" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse18 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Body</h3>
      <pre>
{
  "ID_publicacion":12,
  "ID_usuario" :7,
  "texto":"webservice"
}
        </pre>
    </div>
    <div class="collapse multi-collapse18 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
"status": 1,
"msg": "Ok",
"code": 200
}
      </pre>
    </div>
  </div>

  <div class="post row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/like</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse29" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse29 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Body</h3>
      <pre>
{
  "ID_usuario":7,
  "ID_publicacion":5,
}
            </pre>
    </div>
    <div class="collapse multi-collapse29 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
  "status": 1,
  "msg": "Ok",
  "code": 200
}
          </pre>
    </div>
  </div>


  <div class="row">
    <div class="col-9 offset-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 mb-4">
      <h2>DELETE</h2>
    </div>
  </div>

  <div class="post row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/deletePost</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse16" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse16 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Body</h3>
      <pre>
{
"ID_publicacion":46,
}
    </pre>
    </div>
    <div class="collapse multi-collapse16 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
"status": 1,
"msg": "Ok",
"code": 200
}
  </pre>
    </div>
  </div>

  <div class="post row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/deleteUser</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse17" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse17 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Body</h3>
      <pre>
{
"ID_usuario":46,
}
    </pre>
    </div>
    <div class="collapse multi-collapse17 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
"status": 1,
"msg": "Ok",
"code": 200
}
  </pre>
    </div>
  </div>

  <div class="post row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/deleteFollow</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse21" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse21 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Body</h3>
      <pre>
{
  "ID_usuario_seguidor":7,
  "ID_usuario_seguido":11
}
    </pre>
    </div>
    <div class="collapse multi-collapse21 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
"status": 1,
"msg": "Ok",
"code": 200
}
  </pre>
    </div>
  </div>


  <div class="post row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/deleteLike</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse30" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse30 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Body</h3>
      <pre>
{
  "ID_usuario":7,
  "ID_publicacion":5
}
    </pre>
    </div>
    <div class="collapse multi-collapse30 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
"status": 1,
"msg": "Ok",
"code": 200
}
  </pre>
    </div>
  </div>

  <div class="post row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/allnotifications</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse31" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse31 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Body</h3>
      <pre>
{
  
}
    </pre>
    </div>
    <div class="collapse multi-collapse31 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
"status": 1,
"msg": "Ok",
"code": 200
}
  </pre>
    </div>
  </div>


  <div class="row">
    <div class="col-9 offset-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 mb-4">
      <h2>PUT</h2>
    </div>
  </div>

  <div class="post row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/user</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse20" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse20 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Body</h3>
      <pre>
{
  "ID_usuario":5,
  "nombre":"username",
  "contrasena":"abc123.",
  "correo_electronico":"a20jaimecp@iessanclemente.net",
  "biografia":"biografia",
  "foto_perfil":null
}
    </pre>
    </div>
    <div class="collapse multi-collapse20 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
"status": 1,
"msg": "Ok",
"code": 200
}
  </pre>
    </div>
  </div>


  <div class="post row mt-2 mb-2">
    <!--Call-->
    <div class="col-9 offset-1 col-md-7 offset-md-2 col-lg-7 offset-lg-2">
      <p class="url">api/hidenotification</p>
    </div>
    <button class="btn col-1 text-center" data-bs-toggle="collapse" data-bs-target=".multi-collapse32" aria-expanded="false">
      <i class="fa-solid fa-square-caret-down"></i>
    </button>

    <div class="collapse multi-collapse32 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-2">
      <h3>Body</h3>
      <pre>
{
  "ID_notificacion":1,
  
}
    </pre>
    </div>
    <div class="collapse multi-collapse32 col-10 offset-1 col-md-8 offset-md-2 col-lg-4 offset-lg-0">
      <h3>Response Format</h3>
      <pre>
{
"status": 1,
"msg": "Ok",
"code": 200
}
  </pre>
    </div>
  </div>

</div>


@endsection