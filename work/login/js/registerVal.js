const registerScreen= document.querySelector('.register-screen');
const username=registerScreen.querySelector('#username');
const email=registerScreen.querySelector('#email');
const passwd=registerScreen.querySelector('#passwd');
const passwdagain=registerScreen.querySelector('#passwdagain');
const btnRegister=registerScreen.querySelector('.btn-register');
const errorusername=registerScreen.querySelector('.error.username');
const errorpasswd=registerScreen.querySelector('.error.passwd');
const erroremail=registerScreen.querySelector('.error.email');
const errorpasswdagain=registerScreen.querySelector('.error.passwdagain');

const emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;


btnRegister.addEventListener('click',function(e){
    e.preventDefault();
    let complete=true;
    if(!username.value){
        errorusername.style.opacity=1;
        username.style.border='1px solid var(--register-screen-error)'; 
        complete=false;
    }else {
        errorusername.style.opacity=0; 
        passwd.style.border='1px solid var(--register-screen-color-input)'; 

    }

    if(!email.value){
        erroremail.style.opacity=1;
        email.style.border='1px solid var(--register-screen-error)'; 
    }else {
        if (emailRegex.test(email.value)) {

        erroremail.style.opacity=0; 
        email.style.border='1px solid var(--register-screen-color-input)'; 
        }else{
            erroremail.textContent="* email format expected *"
            erroremail.style.opacity=1;
            email.style.border='1px solid var(--register-screen-error)'; 
            complete=false;

        }
    }

    if(!passwd.value){
        errorpasswd.style.opacity=1; 
        complete=false;
        passwd.style.border='1px solid var(--register-screen-error)'; 
    }else {
        errorpasswd.style.opacity=0; 
        passwd.style.border='1px solid var(--register-screen-color-input)'; 
    }

    if(!passwdagain.value || passwdagain.value!=passwd.value){
        errorpasswdagain.style.opacity=1; 
        complete=false;
        passwdagain.style.border='1px solid var(--register-screen-error)'; 
    }else {
        errorpasswdagain.style.opacity=0; 
        passwdagain.style.border='1px solid var(--register-screen-color-input)'; 
    }

    if(complete) {
        enviar_formulario();
    }

})

async function enviar_formulario() {
    able=true;
    await fetch('https://api.talkandeat.es/api/users?username='+username.value).then(response=> response.json()).then(data=>{
        if(!data['msg']){
            errorusername.textContent="* Already used *"
            errorusername.style.opacity=1;
            username.style.border='1px solid var(--register-screen-error)'; 
            able=false;
        }
    });

    await fetch('https://api.talkandeat.es/api/users?email='+email.value).then(response=> response.json()).then(data=>{
        if(!data['msg']){
            erroremail.textContent="* Already used *"
            erroremail.style.opacity=1;
            email.style.border='1px solid var(--register-screen-error)'; 
            able=false;

        }
    });
    if(able){
        let formulario = registerScreen.querySelector('form');
        formulario.submit();
    }

}