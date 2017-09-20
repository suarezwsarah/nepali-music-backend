(function () {
    $(document).ready(function () {

        var increment_counter = 1;

        $("#addMoreCat").click(function (event) {
            event.preventDefault();
            increment_counter++;
            var inputId = 'category_name_' + increment_counter;
            var inputName = 'category_name_' + increment_counter;
            var newCatBox = $(document.createElement('div'));
            $(newCatBox).attr('class', 'form-group');
            newCatBox.after().html(
                '<label class="col-md-3 control-label">Category Name :-</label>' +
                '<div class="col-md-6">' +
                '    <input type="text" name=' + '"' + inputName + '"' +' id=' + '"' + inputId + '"' + 'value="" class="form-control" required>' +
                '</div>'
            );

            newCatBox.prependTo("#sectionBody");
        });
        
        
        $('#category_name_1').keyup(function () {
            var txtLength = $(this).val().trim().length;
            if (txtLength > 0) {
                $('#btnSaveCat').removeAttr('disabled');
            } else {
                $('#btnSaveCat').prop("disabled", "disabled");
            }
        });
        
    });
}());