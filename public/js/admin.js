"use strict";

var app = angular.module('meromusic', []);

app.controller('adminCtrl', function ($scope) {

    $scope.isHidePanel = false;
    $scope.errorMsg = [];
    $scope.users = [{first_name: '', last_name: ''}];
    $scope.showUserTable = false;
    $scope.currentUser = {first_name: ''};

    $scope.hello = 'test';

    $scope.getUsers = function () {
        $scope.isHidePanel = true;

        $.get('ajax/ajax_admin.php?type=all_users', function (data, status) {
            console.log(data);
            $scope.users = angular.fromJson(data);
            $scope.showUserTable = true;
            $scope.$apply();
        });

        console.log('Getting user...');
    };

    $scope.updateUser = function () {
        console.log($scope.currentUser);
    };

    $scope.editUser = function (userId) {
        $('#addAdminModal').modal('show');
        $.get('ajax/ajax_admin.php?id='+userId, function (data, status) {
            
        });
  /*      $.get('ajax/ajax_admin.php?type=user&id='+userId, function (data, status) {
            $scope.currentUser = angular.fromJson(data);
            $scope.$apply();
        });*/
    }

});
