const filter = document.querySelector(".explore-screen");
const filterrecipes = filter.querySelector(".explore-screen-recipes");
const btnFilterDif = filter.querySelector(
    ".explore-screen-ingredients .ingredients-dificult button"
);
const btnFilterIngre = filter.querySelector(
    ".explore-screen-ingredients .ingredients-ingredients button"
);
const radioFacil = filter.querySelector("#facil");
const radioMedio = filter.querySelector("#medio");
const radioDificil = filter.querySelector("#dificil");

let filtereds = [];

btnFilterDif.addEventListener("click", function (e) {
    e.preventDefault();

    if (radioFacil.checked) setRecipes("Fácil");
    else if (radioMedio.checked) setRecipes("Medio");
    else if (radioDificil.checked) setRecipes("Dificil");
});

btnFilterIngre.addEventListener("click", function (e) {
    e.preventDefault();

    let ids = [];
    const inputs = filter
        .querySelectorAll(".ingredient-option input")
        .forEach((input) => {
            if (input.checked) ids.push(parseInt(input.name));
        });

    setIngredientsRecipes(ids);
});

async function setIngredientsRecipes(ids) {
    let recipes = filterrecipes.querySelectorAll("a");
    recipes.forEach((recipe) => recipe.remove());

    filtereds = [];
    await getIngredientRecipes(ids);
    if (filtereds) {
        filtereds.forEach((post) => createRecipe(post));
    }
}

async function getIngredientRecipes(ids) {
    const response = await fetch(
        "http://api.talkandeat.es/api/recipesIngredients?ingredients=" +
            JSON.stringify(ids)
    );
    const data = await response.json();
    if (!data["code"]) {
        divError.style.display = "none";
        divSuccess.style.display = "block";
        let text = divSuccess.querySelector("h2");
        text.textContent = "Hay " + data.length + " resultados :)";
        data.forEach((post) => {
            filtereds.push(post);
        });
    } else {
        divError.style.display = "block";
        divSuccess.style.display = "none";
    }
}

async function setRecipes(search) {
    let recipes = filterrecipes.querySelectorAll("a");
    recipes.forEach((recipe) => recipe.remove());

    filtereds = [];
    await getFilteredRecipes(search);
    if (filtereds) {
        filtereds.forEach((post) => createRecipe(post));
    }
}

async function getFilteredRecipes(search) {
    const response = await fetch(
        "http://api.talkandeat.es/api/posts?dificultad=" + search
    );
    const data = await response.json();
    if (!data["code"]) {
        divError.style.display = "none";
        divSuccess.style.display = "block";
        let text = divSuccess.querySelector("h2");
        text.textContent = "Hay " + data.length + " resultados :)";
        data.forEach((post) => {
            filtereds.push(post);
        });
    } else {
        divError.style.display = "block";
        divSuccess.style.display = "none";
    }
}

function createRecipe(recipe) {
    const object = document.createElement("a");
    object.className =
        "col-12 col-sm-6 col-md-6 col-lg-4 d-flex mb-3 justify-content-center";
    object.href = "explore/" + recipe["ID_publicacion"];

    let div = document.createElement("div");
    div.className = "object01";
    if (recipe["imagen"]) div.style.backgroundImage = "url('img/buffins.jpg')";
    else div.style.backgroundImage = "url('img/no-image-0.png')";

    let h3 = document.createElement("h3");
    h3.textContent = recipe["titulo"];
    let h4 = document.createElement("h4");
    h4.textContent = recipe["dificultad"];

    div.append(h3);
    div.append(h4);

    let h42 = document.createElement("h4");
    h42.className = "likes";
    h42.textContent = recipe["likes"] + " likes";
    div.append(h42);

    object.append(div);

    explorerecipes.append(object);
}
