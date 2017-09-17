<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php include(SHARED_PATH . '/public_meromusic_header.php'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="card mrg_bottom">
            <div class="page_title_block">
                <div class="col-md-5 col-xs-12">
                    <div class="page_title">Manage Categories</div>
                </div>
                <div class="col-md-7 col-xs-12">
                    <div class="search_list">

                        <div class="add_btn_primary"><a href="add_category.php?add=yes">Add Category</a></div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row mrg-top">
                <div class="col-md-12">

                    <div class="col-md-12 col-sm-12">
             <!--           <?php /*if (isset($_SESSION['msg'])) { */?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                <?php /*echo $client_lang[$_SESSION['msg']]; */?></a> </div>
                            --><?php /*unset($_SESSION['msg']);
                        } */?>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mrg-top">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Category</th>
                        <th class="cat_action_list">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td><a href="" class="btn btn-primary">Edit</a>
                                <a href="?cat_id=" class="btn btn-default"
                                   onclick="return confirm('Are you sure you want to delete this category and related songs?');">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/public_meromusic_footer.php'); ?>
