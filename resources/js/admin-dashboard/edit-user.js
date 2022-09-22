window.deletePic = (picId) => {
  const form = document.querySelector('#delete-pic-form');
  form.setAttribute('action', `/user-gallery/${picId}`);
  form.submit();
}
