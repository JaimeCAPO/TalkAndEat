const admin = document.querySelector(".admin-screen");
const users = admin.querySelector(".admin-users table tbody");
const posts = admin.querySelector(".admin-posts table tbody");
const log = admin.querySelector(".admin-visualizer .console");
const btnClean = document.querySelector(".admin-screen .btn-clean");

const usersList = [];
const postsList = [];
let logsList = [];

setUsers();
setPosts();
setLogs();

btnClean.addEventListener("click", function (e) {
    e.preventDefault();
    deleteLogs();
    while (log.firstChild) {
        log.removeChild(log.firstChild);
    }
});
async function setUsers() {
    await getUsers();
    usersList.forEach((user) => {
        const tr = document.createElement("tr");
        tr.className = "user";

        let td = document.createElement("td");
        td.className = "id";
        td.textContent = "#" + user["id"];

        let td2 = document.createElement("td");
        td2.className = "username";
        td2.textContent = "@" + user["username"];

        let td3 = document.createElement("td");
        td3.className = "email";
        td3.textContent = user["email"];

        let td4 = document.createElement("td");
        td4.className = "posts";
        td4.textContent = 4;

        let td5 = document.createElement("td");
        td5.className = "actions";

        let a = document.createElement("a");
        a.href = "../user/" + user["id"];

        let ishow = document.createElement("i");
        ishow.className = "fa-solid fa-eye";

        a.append(ishow);

        let idelete = document.createElement("i");
        idelete.className = "fa-solid fa-trash";

        idelete.addEventListener("click", function () {
            deleteEntry(user["id"]);
            tr.remove();
        });

        td5.append(a);
        if (user["username"] != "admin") td5.append(idelete);

        tr.append(td);
        tr.append(td2);
        tr.append(td3);
        tr.append(td4);
        tr.append(td5);

        users.append(tr);
    });
}

async function getUsers() {
    const response = await fetch("http://api.talkandeat.es/api/users");
    const data = await response.json();

    data.forEach((user) => {
        let object = {
            id: user["ID_usuario"],
            username: user["nombre"],
            email: user["correo_electronico"],
        };

        usersList.push(object);
    });
}

async function setPosts() {
    await getPosts();
    postsList.forEach((post) => {
        const tr = document.createElement("tr");
        tr.className = "post";

        let td = document.createElement("td");
        td.className = "id";
        td.textContent = "#" + post["id"];

        let td2 = document.createElement("td");
        td2.className = "id_user";
        td2.textContent = "#" + post["user"];

        let td3 = document.createElement("td");
        td3.className = "title";
        td3.textContent = post["title"];

        let td4 = document.createElement("td");
        td4.className = "dificult";
        td4.textContent = post["dificult"];

        let td5 = document.createElement("td");
        td5.className = "comments";
        td5.textContent = post["comments"];

        let td6 = document.createElement("td");
        td6.className = "steps";
        td6.textContent = post["steps"];

        let td7 = document.createElement("td");
        td7.className = "ingredients";
        td7.textContent = post["ingredients"];

        let td8 = document.createElement("td");
        td8.className = "actions";

        let a = document.createElement("a");
        a.href = "../post/" + post["id"];

        let ishow = document.createElement("i");
        ishow.className = "fa-solid fa-eye";

        a.append(ishow);

        let idelete = document.createElement("i");
        idelete.className = "fa-solid fa-trash";

        idelete.addEventListener("click", function () {
            deleteEntry(post["id"]);
            tr.remove();
        });

        td8.append(a);
        td8.append(idelete);

        tr.append(td);
        tr.append(td2);
        tr.append(td3);
        tr.append(td4);
        tr.append(td5);
        tr.append(td6);
        tr.append(td7);
        tr.append(td8);

        posts.append(tr);
    });
}

async function getPosts() {
    const response = await fetch("http://api.talkandeat.es/api/posts");
    const data = await response.json();

    data.forEach((post) => {
        let object = {
            id: post["ID_publicacion"],
            user: post["ID_usuario"],
            title: post["titulo"],
            dificult: post["dificultad"],
            comments: post["comentarios"].length,
            steps: post["pasos"].length,
            ingredients: post["ingredientes"].length,
        };

        postsList.push(object);
    });
}

async function getLogs() {
    const response = await fetch("http://api.talkandeat.es/api/notifications");
    const data = await response.json();
    console.log(data);
    data.forEach((logEntry) => {
        let usuario = null;
        let usuarioEmisor = null;
        if (logEntry["tipo"] == "delete_post") {
            texto = "Delete a Post";
            usuario = "@" + logEntry["username"];
        } else if (logEntry["tipo"] == "post") {
            texto = "Create a Post";
            usuario = "@" + logEntry["username"];
        } else if (logEntry["tipo"] == "register") {
            texto = "Registered";
            usuario = "@" + logEntry["username"];
        } else if (logEntry["tipo"] == "comment") {
            texto = "comment in a post by";
            usuario = "@" + logEntry["username_emisor"];
            usuarioEmisor = "@" + logEntry["username"];
        } else if (logEntry["tipo"] == "follow") {
            texto = "start following";
            usuario = "@" + logEntry["username_emisor"];
            usuarioEmisor = "@" + logEntry["username"];
        } else if (logEntry["tipo"] == "like") {
            texto = "liked a post by";
            usuario = "@" + logEntry["username_emisor"];
            usuarioEmisor = "@" + logEntry["username"];
        } else {
            texto = "stop following";
            usuario = "@" + logEntry["username_emisor"];
            usuarioEmisor = "@" + logEntry["username"];
        }

        let object = {
            id: logEntry["ID_notificacion"],
            time: logEntry["fecha"],
            user: usuario,
            user_emisor: usuarioEmisor,
            msg: texto,
        };

        logsList.push(object);
    });
}

async function setLogs() {
    logsList = [];
    await getLogs();
    logsList.forEach((logEntry) => {
        const div = document.createElement("div");
        div.className = "msg d-flex gap-2";
        const p1 = document.createElement("p");
        p1.className = "time";
        p1.textContent = "[" + logEntry["time"] + "]";

        const p2 = document.createElement("p");
        p2.className = "command";
        p2.textContent = logEntry["msg"];

        const p3 = document.createElement("p");
        p3.className = "person";
        p3.textContent = logEntry["user"];

        const p4 = document.createElement("p");
        p4.className = "objective";
        p4.textContent = logEntry["user_emisor"];

        div.append(p1);
        div.append(p3);
        div.append(p2);
        div.append(p4);

        log.append(div);
    });
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

function deleteUser(id) {
    const url = "https://api.talkandeat.es/api/deleteUser";
    data = { ID_usuario: id };
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
async function getuser(id) {
    const response = await fetch("http://api.talkandeat.es/api/users?id=" + id);
    const data = await response.json();
    if (!data["code"]) {
        return data["nombre"];
    }
}

async function deleteLogs() {
    const url = "https://api.talkandeat.es/api/allnotifications";
    data = {};
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
