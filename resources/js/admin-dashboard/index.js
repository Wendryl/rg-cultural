window.openFileInput = () => {
  const fileField = document.querySelector('input[type="file"]');
  fileField.click();
};

window.setProfilePic = (e) => {
  const img = document.querySelector("#pic-preview");
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
