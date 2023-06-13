const explore = document.querySelector(".explore-screen");
const explorerecipes = explore.querySelector(".explore-screen-recipes");
const exploreingredients = explore.querySelector(
    ".explore-screen-ingredients .row"
);
setPosts();
setIngredients();
async function setIngredients() {
    fetch("http://api.talkandeat.es/api/ingredients")
        .then((response) => response.json())
        .then((data) => {
            data.forEach((ingredient) => {
                addIngredient(ingredient);
            });
        });
}

async function setPosts() {
    fetch("http://api.talkandeat.es/api/posts")
        .then((response) => response.json())
        .then((data) => {
            if (data.lenght < 1) {
                let msg = explorerecipes.querySelector(".error");
                msg.className = "col-12 d-block error";
            } else {
                let msg = explorerecipes.querySelector(".success");
                let text = msg.querySelector("h2");
                text.textContent = "Hay " + data.length + " resultados :)";

                data.forEach((recipe) => {
                    createRecipe(recipe);
                });
            }
        });
}

function addIngredient(ingredient) {
    const object = document.createElement("div");
    object.className = "col-12 col-lg-6 ingredient-option";
    let input = document.createElement("input");
    input.type = "checkbox";
    input.name = ingredient["ID_ingrediente"];
    input.id = ingredient["nombre"];
    input.className = "form-check-inline";

    let label = document.createElement("label");
    label.htmlFor = ingredient["nombre"];
    label.textContent = ingredient["nombre"];
    label.className = "form-label";

    object.append(input);
    object.append(label);

    exploreingredients.append(object);
}
