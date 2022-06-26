_verifyUser();

window.onload = () => {
  const title = document.querySelector('#title');
  const welcomeMessage = document.querySelector('#welcome-text')
  const profilePic = document.querySelector('#profile-pic');
  const user = JSON.parse(sessionStorage.getItem('user_data'));

  if (title != null)
    title.innerHTML = user.name;

  if (profilePic != null)
    profilePic.setAttribute('src', user.profile_picture ?? `${window.location.origin}/img/profile.png`);

  if (welcomeMessage != null)
    welcomeMessage.innerHTML = `Olá <strong>${user.name}!</strong><br>Bem vindo ao portal <strong>RG Cultural!</strong>`;

}

window.logout = () => {
  fetch('/api/logout',{
    headers: {
      'Authorization': `Bearer ${sessionStorage.getItem('tkn')}`
    }
  }).then(res => res.json())
  .then(res => {
    alert(res.message);
    sessionStorage.clear();
    window.location.replace('/');
  });
}

function _verifyUser() {

  const tkn = sessionStorage.getItem('tkn');// TODO - implementar end-point no servidor para verificar se o token é válido.

  if (!tkn) {
    alert('Usuário não autenticado!');
    return window.location.replace('/');
  }

  const user = JSON.parse(sessionStorage.getItem('user_data'));
  if (user.type === '1' && !window.location.toString().includes('admin'))
    return window.location.replace('admin');
}

window.listUsers = () => {
  fetch('/api/users',{
    headers: {
      'Authorization': `Bearer ${sessionStorage.getItem('tkn')}`
    }
  }).then(res => res.json())
    .then(res => {

      const listEl = document.querySelector('#list');
      res.forEach(user => {

        const template = `
          <tr>
            <td><img class="profile-thumb" src="${user.profile_picture ?? '/img/profile.png'}"></img></td>
            <td>${user.name}</td>
            <td>${user.email}</td>
            <td>${_address(user)}</td>
            <td>${user.phone ?? '-'}</td>
            <td>
                <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
            </td>
          </tr>
          `;

        const tr = document.createElement('tr');
        tr.innerHTML = template;

        listEl.appendChild(tr);
      });

  });
}

function _address(user) {
  if (user.street && user.neighborhood && user.number)
    return `${user.street}, Nº ${user.number} - ${user.city}`;

  return '-';
}
