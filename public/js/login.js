/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/login.js ***!
  \*******************************/
window.login = function (event) {
  event.preventDefault();
  var form = new FormData(document.querySelector('form'));
  fetch('/api/login', {
    body: form,
    method: 'POST'
  }).then(function (body) {
    return body.json();
  }).then(function (res) {
    sessionStorage.setItem('tkn', res.token);
    sessionStorage.setItem('user_data', JSON.stringify(res.user));
    alert('Usuário autenticado com sucesso!');
    window.location.replace('home');
  })["catch"](function (err) {
    return alert(err.message);
  });
};
/******/ })()
;