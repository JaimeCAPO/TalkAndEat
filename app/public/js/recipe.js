let recipescreen = document.querySelector(".recipe-screen");
let btnlike = document.querySelector(".recipe-screen .btn-like");
let id = document.getElementById("id").textContent;

let url = window.location.pathname;
splited = url.split("/");

console.log(id);

setRecipe();
getlike();

btnlike.addEventListener("click", function (e) {
    e.preventDefault();
    if (btnlike.textContent == "liked") {
        let body = {
            ID_usuario: id,
            ID_publicacion: splited[splited.length - 1],
        };
        const requestOptions = {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(body),
        };

        // Realizar la solicitud POST
        fetch("https://api.talkandeat.es/api/deleteLike", requestOptions)
            .then((response) => response.json())
            .then((data) => {
                // Manipular la respuesta de la API
                console.log("Respuesta de la API:", data);
                btnlike.textContent = "like";
                btnlike.className = "btn btn-like";
            })
            .catch((error) => {
                // Manejar errores de la solicitud
                console.error("Error en la solicitud:", error);
            });
    } else {
        let body = {
            ID_usuario: id,
            ID_publicacion: splited[splited.length - 1],
        };
        const requestOptions = {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(body),
        };

        // Realizar la solicitud POST
        fetch("https://api.talkandeat.es/api/like", requestOptions)
            .then((response) => response.json())
            .then((data) => {
                // Manipular la respuesta de la API
                console.log("Respuesta de la API:", data);
                btnlike.textContent = "liked";
                btnlike.className = "btn btn-liked";
            })
            .catch((error) => {
                // Manejar errores de la solicitud
                console.error("Error en la solicitud:", error);
            });
    }
});

function getlike() {
    fetch(
        "http://api.talkandeat.es/api/islike?ID_usuario=" +
            id +
            "&ID_publicacion=" +
            splited[splited.length - 1]
    )
        .then((response) => response.json())
        .then((like) => {
            if (like["code"] == 200) {
                btnlike.className = "btn btn-liked";
                btnlike.textContent = "liked";
            } else {
                console.log("no-like");
            }
        });
}

async function setRecipe() {
    fetch(
        "http://api.talkandeat.es/api/posts?id=" + splited[splited.length - 1]
    )
        .then((response) => response.json())
        .then((recipe) => {
            if (recipe["imagen"]) {
                let imagen = recipescreen.querySelector(".recipe-image-empty");
                imagen.className = "recipe-image container p-2";
                let img = imagen.querySelector("img");
                img.src = "../img/buffins.jpg";
                img.className = "img-fluid w-100 rounded-3";
            }

            let title = recipescreen.querySelector(".recipe-header h2");
            title.textContent = recipe["titulo"];
            let time = recipescreen.querySelector(".preparation-time p");
            time.textContent = recipe["duracion"] + " min";
            let author = recipescreen.querySelector(".preparation-persons a");
            author.textContent = "#" + recipe["ID_usuario"];
            author.href = "../user/" + recipe["ID_usuario"];
            let dif = recipescreen.querySelector(".preparation-dificult p");
            dif.textContent = recipe["dificultad"];

            let desc = recipescreen.querySelector(".recipe-summary p");
            desc.textContent = recipe["descripcion"];
            let ingredients = recipescreen.querySelector(".recipe-ingredients");
            recipe["ingredientes"].forEach((ingredient) => {
                let object = document.createElement("div");
                object.className = "ingredient row gap-1";

                let name = document.createElement("p");
                name.textContent = ingredient["nombre"];
                name.className = "offset-1 col-6 col-md-7";
                let cant = document.createElement("p");
                cant.textContent =
                    ingredient["cantidad"] + " " + ingredient["unidad"];
                cant.className = "col-4 col-md-3";

                object.append(name);
                object.append(cant);
                ingredients.append(object);
            });

            let steps = recipescreen.querySelector(".recipe-elaboration");
            recipe["pasos"].forEach((paso, key) => {
                let object = document.createElement("div");
                if (key % 2 == 0)
                    object.className = "step mt-2 col-10 col-md-8 col-lg-6";
                else
                    object.className =
                        "step mt-2 offset-2 col-10 offset-md-4 col-md-8 offset-lg-6 col-lg-6";
                let orden = document.createElement("div");
                orden.textContent = paso["orden"];
                let texto = document.createElement("p");
                texto.textContent = paso["texto"];

                object.append(orden);
                object.append(texto);
                steps.append(object);
            });

            let comentarios = recipescreen.querySelector(".recipe-comments");
            if (recipe["comentarios"].length < 1) {
                let empty = recipescreen.querySelector(".nocomments");
                empty.className = "nocomments d-flex m-auto";
            } else {
                recipe["comentarios"].forEach((comment) => {
                    let object = document.createElement("div");
                    object.className = "comment";

                    let div = document.createElement("div");
                    div.className = "userinfo d-flex gap-3 align-items-end";
                    let h4 = document.createElement("h4");
                    h4.textContent = "@" + comment["username"];
                    if (comment["imagen"]) {
                        let img = document.createElement("img");
                        img.src = "img/jaime.png";
                        div.append(img);
                    }
                    let p = document.createElement("p");
                    p.textContent = comment["texto"];

                    object.append(div);
                    div.append(h4);
                    object.append(p);
                    comentarios.append(object);
                });
            }
            let id = recipescreen.querySelector("input.id");
            id.value = recipe["ID_publicacion"];
            console.log(id);
        });
}
