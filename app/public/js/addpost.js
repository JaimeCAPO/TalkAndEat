const img = document.getElementById("image");
const id = document.getElementById("id");
const title = document.getElementById("title");
const time = document.getElementById("time");
const dificultad = document.getElementById("dificultad");
const summary = document.getElementById("summary");

const btnSend = document.querySelector(".post-receta .btn-post-receta");
let stepslist = [];
let ingredientslist = [];

btnSend.addEventListener("click", function (e) {
    e.preventDefault();
    send();
});

async function send() {
    const divsstep = document.querySelectorAll(".new-step");
    const divsingre = document.querySelectorAll(".new-ingredient");

    if (divsingre) {
        ingredientslist = await getValuesIngre(divsingre);
    }
    if (divsstep) {
        stepslist = await getValuesSteps(divsstep);
    }

    const formData = {
        ID_usuario: id.value,
        imagen: img.value ? img.value : null,
        titulo: title.value,
        duracion: time.value,
        dificultad: dificultad.value,
        descripcion: summary.value,
        ingredientes: ingredientslist, // Agregar el array de ingredientes
        pasos: stepslist,
    };
    console.log(formData);
    post(formData);
}

function getValuesSteps(divsstep) {
    list = [];
    divsstep.forEach((div, index) => {
        let texto = div.querySelector("#step-description").value;
        let orden = index + 1;
        step = {
            orden: orden,
            texto: texto,
        };
        list.push(step);
    });
    return list;
}

function getValuesIngre(divsingre) {
    list = [];
    divsingre.forEach((div, index) => {
        let ingredient = div.querySelector("#ingredient").value;
        let cantidad = div.querySelector("#cantidad").value;
        let unidad = div.querySelector("#unidad").value;
        object = {
            nombre: ingredient,
            cantidad: cantidad,
            unidad: unidad,
        };
        list.push(object);
    });
    return list;
}

function post(data) {
    const url = "https://api.talkandeat.es/api/post";

    const options = {
        method: "POST",
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
            document.querySelector("form").submit();
        })
        .catch((error) => {
            // Manejo de errores
            console.error("Error:", error);
        });
}
