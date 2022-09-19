/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************!*\
  !*** ./resources/js/admin-dashboard/new-user.js ***!
  \**************************************************/
window.onload = function () {
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
};
/******/ })()
;