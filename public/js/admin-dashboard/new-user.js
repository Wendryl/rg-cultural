/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************!*\
  !*** ./resources/js/admin-dashboard/new-user.js ***!
  \**************************************************/
window.onload = function () {
  initializeSelectize();
};

function initializeSelectize() {
  $(function () {
    $("#categories").selectize({
      create: function create(input) {
        return {
          value: input,
          text: input
        };
      },
      render: {
        option_create: function option_create(data, escape) {
          return '<div class="create">Adicionar <strong>' + escape(data.input) + '</strong>&hellip;</div>';
        }
      }
    });
  });
}

window.resetControl = function (event, controlSelector) {
  document.querySelector(controlSelector).value = '';
  document.querySelector('#img-preview').innerHTML = '';
  event.target.setAttribute('disabled', 'true');
};

window.handleFileInput = function (event) {
  var wrapper = document.querySelector('#img-preview');
  var files = event.target.files;
  if (!files.length > 0) return;
  document.querySelector('#reset-file-input').removeAttribute('disabled');
  Array.from(files).forEach(function (f) {
    var img = document.createElement('img');
    img.src = URL.createObjectURL(f);
    img.classList.add('pic-thumb');
    wrapper.append(img);
  });
};
/******/ })()
;