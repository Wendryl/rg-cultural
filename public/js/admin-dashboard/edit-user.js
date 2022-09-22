/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./resources/js/admin-dashboard/edit-user.js ***!
  \***************************************************/
window.deletePic = function (picId) {
  var form = document.querySelector('#delete-pic-form');
  form.setAttribute('action', "/user-gallery/".concat(picId));
  form.submit();
};
/******/ })()
;