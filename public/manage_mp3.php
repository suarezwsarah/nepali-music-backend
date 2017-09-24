<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$sql = "SELECT * FROM mp3";
$results = mysqli_query($db, $sql);
confirm_result_set($results);

?>
<?php include(SHARED_PATH . '/public_meromusic_header.php'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="card mrg_bottom">
            <div class="page_title_block">
                <div class="col-md-5 col-xs-12">
                    <div class="page_title">Manage Mp3</div>
                </div>
                <div class="col-md-7 col-xs-12">
                    <div class="search_list">
                        <div class="add_btn_primary"> <a href="add_mp3.php">Add Mp3</a> </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row mrg-top">
                <div class="col-md-12">

                    <div class="col-md-12 col-sm-12">
                        <!-- error code goes here-->
                    </div>
                </div>
            </div>
            <div class="col-md-12 mrg-top">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th class="cat_action_list">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($result = mysqli_fetch_assoc($results)) { ?>
                        <tr>
                            <td><?php echo $result['title']; ?></td>
                            <td>Title</td>
                            <td>
<!--                                    <a href="manage_mp3.php?status_deactive_id=" title="Change Status"><span class="badge badge-success badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>Enable</span></span></a>
-->
                                    <a href="manage_mp3.php?status_active_id=" title="Change Status"><span class="badge badge-danger badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>Disable </span></span></a>
                            </td>
                            <td><a href="edit_mp3.php?id=<?php echo $result['id'] ?>" class="btn btn-primary">Edit</a>
                                <a href="?mp3_id=" class="btn btn-default" onclick="return confirm('Are you sure you want to delete this song?');">Delete</a></td>
                        </tr>
                    <?php } // end while ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 col-xs-12">
                <div class="pagination_item_block">
    <!--                <nav>
                        <?php /*include("pagination.php");*/?>
                    </nav>-->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php include(SHARED_PATH . '/public_meromusic_footer.php'); ?>
