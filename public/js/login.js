"use strict";

$(function () {

	var username = $('#username');
	var password = $('#password');
	var btnLogin = $('#btnLogin');

	var validUsername = false;
	var validPassword = false;

	// focus on username input when the page is loaded
	username.focus();

	// disable the login button initially
	btnLogin.prop('disabled', true);

	username.keyup(function () {
		var length = $(this).val().trim().length;
		if (length > 0) {
			validUsername = true;
			if (validUsername && validPassword) {
				btnLogin.prop('disabled', false);
			}
		}else {
			validUsername = false;
            btnLogin.prop('disabled', true);
        }
    });

	password.keyup(function () {
		var length = $(this).val().trim().length;
		if (length > 0) {
			validPassword = true;
            if (validUsername && validPassword) {
                btnLogin.prop('disabled', false);
            }
		} else {
			validPassword = false;
            btnLogin.prop('disabled', true);
        }
     })

});
