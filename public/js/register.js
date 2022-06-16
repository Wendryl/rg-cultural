/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/register.js ***!
  \**********************************/
window.register = function (event) {
  event.preventDefault();
  var registerForm = new FormData(document.querySelector('form'));
  var body = new FormData();
  body.append('data', JSON.stringify({
    name: registerForm.get('name'),
    email: registerForm.get('email'),
    password: registerForm.get('password')
  }));
  fetch('/api/users', {
    body: body,
    method: 'POST'
  }).then(function (body) {
    return body.json();
  }).then(function (res) {
    if (res.error) return alert(res.message + '\n' + res.error);
    alert('Usuário cadastrado com sucesso!');
    window.location.replace('login');
  })["catch"](function (err) {
    return alert(err.message);
  });
};
/******/ })()
;