window.register = (event) => {
  event.preventDefault();

  const registerForm = new FormData(document.querySelector('form'));

  const body = new FormData();
  body.append('data', JSON.stringify({
    name: registerForm.get('name'),
    email: registerForm.get('email'),
    password: registerForm.get('password'),
  }));

  fetch('/api/users', {
    body,
    method: 'POST'
  }).then(body => body.json())
    .then(res => {
      if (res.error)
        return alert(res.message + '\n' + res.error);

      alert('Usuário cadastrado com sucesso!');
      window.location.replace('login');
    })
  .catch(err => alert(err.message));
}

