<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$errors = [];
$category_id = '';
$category_name = '';
$succeed_msg = '';

if (is_get_request()) {
    $id = $_GET['id'];
    $category = find_category_by_id($id);

    $category_id = $category['id'];
    $category_name = $category['name'];

}

if (is_post_request()) {
    $category_id = $_POST['cat_id'];
    $category_name = $_POST['category_name'];

    if (is_blank($category_id)) {
        $errors[] = 'Category id is required';
    }

    if (is_blank($category_name)) {
        $errors[] = 'Category name cant be blank';
    }

    if (empty($errors)) {
        $field = [
            "id" => $category_id,
            "name" => $category_name
        ];

        $update_succeed = update_table('category', $field);

        if ($update_succeed) {
            $succeed_msg = 'Successfully updated';
        }

    }

}

?>

<?php include(SHARED_PATH . '/public_meromusic_header.php'); ?>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="page_title_block">
                <div class="col-md-5 col-xs-12">
                    <div class="page_title">Edit Category</div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row mrg-top">
                <div class="col-md-12">

            <!--        <div class="col-md-12 col-sm-12">
                            <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </a> </div>
                    </div>-->

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
                <form action="edit_cat.php" name="addeditcategory" method="post" class="form form-horizontal" enctype="multipart/form-data">
                    <input  type="hidden" name="cat_id" value="<?php echo $category_id; ?>" />

                    <div class="section">
                        <div class="section-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Category Name :-</label>
                                <div class="col-md-6">
                                    <input type="text" name="category_name" id="category_name" value="<?php echo $category_name;?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
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

