_setFormData();

function _setFormData() {
  const user = JSON.parse(sessionStorage.getItem('user_data'));
  const fields = document.querySelectorAll('input');

  fields.forEach(f => {
    if (user.hasOwnProperty(f.name))
      f.value = user[f.name];
  });
}


