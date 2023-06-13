const notificationsScreen = document.querySelector(".notifications-screen");
const noNotifications = notificationsScreen.querySelector(".no-notifications");
const notifications = notificationsScreen.querySelector(".notifications > div");
let id = document.getElementById("id").textContent;

const notis = [];

setNotifications();

async function setNotifications() {
    notis.forEach((noti) => noti.remove());

    await getNotifications();
    console.log(notis);
    if (notis) {
        notis.forEach((notification) => createNotification(notification));
    }
}

async function getNotifications() {
    const response = await fetch(
        "http://api.talkandeat.es/api/notificationsBy?id=" + id
    );
    const data = await response.json();
    if (!data["code"]) {
        noNotifications.style.display = "none";
        data.forEach((post) => {
            notis.push(post);
        });
    } else {
        noNotifications.style.display = "flex";
    }
}

async function createNotification(object) {
    const a = document.createElement("a");
    if (object["objetivo_post"]) {
        a.href = "../post/" + object["objetivo_post"];
    } else if (object["emisor"]) {
        a.href = "../user/" + object["emisor"];
    } else {
        a.href = "../account";
    }
    a.className = " notification row pb-2 pt-4 mb-4 align-items-center";
    const ptime = document.createElement("p");
    ptime.className = "time col-4";
    ptime.textContent = "[" + object["fecha"] + "]";
    const pinfo = document.createElement("p");
    pinfo.className = "info col-7";
    if (object["tipo"] == "post") pinfo.textContent = "Post creation success";
    else if (object["tipo"] == "delete_post")
        pinfo.textContent = "Post deleted";
    else if (object["tipo"] == "register")
        pinfo.textContent = "Welcome to TalkAndEat :)";
    else if (object["tipo"] == "comment") {
        let username = await getuser(object[emisor]);
        pinfo.textContent = "@" + username + " comment you in a post";
    } else if (object["tipo"] == "follow") {
        let username = await getuser(object["emisor"]);
        pinfo.textContent = "@" + username + " follows you";
    } else if (object["tipo"] == "like") {
        let username = await getuser(object["emisor"]);
        pinfo.textContent = "@" + username + " liked you in a post";
    }

    const btndelete = document.createElement("btn");
    btndelete.className = "btn btn-close col-1";

    btndelete.addEventListener("click", function (e) {
        e.preventDefault();
        hideNotification(object["ID_notificacion"]);
        a.remove();
        if (!notis) noNotifications.style.display = "flex";
    });

    a.append(ptime);
    a.append(pinfo);
    a.append(btndelete);
    notifications.append(a);
}

async function hideNotification(id) {
    let body = {
        ID_notificacion: id,
    };
    const requestOptions = {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(body),
    };

    // Realizar la solicitud POST
    fetch("https://api.talkandeat.es/api/hidenotification", requestOptions)
        .then((response) => response.json())
        .then((data) => {
            // Manipular la respuesta de la API
            console.log("Respuesta de la API:", data);
            notis.pop();
        })
        .catch((error) => {
            // Manejar errores de la solicitud
            console.error("Error en la solicitud:", error);
        });
}

async function getuser(id) {
    const response = await fetch("http://api.talkandeat.es/api/users?id=" + id);
    const data = await response.json();
    if (!data["code"]) {
        return data["nombre"];
    }
}
