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
