const find = document.querySelector(".explore-screen");
const findrecipes = find.querySelector(".explore-screen-recipes");
const input = find.querySelector(".explore-screen-explorebar input");
const divError = find.querySelector(".explore-screen-recipes .error");
const divSuccess = find.querySelector(".explore-screen-recipes .success");
const btn = find.querySelector(".explore-screen-explorebar button");
let users = [];
let posts = [];

btn.addEventListener("click", function (e) {
    e.preventDefault();
    let busqueda = input.value;

    let recipes = findrecipes.querySelectorAll("a");
    recipes.forEach((recipe) => recipe.remove());

    if (busqueda != null && busqueda.startsWith("@")) {
        setUsers(busqueda.substring(busqueda.indexOf("@") + 1));
    } else if (busqueda != null && busqueda != "") {
        setRecipes(busqueda);
    } else {
        setAllRecipes();
    }
});

async function setUsers(search) {
    users = [];
    await getUsers(search);
    if (users) {
        users.forEach((user) => createUser(user));
    }
}

async function setRecipes(search) {
    posts = [];
    await getRecipes(search);
    if (posts) {
        posts.forEach((post) => createRecipe(post));
    }
}

async function setAllRecipes() {
    posts = [];
    await getAllRecipes();
    if (posts) {
        posts.forEach((post) => createRecipe(post));
    }
}

async function getUsers(search) {
    const response = await fetch(
        "http://api.talkandeat.es/api/userswith?search=" + search
    );
    const data = await response.json();
    if (!data["code"]) {
        divError.style.display = "none";
        divSuccess.style.display = "block";
        let text = divSuccess.querySelector("h2");
        text.textContent = "Hay " + data.length + " resultados :)";
        data.forEach((user) => {
            users.push(user);
        });
    } else {
        divError.style.display = "block";
        divSuccess.style.display = "none";
    }
}

async function getRecipes(search) {
    const response = await fetch(
        "http://api.talkandeat.es/api/postswith?search=" + search
    );
    const data = await response.json();
    if (!data["code"]) {
        divError.style.display = "none";
        divSuccess.style.display = "block";
        let text = divSuccess.querySelector("h2");
        text.textContent = "Hay " + data.length + " resultados :)";
        data.forEach((post) => {
            posts.push(post);
        });
    } else {
        divError.style.display = "block";
        divSuccess.style.display = "none";
    }
}

async function getAllRecipes() {
    const response = await fetch("http://api.talkandeat.es/api/posts");
    const data = await response.json();
    if (!data["code"]) {
        divError.style.display = "none";
        divSuccess.style.display = "block";
        let text = divSuccess.querySelector("h2");
        text.textContent = "Hay " + data.length + " resultados :)";
        data.forEach((post) => {
            posts.push(post);
        });
    } else {
        divError.style.display = "block";
        divSuccess.style.display = "none";
    }
}

function createUser(user) {
    const object = document.createElement("a");
    object.className =
        "col-12 col-sm-6 col-md-6 col-lg-4 d-flex mb-3 justify-content-center";
    object.href = "user/" + user["ID_usuario"];

    let div = document.createElement("div");
    div.className = "object01";

    if (user["foto_perfil"])
        div.style.backgroundImage = "url('img/buffins.jpg')";
    else div.style.backgroundImage = "url('img/no-profile.png')";

    let h3 = document.createElement("h3");
    h3.textContent = "@" + user["nombre"];

    div.append(h3);
    object.append(div);

    findrecipes.append(object);
}
