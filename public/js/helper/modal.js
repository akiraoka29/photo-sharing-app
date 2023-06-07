/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/helper/modal.js ***!
  \**************************************/
jQuery(function ($) {
  // Initialize
  var Props = {
    element: {
      signinModal: $('#signinModal'),
      signupModal: $('#signupModal'),
      signupLink: '#signupLink'
    }
  };
  var Modal = {};

  // Call Function
  Modal.init = function () {
    Modal.event.showSignupOnClick();
  };
  Modal.active = {
    signupModal: function signupModal() {
      var type = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'show';
      console.log('-- Signup Modal --');
      if (type == 'show') {
        Props.element.signupModal.modal('show');
      } else {
        Props.element.signupModal.modal('hide');
      }
    },
    signinModal: function signinModal() {
      var type = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'show';
      console.log('-- Signin Modal --');
      if (type == 'show') {
        Props.element.signinModal.modal('show');
      } else {
        Props.element.signinModal.modal('hide');
      }
    }
  };
  Modal.event = {
    showSignupOnClick: function showSignupOnClick() {
      $(document).on('click', Props.element.signupLink, function () {
        Modal.active.signinModal('hide');
        Modal.active.signupModal('show');
      });
    }
  };

  // Render
  Modal.init();
});
/******/ })()
;