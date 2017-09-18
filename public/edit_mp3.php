<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$errors = [];
$category_id = '';
$category_name = '';
$succeed_msg = '';

if (is_get_request()) {

    $id = $_GET['id'];
    $mp3 = find_mp3_by_id($id);
    //$mp3_artist = find_mp3_artist_by_mp3_id($id);
    $artists =  find_mp3_artist_by_mp3_id($id);

  /*  $id = $_GET['id'];
    $category = find_category_by_id($id);

    $category_id = $category['id'];
    $category_name = $category['name'];*/

}

if (is_post_request()) {

    var_dump($_POST);

/*    $category_id = $_POST['cat_id'];
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

    }*/

}

?>

<?php include(SHARED_PATH . '/public_meromusic_header.php'); ?>
<style href="<?php echo get_stylesheet('flat-admin')?>"></style>

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
                <form action="" name="edit_form" method="post" class="form form-horizontal" enctype="multipart/form-data">
                    <input  type="hidden" name="mp3_id" value="50" />

                    <div class="section">
                        <div class="section-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Category :-</label>
                                <div class="col-md-6">
                                    <select name="cat_id" id="cat_id" class="select2">
                                        <option value="">--Select Category--</option>

                                        <option value="1" >Folk</option>

                                        <option value="4" >Modern</option>

                                        <option value="3" >Movie Music</option>

                                        <option value="2" >Pop songs</option>

<!--                                        <option value="7" selected>Uncategorized</option>
-->                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Title :-</label>
                                <div class="col-md-6">
                                    <input type="text" name="mp3_title" id="mp3_title" value="Yo Gaunko Thito Ma" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">duration :-</label>
                                <div class="col-md-6">
                                    <input type="text" name="mp3_duration" id="mp3_duration" value="02:53" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Artist :-</label>
                                <div class="col-md-6">
                                    <select name="mp3_artist[]" id="mp3_artist" class="select2 form-control" required multiple="multiple">
                                        <option value="">--Select Artist--</option>
                                        <?php while ($artist = mysqli_fetch_assoc($artists)) { ?>
                                            <option selected value="<?php echo $artist['id'];?> "><?php echo $artist['first_name']; ?></option>
                                        <?php } ?>

                                        <option value="Aastha Raut" >Aastha Raut</option>

                                        <option value="Anju Panta" >Anju Panta</option>

                                        <option value="Bipul Chettri" >Bipul Chettri</option>

                                        <option value="Deepak limbu" >Deepak limbu</option>

                                        <option value="Indira Joshi" >Indira Joshi</option>

                                        <option value="Juna Prasai" >Juna Prasai</option>

                                        <option value="Kamal Khatri" >Kamal Khatri</option>

                                        <option value="Mausami Gurung" >Mausami Gurung</option>

                                        <option value="Melina Rai" >Melina Rai</option>

                                        <option value="Nabin K Bhattarai" >Nabin K Bhattarai</option>

                                        <option value="Pramod Kharel" >Pramod Kharel</option>

                                        <option value="Prashant Tamang" >Prashant Tamang</option>

                                        <option value="Rajesh Payal Rai" >Rajesh Payal Rai</option>

                                        <option value="Rajina Rimal" >Rajina Rimal</option>

                                        <option value="Raju Lama" >Raju Lama</option>

                                        <option value="Ram Krishna Dhakal" >Ram Krishna Dhakal</option>

                                        <option value="Sadana Sargam" >Sadana Sargam</option>

                                        <option value="Shiva Pariyar" >Shiva Pariyar</option>

                                        <option value="Sindu Malla" >Sindu Malla</option>

<!--                                        <option value="Udit Narayan Jha" selected>Udit Narayan Jha, Ananda Karki</option>
-->                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">MP3 Type :-</label>
                                <div class="col-md-6">
                                    <select name="mp3_type" id="mp3_type" style="width:280px; height:25px;" class="select2" required>
                                        <option value="">--Select Category--</option>
                                        <option value="server_url" selected>From Server</option>
                                        <option value="local" >From Local</option>
                                    </select>
                                </div>
                            </div>
                            <div id="mp3_url_display" class="form-group" style="display:block;">
                                <label class="col-md-3 control-label">Video URL :-</label>
                                <div class="col-md-6">
                                    <input type="text" name="mp3_url" id="mp3_url" value="https://archive.org/download/hits-nepali-songs-of-udit-narayan-www.nepalitheater.com/Yo%20Gaunko%20Thito%20Ma%5bwww.nepalitheater.com%5d.mp3" class="form-control">
                                </div>
                            </div>
                            <div id="mp3_local_display" class="form-group" style="display:none;">
                                <label class="col-md-3 control-label">Video Upload :-</label>
                                <div class="col-md-6">

                                    <input type="hidden" name="mp3_file_name" id="mp3_file_name" value="" class="form-control">
                                    <input type="file" name="mp3_local" id="mp3_local" value="" class="form-control">
                                    <div><label class="control-label">Current URL :-</label>https://archive.org/download/hits-nepali-songs-of-udit-narayan-www.nepalitheater.com/Yo%20Gaunko%20Thito%20Ma%5bwww.nepalitheater.com%5d.mp3</div><br>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
                                    </div>

                                    <div class="msg"></div>
                                    <input type="button" id="btn" class="btn-success" value="Upload" />
                                </div>
                            </div><br>
                            <div id="thumbnail" class="form-group" style="display:block;">
                                <label class="col-md-3 control-label">Thumbnail Image:-</label>
                                <div class="col-md-6">
                                    <div class="fileupload_block">
                                        <input type="file" name="mp3_thumbnail" value="" id="fileupload">
                                        <input type="hidden" name="mp3_thumbnail_name" id="mp3_thumbnail_name" value="31112_" class="form-control">
                                        <div class="fileupload_img"><img type="image" src="images/31112_" alt="video thumbnail" /></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Video Description :-</label>
                                <div class="col-md-6">
                                    <textarea name="mp3_description" id="mp3_description" class="form-control"></textarea>

                                    <script>CKEDITOR.replace( 'mp3_description' );</script>
                                </div>
                            </div><br>
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

