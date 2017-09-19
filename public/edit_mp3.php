<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$errors = [];
$category_id = '';
$category_name = '';
$succeed_msg = '';


if (is_post_request()) {
    $mp3 = $_POST;
    // Remove all the spaces of element inside array
    $artists = trimed_array($_POST['mp3_artist']);
    $mp3_id = db_escape($db, $_POST['id']);
    $update_artist =  update_artists($mp3_id, $artists);
    if (!$update_artist) {
        $errors[] = 'Failed to update artists';
    } else {
        do_audit_log('INFO', "${_SESSION['username']} updated artists");
    }

    // update categories
    $categories = trimed_array($_POST['cat_ids']);
    $update_categories = update_categories($mp3_id, $categories);
    if ($update_categories) {
        do_audit_log('INFO', "${_SESSION['username']} updated category for mp3 id ${mp3_id}");
    } else {
        $errors[] = 'Failed to update category';
    }



} else {
    $id = $_GET['id'];
    $mp3 = find_mp3_by_id($id);

    $artists = find_mp3_artist_by_mp3_id($id);

    // Used to populate artist select dropdown
    $all_artists = find_all_from('artist');

    $all_categories = find_all_from('category');

    $selected_categories = find_mp3_category_by_mp3_id($id);

}

?>

<?php include(SHARED_PATH . '/public_meromusic_header.php'); ?>
<style href="<?php echo get_stylesheet('flat-admin') ?>"></style>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="page_title_block">
                <div class="col-md-5 col-xs-12">
                    <div class="page_title">Edit Mp3</div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row mrg-top">
                <div class="col-md-12">

                    <div class="col-md-12 col-sm-12">

                    </div>
                </div>
            </div>
            <div class="card-body mrg_bottom">
                <form action="" name="edit_form" method="post" class="form form-horizontal"
                      enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $mp3['id']; ?>"/>

                    <div class="section">
                        <div class="section-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Category :-</label>
                                <div class="col-md-6">
                                    <select name="cat_ids[]" id="cat_id" class="select2" multiple required>
                                        <option value="">--Select Category--</option>
                                        <?php while ($selected_category = mysqli_fetch_assoc($selected_categories)) { ?>
                                            <option selected value="<?php echo $selected_category['id']; ?>"> <?php echo $selected_category['name']; ?> </option>
                                        <?php } ?>
                                        <?php mysqli_free_result($selected_categories); ?>

                                        <?php while ($category = mysqli_fetch_assoc($all_categories)) { ?>
                                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                        <?php } ?>

                                        <?php mysqli_free_result($all_categories); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Title :-</label>
                                <div class="col-md-6">
                                    <input type="text" name="mp3_title" id="mp3_title" value="Yo Gaunko Thito Ma"
                                           class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">duration :-</label>
                                <div class="col-md-6">
                                    <input type="text" name="mp3_duration" id="mp3_duration" value="02:53"
                                           class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Artist :-</label>
                                <div class="col-md-6">
                                    <select name="mp3_artist[]" id="mp3_artist" class="select2 form-control" required
                                            multiple="multiple">
                                        <option value="">--Select Artist--</option>
                                        <?php while ($artist = mysqli_fetch_assoc($artists)) { ?>
                                            <option selected
                                                    value="<?php echo $artist['id']; ?> "><?php echo $artist['first_name']; ?></option>
                                        <?php } ?>
                                        <?php mysqli_free_result($artists); ?>

                                        <?php while ($current_artist = mysqli_fetch_assoc($all_artists)) { ?>
                                            <option value="<?php echo $current_artist['id']; ?> "><?php echo $current_artist['first_name']; ?></option>
                                        <?php } ?>

                                        <?php mysqli_free_result($all_artists); ?>

                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">MP3 Type :-</label>
                                <div class="col-md-6">
                                    <select name="mp3_type" id="mp3_type" style="width:280px; height:25px;"
                                            class="select2" required>
                                        <option value="">--Select Category--</option>
                                        <option value="server_url" selected>From Server</option>
                                        <option value="local">From Local</option>
                                    </select>
                                </div>
                            </div>
                            <div id="mp3_url_display" class="form-group" style="display:block;">
                                <label class="col-md-3 control-label">Video URL :-</label>
                                <div class="col-md-6">
                                    <input type="text" name="mp3_url" id="mp3_url"
                                           value="https://archive.org/download/hits-nepali-songs-of-udit-narayan-www.nepalitheater.com/Yo%20Gaunko%20Thito%20Ma%5bwww.nepalitheater.com%5d.mp3"
                                           class="form-control">
                                </div>
                            </div>
                            <div id="mp3_local_display" class="form-group" style="display:none;">
                                <label class="col-md-3 control-label">Video Upload :-</label>
                                <div class="col-md-6">

                                    <input type="hidden" name="mp3_file_name" id="mp3_file_name" value=""
                                           class="form-control">
                                    <input type="file" name="mp3_local" id="mp3_local" value="" class="form-control">
                                    <div><label class="control-label">Current URL :-</label>https://archive.org/download/hits-nepali-songs-of-udit-narayan-www.nepalitheater.com/Yo%20Gaunko%20Thito%20Ma%5bwww.nepalitheater.com%5d.mp3
                                    </div>
                                    <br>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success myprogress" role="progressbar"
                                             style="width:0%">0%
                                        </div>
                                    </div>

                                    <div class="msg"></div>
                                    <input type="button" id="btn" class="btn-success" value="Upload"/>
                                </div>
                            </div>
                            <br>
                            <div id="thumbnail" class="form-group" style="display:block;">
                                <label class="col-md-3 control-label">Thumbnail Image:-</label>
                                <div class="col-md-6">
                                    <div class="fileupload_block">
                                        <input type="file" name="mp3_thumbnail" value="" id="fileupload">
                                        <input type="hidden" name="mp3_thumbnail_name" id="mp3_thumbnail_name"
                                               value="31112_" class="form-control">
                                        <div class="fileupload_img"><img type="image" src="images/31112_"
                                                                         alt="video thumbnail"/></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Video Description :-</label>
                                <div class="col-md-6">
                                    <textarea name="mp3_description" id="mp3_description"
                                              class="form-control"></textarea>

                                    <script>CKEDITOR.replace('mp3_description');</script>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
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

