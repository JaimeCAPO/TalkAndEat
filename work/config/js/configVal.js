const configScreen=document.querySelector('.config-screen');

const btndelete=configScreen.querySelector(".btn-delete-account");
const chkdelete=document.getElementById("delete");
const optiongeneral= configScreen.querySelector('.list-item.general');
const optionprofile= configScreen.querySelector('.list-item.profile');
const optionhelp= configScreen.querySelector('.list-item.help');


const formprofile= configScreen.querySelector('.form-profile');
const formgeneral= configScreen.querySelector('.form-general');
const formhelp= configScreen.querySelector('.form-help');
const formdelete= configScreen.querySelector('.form-delete');
formprofile.style.display='none';
formdelete.style.display='none';
formhelp.style.display='none';

document.addEventListener('click',function(e){
    if(chkdelete.checked) btndelete.classList.remove("disabled");
    else   btndelete.classList.add("disabled"); 
});

optiongeneral.addEventListener('click',function(e){
    formprofile.style.display='none';
    formdelete.style.display='none';
    formhelp.style.display='none';
    formgeneral.style.display='block';

    if(optiongeneral.className!='list-item general active')
    {
        optiongeneral.className='list-item general active'; 
        optionprofile.className='list-item profile';
        optionhelp.className='list-item help';
    }
})

optionhelp.addEventListener('click',function(e){
    formprofile.style.display='none';
    formdelete.style.display='none';
    formhelp.style.display='block';
    formgeneral.style.display='none';

    if(!optionhelp.className!='list-item help active')
    {
        optionhelp.className='list-item help active'; 
        optionprofile.className='list-item profile';
        optiongeneral.className='list-item general';
    }
})

optionprofile.addEventListener('click',function(e){
    formprofile.style.display='block';
    formdelete.style.display='block';
    formhelp.style.display='none';
    formgeneral.style.display='none';

    if(!optionprofile.className!='list-item profile active')
    {
        optionprofile.className='list-item profile active'; 
        optiongeneral.className='list-item general';
        optionhelp.className='list-item help';
    }
})