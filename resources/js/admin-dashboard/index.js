window.openFileInput = (modalId) => {
  const fileField = document.querySelector(`${modalId} input[type="file"]`);
  fileField.click();
};

window.setProfilePic = (e, imgSelector) => {
  const img = document.querySelector(imgSelector);
  const [file] = e.target.files;

  if (file) img.src = URL.createObjectURL(file);

  const body = new FormData();
  body.append('profile_picture', file);
};

window.getCep = (e) => {
  e.target.setAttribute('disabled', true);

  const cep = e.target.value;
  const streetInput = document.querySelector('input[name="street"]');
  const neighborhoodInput = document.querySelector('input[name="neighborhood"]');
  const cityInput = document.querySelector('input[name="city"]');

  fetch(`https://viacep.com.br/ws/${cep}/json/`)
    .then(
      response => response.json()
    ).then(
      result => {
        e.target.removeAttribute('disabled');
        if (result.erro)
          return
        streetInput.value = result.logradouro;
        neighborhoodInput.value = result.bairro;
        cityInput.value = result.localidade;
      }
    ).catch(err => e.target.removeAttribute('disabled'))
}

window.editUser = (user) => {
  const editModal = new bootstrap.Modal('#editUserModal');
  const inputs = Array.from(document.querySelectorAll('#editUserModal input'));
  const profilePic = document.querySelector('#editUserModal img');
  const form = document.querySelector('#editUserModal form');
  form.action = `/update/${user.id}`;

  profilePic.src = '/img/profile.png'

  inputs.forEach(input => {
    if (input.type != 'file' && user[input.name])
      input.value = user[input.name];
  });

  if (user.profile_picture)
    profilePic.src = user.profile_picture;

  editModal.show();

}
