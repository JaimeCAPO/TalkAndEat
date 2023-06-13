const configScreen = document.querySelector(".config-screen");

const btndelete = configScreen.querySelector(".btn-delete-account");
const chkdelete = document.getElementById("delete");
const optiongeneral = configScreen.querySelector(".list-item.general");
const optionprofile = configScreen.querySelector(".list-item.profile");
const optionhelp = configScreen.querySelector(".list-item.help");

const formprofile = configScreen.querySelector(".form-profile");
const formgeneral = configScreen.querySelector(".form-general");
const formhelp = configScreen.querySelector(".form-help");
const formdelete = configScreen.querySelector(".form-delete");
formprofile.style.display = "none";
formdelete.style.display = "none";
formhelp.style.display = "none";

const iUsername = document.getElementById("username");
const btnSave = configScreen.querySelector(".btn-save");
const formUpdate = configScreen.querySelector(".form-update");

chkdelete.addEventListener("click", function (e) {
    if (chkdelete.checked) btndelete.classList.remove("disabled");
    else btndelete.classList.add("disabled");
});

btnSave.addEventListener("click", function (e) {
    if (iUsername.value != "" && iUsername.value) {
        e.preventDefault();
        fetch("https://api.talkandeat.es/api/users?username=" + iUsername.value)
            .then((response) => response.json())
            .then((data) => {
                if (data["msg"]) {
                    enviar_formulario();
                } else {
                    iUsername.style.border = "1px solid red";
                }
            });
    }
});

function enviar_formulario() {
    const formUpdate = configScreen.querySelector(".form-update");
    formUpdate.submit();
}

optiongeneral.addEventListener("click", function (e) {
    formprofile.style.display = "none";
    formdelete.style.display = "none";
    formhelp.style.display = "none";
    formgeneral.style.display = "block";

    if (optiongeneral.className != "list-item general active") {
        optiongeneral.className = "list-item general active";
        optionprofile.className = "list-item profile";
        optionhelp.className = "list-item help";
    }
});

optionhelp.addEventListener("click", function (e) {
    formprofile.style.display = "none";
    formdelete.style.display = "none";
    formhelp.style.display = "block";
    formgeneral.style.display = "none";

    if (!optionhelp.className != "list-item help active") {
        optionhelp.className = "list-item help active";
        optionprofile.className = "list-item profile";
        optiongeneral.className = "list-item general";
    }
});

optionprofile.addEventListener("click", function (e) {
    formprofile.style.display = "block";
    formdelete.style.display = "block";
    formhelp.style.display = "none";
    formgeneral.style.display = "none";

    if (!optionprofile.className != "list-item profile active") {
        optionprofile.className = "list-item profile active";
        optiongeneral.className = "list-item general";
        optionhelp.className = "list-item help";
    }
});
