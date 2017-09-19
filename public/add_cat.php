<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$errors = [];
$category_name = '';
$succeed_msg = '';

if (is_post_request()) {

    $category_name = $_POST['category_name'];

    if (is_blank($category_name)) {
        $errors[] = 'Category name cant be blank';
    }

    if (empty($errors)) {
        $field = [
            "name" => $category_name
        ];

        $insert_category = insert_table('category', $field);

        if ($insert_category) {
            $succeed_msg = 'Successfully Created';
        }

    }

}

?>

<?php include(SHARED_PATH . '/public_meromusic_header.php'); ?>

<script>
    (function () {
        $(document).ready(function () {
            $("#addMoreCat").click(function (event) {
                event.preventDefault();
                var newCatBox = $(document.createElement('div'));
                $(newCatBox).attr('class', 'form-group');
                newCatBox.after().html(
                    '<label class="col-md-3 control-label">Category Name :-</label>' +
                    '<div class="col-md-6">' +
                    '    <input type="text" name="category_name" id="category_name" value="" class="form-control" required>' +
                    '</div>'
                );

                newCatBox.prependTo("#sectionBody");
            });
        });
    }());
</script>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="page_title_block">
                <div class="col-md-5 col-xs-12">
                    <div class="page_title">Add Category</div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row mrg-top">
                <div class="col-md-12">

                    <?php if (!empty($errors)) {  ?>
                        <div class="col-md-12 col-sm-12">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <?php
                                $error_output = '';
                                foreach ($errors as $error) {
                                    $error_output .= "<p>${error}</p>";
                                }
                                echo $error_output;
                                ?>
                            </div>
                        </div>
                    <?php } // end $errors check?>

                    <?php if (!empty($succeed_msg)) {  ?>
                        <div class="col-md-12 col-sm-12">
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <p><?php echo $succeed_msg ?></p>
                            </div>
                        </div>
                    <?php } // end $succeed_msg empty check?>

                </div>
            </div>
            <div class="card-body mrg_bottom">
                <form action="add_cat.php" name="addeditcategory" method="post" class="form form-horizontal" enctype="multipart/form-data">
                    <div class="section">
                        <div class="section-body" id="sectionBody">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Category Name :-</label>
                                <div class="col-md-6">
                                    <input type="text" name="category_name" id="category_name" value="" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group" id="btnSaveCategory">
                                <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                    <button id="addMoreCat" name="add" class="btn btn-primary">Add More</button>
                               </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/public_meromusic_footer.php'); ?>
