const home = document.querySelector(".home-screen");
const yourmates = home.querySelector(".home-screen-matescontent .row");
const othermates = home.querySelector(".home-screen-otherscontent .row");
const id = home.querySelector(".id").textContent;

obtainOtherRecipes();
obtainMates();

async function obtainMates() {
    try {
        const response = await fetch(
            `http://api.talkandeat.es/api/followsPosts?id=${id}`
        );
        const data = await response.json();
        if (data.msg) {
        } else {
            data.forEach((recipe) => {
                createRecipe(recipe);
            });
        }
    } catch (error) {
        console.error("Error al obtener los compañeros:", error);
    }
}

async function obtainOtherRecipes() {
    try {
        const response = await fetch("http://api.talkandeat.es/api/8posts");
        const data = await response.json();
        data.forEach((recipe) => {
            createOtherRecipe(recipe);
        });
    } catch (error) {
        console.error("Error al obtener las otras recetas:", error);
    }
}

function createOtherRecipe(recipe) {
    const object = document.createElement("a");
    object.className = "col-12 col-sm-6 col-md-4 col-lg-3";
    object.href = `post/${recipe.ID_publicacion}`;

    let div = document.createElement("div");
    div.className = "object01";
    div.style.backgroundImage = recipe.imagen
        ? "url('img/buffins.jpg')"
        : "url('img/no-image-0.png')";

    let h3 = document.createElement("h3");
    h3.textContent = recipe.titulo;
    let h4 = document.createElement("h4");
    h4.textContent = recipe.dificultad;

    div.append(h3);
    div.append(h4);

    let h42 = document.createElement("h4");
    h42.className = "likes";
    h42.textContent = recipe.likes + " likes";
    div.append(h42);

    object.append(div);

    othermates.append(object);
}

function createRecipe(recipe) {
    const object = document.createElement("a");
    object.className = "col-12 col-sm-6 col-md-4 col-lg-3";
    object.href = `post/${recipe.ID_publicacion}`;

    let div = document.createElement("div");
    div.className = "object01";
    div.style.backgroundImage = recipe.imagen
        ? "url('img/buffins.jpg')"
        : "url('img/no-image-0.png')";

    let h3 = document.createElement("h3");
    h3.textContent = recipe.titulo;
    let h4 = document.createElement("h4");
    h4.textContent = recipe.dificultad;

    div.append(h3);
    div.append(h4);

    let h42 = document.createElement("h4");
    h42.className = "likes";
    h42.textContent = recipe.likes + " likes";
    div.append(h42);

    object.append(div);

    yourmates.append(object);
}
