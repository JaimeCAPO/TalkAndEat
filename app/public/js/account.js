const accountProfile = document.querySelector(".account-screen-profile");
const accountPosts = document.querySelector(".account-screen-postcollection");
const id = accountProfile.querySelector(".id").textContent;

getOwnPosts();

async function getOwnPosts() {
    try {
        const response = await fetch(
            `http://api.talkandeat.es/api/postsBy?id=${id}`
        );
        const data = await response.json();

        if (!data.msg) {
            data.forEach((recipe) => {
                createRecipe(recipe);
            });
        }
    } catch (error) {
        console.error("Error:", error);
    }
}

function createRecipe(recipe) {
    const url = window.location.pathname;
    const object = document.createElement("a");
    object.className =
        "account-screen-post col-12 col-md-6 col-lg-4 col-xl-3 mt-3";
    object.href = url.includes("user")
        ? `../post/${recipe.ID_publicacion}`
        : `post/${recipe.ID_publicacion}`;

    const div = document.createElement("div");
    div.className = "object01";
    div.style.backgroundImage = recipe.imagen
        ? url.includes("user")
            ? "url('../img/buffins.jpg')"
            : "url('img/buffins.jpg')"
        : url.includes("user")
        ? "url('../img/no-image-0.png')"
        : "url('img/no-image-0.png')";

    const h3 = document.createElement("h3");
    h3.textContent = recipe.titulo;
    const h4 = document.createElement("h4");
    h4.textContent = recipe.dificultad;

    if (url.includes("account")) {
        const btndelete = document.createElement("button");
        btndelete.className = "btn btn-delete btn-delete-recipe";
        btndelete.textContent = "X";
        btndelete.addEventListener("click", function (e) {
            e.preventDefault();
            deleteEntry(recipe.ID_publicacion);
            object.remove();
        });

        div.append(btndelete);
    }

    let h42 = document.createElement("h4");
    h42.className = "likes";
    h42.textContent = recipe["likes"] + " likes";
    div.append(h42);

    div.append(h3);
    div.append(h4);
    object.append(div);

    accountPosts.append(object);
}

function deleteEntry(id) {
    const url = "https://api.talkandeat.es/api/deletePost";
    data = { ID_publicacion: id };
    const options = {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    };

    fetch(url, options)
        .then((response) => response.json())
        .then((data) => {
            // Aquí puedes manejar la respuesta del API
            console.log(data);
        })
        .catch((error) => {
            // Manejo de errores
            console.error("Error:", error);
        });
}
