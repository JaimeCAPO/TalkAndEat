alertContent= document.querySelector('.register-success-alert > div');
if(alertContent){
    alertContent.parentElement.addEventListener("click",function(){ 
        alertContent.parentElement.className="register-success-alert register-success-alert-delete";
    });
}


alertPostContent= document.querySelector('.post-success-alert > div');
if(alertPostContent){
    alertPostContent.parentElement.addEventListener("click",function(){ 
        alertPostContent.parentElement.className="post-success-alert post-success-alert-delete";
    });
}
