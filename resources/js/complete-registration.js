_setFormData();

function _setFormData() {
  const user = JSON.parse(sessionStorage.getItem("user_data"));
  const fields = document.querySelectorAll("input");
  const img = document.querySelector("#pic-preview");

  img.src = '/' + user.profile_picture ?? '/img/profile.png';

  fields.forEach((f) => {
    if (user.hasOwnProperty(f.name)) f.value = user[f.name];
  });
}

window.openFileInput = () => {
  const fileField = document.querySelector('input[type="file"]');
  fileField.click();
};

window.setProfilePic = (e) => {
  const img = document.querySelector("#pic-preview");
  const [file] = e.target.files;
  const userId = JSON.parse(sessionStorage.getItem("user_data")).id;

  if (file) img.src = URL.createObjectURL(file);

  const body = new FormData();
  body.append('profile_picture', file);

  fetch(`/api/users/${userId}/profile-picture`, {
    headers: {
      'Authorization': `Bearer ${sessionStorage.getItem('tkn')}`
    },
    method: 'POST',
    body
  }).then(res => res.json())
  .then(result => console.log(result))
};
