/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/home.js ***!
  \******************************/
window.onload = function () {
  _verifyUser();

  document.querySelector('#title').innerHTML = JSON.parse(sessionStorage.getItem('user_data')).name;
};

window.logout = function () {
  fetch('/api/logout', {
    headers: {
      'Authorization': "Bearer ".concat(sessionStorage.getItem('tkn'))
    }
  }).then(function (res) {
    return res.json();
  }).then(function (res) {
    alert(res.message);
    sessionStorage.clear();
    window.location.replace('/');
  });
};

function _verifyUser() {
  var tkn = sessionStorage.getItem('tkn'); // TODO - implementar end-point no servidor para verificar se o token é válido.

  if (!tkn) {
    alert('Usuário não autenticado!');
    return window.location.replace('/');
  }
}
/******/ })()
;