const newpost = document.querySelector(".post-receta");

const listaingredients = newpost.querySelector(".receta-ingredients .lista");
const listaElaboracion = newpost.querySelector(".receta-elaboration");

const btnStep = newpost.querySelector(".btn-new-step");
const btnIngredient = newpost.querySelector(".btn-new-ingredient");
console.log(btnIngredient);
console.log(btnStep);

const ingredients = [];
getIngredients();

btnIngredient.addEventListener("click", function (e) {
    e.preventDefault();
    createIngredient();
});

btnStep.addEventListener("click", function (e) {
    e.preventDefault();
    createStep();
});

function createIngredient() {
    const divIngredient = document.createElement("div");
    divIngredient.className = "new-ingredient row mb-2";

    const div1 = document.createElement("div");
    div1.className = "col-12 col-lg-6";

    const select = document.createElement("select");
    select.className = "form-select";
    select.name = "ingredient";
    select.id = "ingredient";

    ingredients.forEach((ingredient) => {
        let option = document.createElement("option");
        option.value = ingredient["nombre"];
        option.textContent = ingredient["nombre"];
        select.append(option);
    });
    div1.append(select);

    const div2 = document.createElement("div");
    div2.className = "col-6 col-lg-3";

    const labelcant = document.createElement("label");
    labelcant.className = "form-label";
    labelcant.htmlFor = "cantidad";
    labelcant.textContent = "Cantidad:";

    const inputcant = document.createElement("input");
    inputcant.className = "form-control";
    inputcant.type = "number";
    inputcant.name = "cantidad";
    inputcant.required = "true";
    inputcant.id = "cantidad";

    div2.append(labelcant);
    div2.append(inputcant);

    const div3 = document.createElement("div");
    div3.className = "col-6 col-lg-3";

    const labelunidad = document.createElement("label");
    labelunidad.className = "form-label";
    labelunidad.htmlFor = "unidad";
    labelunidad.textContent = "Unidad:";

    const inputunidad = document.createElement("input");
    inputunidad.className = "form-control";
    inputunidad.type = "text";
    inputunidad.name = "unidad";
    inputunidad.required = "true";
    inputunidad.id = "unidad";

    div3.append(labelunidad);
    div3.append(inputunidad);

    divIngredient.append(div1);
    divIngredient.append(div2);
    divIngredient.append(div3);

    const idelete = document.createElement("i");
    idelete.className = "fa-solid fa-circle-xmark btn-delete-ingredient";
    idelete.addEventListener("click", function (e) {
        divIngredient.remove();
    });
    divIngredient.append(idelete);

    listaingredients.append(divIngredient);
}

function createStep() {
    let div = document.createElement("div");
    div.className = "new-step";
    let textarea = document.createElement("textarea");
    textarea.className = "form-control";
    textarea.name = "step-description";
    textarea.id = "step-description";
    textarea.cols = "30";
    textarea.rows = "1";
    textarea.required = "true";

    let idelete = document.createElement("i");
    idelete.className = "fa-solid fa-circle-xmark btn-delete-ingredient";
    idelete.addEventListener("click", function (e) {
        div.remove();
    });

    div.append(textarea);
    div.append(idelete);
    listaElaboracion.append(div);
}

function getIngredients() {
    fetch("http://api.talkandeat.es/api/ingredients")
        .then((response) => response.json())
        .then((data) =>
            data.forEach((ing) => {
                ingredients.push({
                    nombre: ing["nombre"],
                    ID_ingrediente: ing["ID_ingrediente"],
                });
            })
        );
}
