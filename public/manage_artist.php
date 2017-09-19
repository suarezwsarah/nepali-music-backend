<?php require_once('../private/initialize.php'); ?>

<?php

$all_artists = find_all_from('artist');

?>

<?php include(SHARED_PATH . '/public_meromusic_header.php'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="card mrg_bottom">
                <div class="page_title_block">
                    <div class="col-md-5 col-xs-12">
                        <div class="page_title">Manage Artist</div>
                    </div>
                    <div class="col-md-7 col-xs-12">
                        <div class="search_list">
                            <div class="add_btn_primary"><a href="add_artist.php?add=yes">Add Artist</a></div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row mrg-top">
                    <div class="col-md-12">

                        <div class="col-md-12 col-sm-12">

                        </div>
                    </div>
                </div>
                <div class="col-md-12 mrg-top">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Artist Name</th>
                            <th>Artist Image</th>
                            <th class="cat_action_list">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($artist = mysqli_fetch_assoc($all_artists)) { ?>
                            <tr>
                                <td><?php echo $artist['first_name'] . ' ' . $artist['last_name']; ?></td>
                                <td><span class="category_img"><img
                                                src="#"/></span></td>
                                <td><a href="#" class="btn btn-primary">Edit</a>
                                    <a href="#" class="btn btn-default"
                                       onclick="return confirm('Are you sure you want to delete this artist?');">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>

<?php include(SHARED_PATH . '/public_meromusic_footer.php'); ?>