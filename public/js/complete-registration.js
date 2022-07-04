/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/js/complete-registration.js ***!
  \***********************************************/
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

_setFormData();

function _setFormData() {
  var _ref;

  var user = JSON.parse(sessionStorage.getItem("user_data"));
  var fields = document.querySelectorAll("input");
  var img = document.querySelector("#pic-preview");
  img.src = (_ref = '/' + user.profile_picture) !== null && _ref !== void 0 ? _ref : '/img/profile.png';
  fields.forEach(function (f) {
    if (user.hasOwnProperty(f.name)) f.value = user[f.name];
  });
}

window.openFileInput = function () {
  var fileField = document.querySelector('input[type="file"]');
  fileField.click();
};

window.setProfilePic = function (e) {
  var img = document.querySelector("#pic-preview");

  var _e$target$files = _slicedToArray(e.target.files, 1),
      file = _e$target$files[0];

  var userId = JSON.parse(sessionStorage.getItem("user_data")).id;
  if (file) img.src = URL.createObjectURL(file);
  var body = new FormData();
  body.append('profile_picture', file);
  fetch("/api/users/".concat(userId, "/profile-picture"), {
    headers: {
      'Authorization': "Bearer ".concat(sessionStorage.getItem('tkn'))
    },
    method: 'POST',
    body: body
  }).then(function (res) {
    return res.json();
  }).then(function (result) {
    return console.log(result);
  });
};
/******/ })()
;