<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$errors = [];
$category_name = '';
$succeed_msgs = [];

function get_input_categories()
{
    $categories = [];
    foreach ($_POST as $key => $value) {
        if (preg_match('/category_name/', $key)) {
            if (is_blank($value)) {
                $errors[] = 'Category name cant be blank';
            } else {
                $categories[$key] = $value;
            }
        }
    }
    return $categories;
}

if (is_post_request()) {

    $categories = get_input_categories();

    if (empty($errors)) {
        foreach ($categories as $cat_name => $cat_val) {
            $fields = ['name' => $cat_val];
            $insert_category = insert_table('category', $fields);
            if ($insert_category) {
                $succeed_msgs[] = "Sucessfully inserted ${cat_val}";
            }
        }
    }
}

?>

<?php include(SHARED_PATH . '/public_meromusic_header.php'); ?>
<script src="<?php echo get_js('add_cat'); ?>"></script>

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
                    <div class="col-md-12 col-sm-12">
                        <?php echo display_my_errors_sec_pages($errors); ?>
                        <?php echo display_my_success_sec_pages($succeed_msgs); ?>
                    </div>
                </div>
            </div>
            <div class="card-body mrg_bottom">
                <form action="add_cat.php" name="addeditcategory" method="post" class="form form-horizontal"
                      enctype="multipart/form-data">
                    <div class="section">
                        <div class="section-body" id="sectionBody">
                            <?php if (is_get_request()) { ?>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Category Name :-</label>
                                    <div class="col-md-6">
                                        <input type="text" name="category_name_1" id="category_name_1" value=""
                                               class="form-control" required>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if (!empty($categories)) { ?>
                                <?php foreach ($categories as $cat_name => $cat_val) { ?>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Category Name :-</label>
                                        <div class="col-md-6">
                                            <input name="<?php echo $cat_name ?>" id="category_name"
                                                   value="<?php echo $cat_val; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                <?php } // end foreach ?>
                            <?php } // end if ?>

                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" id="btnSaveCat" name="submit" disabled class="btn btn-primary">Save</button>
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