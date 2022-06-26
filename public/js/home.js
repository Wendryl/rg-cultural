/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/home.js ***!
  \******************************/
_verifyUser();

window.onload = function () {
  var _user$profile_picture;

  var title = document.querySelector('#title');
  var welcomeMessage = document.querySelector('#welcome-text');
  var profilePic = document.querySelector('#profile-pic');
  var user = JSON.parse(sessionStorage.getItem('user_data'));
  if (title != null) title.innerHTML = user.name;
  if (profilePic != null) profilePic.setAttribute('src', (_user$profile_picture = user.profile_picture) !== null && _user$profile_picture !== void 0 ? _user$profile_picture : "".concat(window.location.origin, "/img/profile.png"));
  if (welcomeMessage != null) welcomeMessage.innerHTML = "Ol\xE1 <strong>".concat(user.name, "!</strong><br>Bem vindo ao portal <strong>RG Cultural!</strong>");
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

  var user = JSON.parse(sessionStorage.getItem('user_data'));
  if (user.type === '1' && !window.location.toString().includes('admin')) return window.location.replace('admin');
}

window.listUsers = function () {
  fetch('/api/users', {
    headers: {
      'Authorization': "Bearer ".concat(sessionStorage.getItem('tkn'))
    }
  }).then(function (res) {
    return res.json();
  }).then(function (res) {
    var listEl = document.querySelector('#list');
    res.forEach(function (user) {
      var _user$profile_picture2, _user$phone;

      var template = "\n          <tr>\n            <td><img class=\"profile-thumb\" src=\"".concat((_user$profile_picture2 = user.profile_picture) !== null && _user$profile_picture2 !== void 0 ? _user$profile_picture2 : '/img/profile.png', "\"></img></td>\n            <td>").concat(user.name, "</td>\n            <td>").concat(user.email, "</td>\n            <td>").concat(_address(user), "</td>\n            <td>").concat((_user$phone = user.phone) !== null && _user$phone !== void 0 ? _user$phone : '-', "</td>\n            <td>\n                <a href=\"#editEmployeeModal\" class=\"edit\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Edit\">&#xE254;</i></a>\n                <a href=\"#deleteEmployeeModal\" class=\"delete\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Delete\">&#xE872;</i></a>\n            </td>\n          </tr>\n          ");
      var tr = document.createElement('tr');
      tr.innerHTML = template;
      listEl.appendChild(tr);
    });
  });
};

function _address(user) {
  if (user.street && user.neighborhood && user.number) return "".concat(user.street, ", N\xBA ").concat(user.number, " - ").concat(user.city);
  return '-';
}
/******/ })()
;