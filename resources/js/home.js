window.onload = () => {
  _verifyUser();
  document.querySelector('#title').innerHTML = JSON.parse(sessionStorage.getItem('user_data')).name;
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
}
