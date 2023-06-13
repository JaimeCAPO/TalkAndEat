const admin= document.querySelector('.admin-screen');
const users= admin.querySelector('.admin-users table tbody');
const posts= admin.querySelector('.admin-posts table tbody');
const log= admin.querySelector('.admin-visualizer .console');

const usersList=[];
const postsList=[];

setUsers();
setPosts();
async function setUsers() {
    await getUsers();
    console.log(usersList);
    
    usersList.forEach(user => {
      const tr = document.createElement('tr');
      tr.className = 'user';
      
      let td = document.createElement('td');
      td.className = 'id';
      td.textContent = '#' + user['id'];
      
      let td2 = document.createElement('td');
      td2.className = 'username';
      td2.textContent = '@' + user['username'];
      
      let td3 = document.createElement('td');
      td3.className = 'email';
      td3.textContent = user['email'];
      
      let td4 = document.createElement('td');
      td4.className = 'posts';
      td4.textContent = 4;
      
      let td5 = document.createElement('td');
      td5.className = 'actions';
      
      let a = document.createElement('a');
      a.href = '../users/' + user['id'];
      
      let ishow = document.createElement('i');
      ishow.className = 'fa-solid fa-eye';
      
      a.append(ishow);
      
      let idelete = document.createElement('i');
      idelete.className = 'fa-solid fa-trash';
      
      td5.append(a);
      td5.append(idelete);
      
      tr.append(td);
      tr.append(td2);
      tr.append(td3);
      tr.append(td4);
      tr.append(td5);
      
      users.append(tr);
    });
  }
  
  async function getUsers() {
    const response = await fetch('http://api.talkandeat.es/api/users');
    const data = await response.json();
    
    data.forEach(user => {
      let object = {
        id: user['ID_usuario'],
        username: user['nombre'],
        email: user['correo_electronico'],
      };
      
      usersList.push(object);
    });
  }

  async function setPosts() {
    await getPosts();
    console.log(postsList);
    
    postsList.forEach(post => {
      const tr = document.createElement('tr');
      tr.className = 'post';
      
      let td = document.createElement('td');
      td.className = 'id';
      td.textContent = '#' + post['id'];
      
      let td2 = document.createElement('td');
      td2.className = 'id_user';
      td2.textContent = '#' + post['user'];
      
      let td3 = document.createElement('td');
      td3.className = 'title';
      td3.textContent = post['title'];
      
      let td4 = document.createElement('td');
      td4.className = 'dificult';
      td4.textContent = post['dificult'];
      
      let td5 = document.createElement('td');
      td5.className = 'comments';
      td5.textContent = post['comments'];
      
      let td6 = document.createElement('td');
      td6.className = 'steps';
      td6.textContent = post['steps'];
      
      let td7 = document.createElement('td');
      td7.className = 'ingredients';
      td7.textContent = post['ingredients'];

      let td8 = document.createElement('td');
      td8.className = 'actions';
      
      let a = document.createElement('a');
      a.href = '../posts/' + post['id'];
      
      let ishow = document.createElement('i');
      ishow.className = 'fa-solid fa-eye';
      
      a.append(ishow);
      
      let idelete = document.createElement('i');
      idelete.className = 'fa-solid fa-trash';
      
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
    const response = await fetch('http://api.talkandeat.es/api/posts');
    const data = await response.json();
    
    data.forEach(post => {
      let object = {
        id: post['ID_publicacion'],
        user: post['ID_usuario'],
        title: post['titulo'],
        dificult: post['dificultad'],
        comments: post['comentarios'].length,
        steps: post['pasos'].length,
        ingredients: post['ingredientes'].length,

      };
      
      postsList.push(object);
    });
  }