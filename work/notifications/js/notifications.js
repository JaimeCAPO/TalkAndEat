const notificationsScreen=document.querySelector('.notifications-screen');
const noNotifications=notificationsScreen.querySelector('.no-notifications');
const notifications=notificationsScreen.querySelector('.notifications > div');
const notis=[];

setNotifications();

async function setNotifications(){
    notis.forEach(noti=>noti.remove());

    await getNotifications();
    console.log(notis);
    if(notis){
        notis.forEach(notification=>createNotification(notification));
    }
}

async function getNotifications(){
    const response = await fetch('http://api.talkandeat.es/api/notificationsBy?id=');
    const data = await response.json();
    if(!data['code']){
        noNotifications.style.display='none'; 
        data.forEach(post => {  
            notis.push(post);
            
          });    
    }else{
        noNotifications.style.display='flex'; 
    }
}

async function createNotification(object){
    
    const a = document.createElement('a');
    if(object['objetivo_post']){
        a.href="../post/"+object['objetivo_post'];
    }else if(object['emisor']){
        a.href="../user/"+object['emisor'];
    }else{
        a.href="../account";
    }
    a.className=" notification row p-4 mb-4 align-items-center";
    const ptime=document.createElement('p');
    ptime.className="time col-4";
    ptime.textContent="["+object['fecha']+"]";
    const pinfo=document.createElement('p');
    pinfo.className="info col-7";
    if(object['tipo']=="post") pinfo.textContent="Post creation success"; 
    else if(object['tipo']=="delete_post")pinfo.textContent="Post creation success";
    else if(object['tipo']=="register")pinfo.textContent="Welcome to TalkAndEat :)";
    else if(object['tipo']=="comment"){
        let user= await getuser(object[emisor]);
        pinfo.textContent='@'+user['nombre']+ " comment you in a post";
    }
    else if(object['tipo']=="follow"){
        let user= await getuser(object[emisor]);
        pinfo.textContent='@'+user['nombre']+ " follows you";
    }
    else if(object['tipo']=="like"){
        let user= await getuser(object[emisor]);
        pinfo.textContent='@'+user['nombre']+ " liked you in a post";
    }


    const btndelete=document.createElement('btn');
    btndelete.className="btn btn-close col-1"; 
    a.append(ptime);
    a.append(pinfo);
    a.append(btndelete);
    notifications.append(a);
}

async function getuser(id){
    const response = await fetch('http://api.talkandeat.es/api/posts?id='+id);
    const data = await response.json();
    if(!data['code']){
        return data; 
    }
}