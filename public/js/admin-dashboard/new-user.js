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
    var selectize = $("#categories").selectize({
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
    selectize.on('change', function () {
      document.querySelector('input[name="user_categories"]').value = JSON.stringify(selectize[0].selectize.getValue());
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

window.handlePictureClick = function (inputSelector) {
  document.querySelector(inputSelector).click();
};

window.setProfilePicture = function (event, previewSelector) {
  var files = event.target.files;

  if (files.length > 0) {
    var img = URL.createObjectURL(files[0]);
    document.querySelector(previewSelector).src = img;
  }
};

window.setCategories = function (categories) {
  var $select = $('#categories').selectize();
  var selectize = $select[0].selectize;
  selectize.setValue(categories.map(function (p) {
    return p.category_id;
  }));
};
/******/ })()
;