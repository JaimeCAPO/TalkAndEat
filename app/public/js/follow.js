const followScreen = document.querySelector(".account-screen-profile");
const modal = document.querySelector(".follows-screen.modal-mask");
const btnsfollow = followScreen.querySelectorAll(".account-screen-follows h3");
const btnclose = modal.querySelector(".btn-close");
const idfollow = followScreen.querySelector(".id").textContent;

const btnfollows = modal.querySelector(".btn.follows");
const btnfollowers = modal.querySelector(".btn.followers");
const modalusers = modal.querySelector(".userslist");

let url = window.location.pathname;

console.log(btnfollows);
console.log(btnfollowers);

btnsfollow.forEach((btn) => {
    btn.addEventListener("click", function (e) {
        modal.style.display = "flex";
    });
});

btnclose.addEventListener("click", function (e) {
    modal.style.display = "none";
});

btnfollowers.addEventListener("click", function () {
    btnfollowers.classList.add("active");
    btnfollows.classList.remove("active");
    while (modalusers.firstChild) {
        modalusers.removeChild(modalusers.firstChild);
    }
    fetch("https://api.talkandeat.es/api/followers?id=" + idfollow)
        .then((response) => response.json())
        .then((data) =>
            data.forEach((follower) => {
                let a = document.createElement("a");
                a.className = "col-12 col-md-6 d-flex mb-2 gap-2";

                if (url.includes("user"))
                    a.href = "../../user/" + follower["ID_usuario"];
                else if (url.includes("account"))
                    a.href = "../user/" + follower["ID_usuario"];

                let pid = document.createElement("p");
                pid.textContent = "#" + follower["ID_usuario"];
                let pusername = document.createElement("p");
                pusername.textContent = "@" + follower["nombre"];

                let btnDeleteFollower = document.createElement("button");
                btnDeleteFollower.className = "btn btn-delete";
                let idelete = document.createElement("i");
                idelete.className = "fa-solid fa-trash";
                btnDeleteFollower.append(idelete);

                btnDeleteFollower.addEventListener("click", function (e) {
                    e.preventDefault();

                    let body = {
                        ID_usuario_seguidor: follower["ID_usuario"],
                        ID_usuario_seguido: idfollow,
                    };
                    const requestOptions = {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify(body),
                    };

                    // Realizar la solicitud POST
                    fetch(
                        "https://api.talkandeat.es/api/deleteFollow",
                        requestOptions
                    )
                        .then((response) => response.json())
                        .then((data) => {
                            // Manipular la respuesta de la API
                            console.log("Respuesta de la API:", data);
                            a.remove();
                        })
                        .catch((error) => {
                            // Manejar errores de la solicitud
                            console.error("Error en la solicitud:", error);
                        });
                });

                a.append(pid);
                a.append(pusername);
                if (url.includes("account")) a.append(btnDeleteFollower);

                modalusers.append(a);
            })
        );
});

btnfollows.addEventListener("click", function () {
    btnfollows.classList.add("active");
    btnfollowers.classList.remove("active");
    while (modalusers.firstChild) {
        modalusers.removeChild(modalusers.firstChild);
    }
    fetch("https://api.talkandeat.es/api/follows?id=" + id)
        .then((response) => response.json())
        .then((data) =>
            data.forEach((follower) => {
                let a = document.createElement("a");
                a.className = "col-12 col-md-6 d-flex mb-2 gap-2";

                if (url.includes("user"))
                    a.href = "../../user/" + follower["ID_usuario"];
                else if (url.includes("account"))
                    a.href = "../user/" + follower["ID_usuario"];

                let pid = document.createElement("p");
                pid.textContent = "#" + follower["ID_usuario"];
                let pusername = document.createElement("p");
                pusername.textContent = "@" + follower["nombre"];

                a.append(pid);
                a.append(pusername);
                modalusers.append(a);
            })
        );
});
