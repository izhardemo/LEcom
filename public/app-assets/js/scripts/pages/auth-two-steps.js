/*=========================================================================================
	File Name: auth-two-steps.js
	Description: Two Steps verification.
	----------------------------------------------------------------------------------------
	Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
	Author: PIXINVENT
	Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

var inputContainer = document.querySelector('.auth-input-wrapper');

if (inputContainer.length) {
  inputContainer.validate({
    /*
    * ? To enable validation onkeyup
    onkeyup: function (element) {
      $(element).valid();
    },*/
    /*
    * ? To enable validation on focusout
    onfocusout: function (element) {
      $(element).valid();
    }, */
    rules: {
      'code': {
        required: true,
      },
      'recovery_code': {
        required: true
      }
    }
  });
}