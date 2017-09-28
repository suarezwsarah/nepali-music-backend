"use strict";

var app = angular.module('login', []);

app.controller('loginCtrl', function ($scope) {

	$scope.form = {
		username : '',
		password : ''
	};

	$scope.isLoginBtnDisabled = function () {
		return $scope.form.username.trim() === '' || $scope.form.password.trim() === '';
    };

});
