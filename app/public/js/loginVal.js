const loginScreen = document.querySelector(".login-screen");
const username = loginScreen.querySelector("#username");
const passwd = loginScreen.querySelector("#passwd");
const btnLogin = loginScreen.querySelector(".btn-login");
const errorusername = loginScreen.querySelector(".error.username");
const errorpasswd = loginScreen.querySelector(".error.passwd");

btnLogin.addEventListener("click", function (e) {
    e.preventDefault();
    let complete = true;
    if (!username.value) {
        errorusername.style.opacity = 1;
        username.style.border = "1px solid var(--login-screen-error)";
        complete = false;
    } else {
        username.style.border = "1px solid var(--login-screen-color-input)";
        errorusername.style.opacity = 0;
    }

    if (!passwd.value) {
        errorpasswd.style.opacity = 1;
        complete = false;
        passwd.style.border = "1px solid var(--login-screen-error)";
    } else {
        errorpasswd.style.opacity = 0;
        passwd.style.border = "1px solid var(--login-screen-color-input)";
    }
    if (complete)
        fetch("https://api.talkandeat.es/api/users?username=" + username.value)
            .then((response) => response.json())
            .then((data) => {
                if (data["msg"]) {
                    errorusername.textContent = "* Invalid username*";
                    errorusername.style.opacity = 1;
                    username.style.border =
                        "1px solid var(--login-screen-error)";
                } else {
                    enviar_formulario();
                }
            });
});
function enviar_formulario() {
    let formulario = loginScreen.querySelector("form");
    formulario.submit();
}
