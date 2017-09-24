"use strict";

$(function () {

    var $editMp3Modal = $('#editMp3Modal');
    var $modalFormContent = $('#modalFormContent');

    var isEdit = false;

    window.Mp3Crud = {
        edit : function (id) {
            isEdit = true;
            $.ajax({
                url: 'edit_mp3.php?id=' + id,
                type : 'GET',
                success: function (response, status) {
                    $modalFormContent.html(response);
                    $editMp3Modal.modal('toggle');
                }
            });
        }
    };
});