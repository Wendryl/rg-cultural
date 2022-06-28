/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/js/complete-registration.js ***!
  \***********************************************/
_setFormData();

function _setFormData() {
  var user = JSON.parse(sessionStorage.getItem('user_data'));
  var fields = document.querySelectorAll('input');
  fields.forEach(function (f) {
    if (user.hasOwnProperty(f.name)) f.value = user[f.name];
  });
}
/******/ })()
;