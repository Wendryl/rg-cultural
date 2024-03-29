/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/js/admin-dashboard/index.js ***!
  \***********************************************/
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

window.openFileInput = function (modalId) {
  var fileField = document.querySelector("".concat(modalId, " input[type=\"file\"]"));
  fileField.click();
};

window.setProfilePic = function (e, imgSelector) {
  var img = document.querySelector(imgSelector);

  var _e$target$files = _slicedToArray(e.target.files, 1),
      file = _e$target$files[0];

  if (file) img.src = URL.createObjectURL(file);
  var body = new FormData();
  body.append('profile_picture', file);
};

window.getCep = function (e) {
  e.target.setAttribute('disabled', true);
  var cep = e.target.value;
  var streetInput = document.querySelector('input[name="street"]');
  var neighborhoodInput = document.querySelector('input[name="neighborhood"]');
  var cityInput = document.querySelector('input[name="city"]');
  fetch("https://viacep.com.br/ws/".concat(cep, "/json/")).then(function (response) {
    return response.json();
  }).then(function (result) {
    e.target.removeAttribute('disabled');
    if (result.erro) return;
    streetInput.value = result.logradouro;
    neighborhoodInput.value = result.bairro;
    cityInput.value = result.localidade;
  })["catch"](function (err) {
    return e.target.removeAttribute('disabled');
  });
};

window.editUser = function (user) {
  var editModal = new bootstrap.Modal('#editUserModal');
  var inputs = Array.from(document.querySelectorAll('#editUserModal input'));
  var profilePic = document.querySelector('#editUserModal img');
  var form = document.querySelector('#editUserModal form');
  form.action = "/update/".concat(user.id);
  profilePic.src = '/img/profile.png';
  inputs.forEach(function (input) {
    if (input.type != 'file' && user[input.name]) input.value = user[input.name];
  });
  if (user.profile_picture) profilePic.src = user.profile_picture;
  editModal.show();
};

window.deleteUser = function (user) {
  var confirmModal = new bootstrap.Modal('#deleteUserModal');
  var message = document.querySelector('#deleteUserModal p.confirm-message');
  var form = document.querySelector('#deleteUserModal form');
  form.action = "/".concat(user.id);
  message.innerHTML = "Tem certeza que deseja excluir <strong>".concat(user.name, "</strong>?");
  confirmModal.show();
};
/******/ })()
;