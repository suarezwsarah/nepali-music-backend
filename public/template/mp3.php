<?php if ((is_get_request() && is_edit()) || (is_get_request() && is_add()) || (is_post_request() )) { ?>

    <?php $page_title = 'mp3'; ?>
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
                            <?php echo display_my_errors_sec_pages($template_vars['errors']); ?>
                            <?php echo display_my_success_sec_pages($template_vars['succeed_msgs']); ?>
                        </div>
                    </div>
                </div>
                <div class="card-body mrg_bottom">
                    <form action="<?php echo url_for('mp3.php'); ?>" name="edit_form" method="post"
                          class="form form-horizontal"
                          enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $template_vars['mp3']['id']; ?>"/>

                        <div class="section">
                            <div class="section-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Category :-</label>
                                    <div class="col-md-6">
                                        <select name="cat_ids[]" id="cat_id" class="select2" multiple required>
                                            <option value="">--Select Category--</option>
                                            <?php foreach ($template_vars['selected_categories'] as $selected_category) { ?>
                                                <option selected
                                                        value="<?php echo $selected_category['id']; ?>"> <?php echo $selected_category['name']; ?> </option>
                                            <?php } ?>

                                            <?php foreach ($template_vars['all_categories'] as $category) { ?>
                                                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Title : </label>
                                    <div class="col-md-6">
                                        <input type="text" name="mp3_title" id="mp3_title"
                                               value="<?php echo $template_vars['mp3']['title']; ?>"
                                               class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">duration : </label>
                                    <div class="col-md-6">
                                        <input type="text" name="mp3_duration" id="mp3_duration"
                                               value="<?php echo $template_vars['mp3']['duration']; ?>"
                                               class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Artist : </label>
                                    <div class="col-md-6">
                                        <select name="mp3_artist[]" id="mp3_artist" class="select2 form-control"
                                                required
                                                multiple="multiple">
                                            <option value="">--Select Artist--</option>
                                            <?php foreach ($template_vars['selected_artists'] as $artist) { ?>
                                                <option selected
                                                        value="<?php echo $artist['id']; ?> "><?php echo $artist['first_name']; ?></option>
                                            <?php } ?>

                                            <?php foreach ($template_vars['all_artists'] as $current_artist) { ?>
                                                <option value="<?php echo $current_artist['id']; ?> "><?php echo $current_artist['first_name']; ?></option>
                                            <?php } ?>


                                        </select>
                                    </div>
                                </div>
                                <div id="mp3_url_display" class="form-group" style="display:block;">
                                    <label class="col-md-3 control-label">URL : </label>
                                    <div class="col-md-6">
                                        <input type="text" name="mp3_url" id="mp3_url"
                                               value="<?php echo $template_vars['mp3']['url']; ?>"
                                               class="form-control">
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
                                              class="form-control"><?php echo $template_vars['mp3']['description']; ?></textarea>

                                        <script>CKEDITOR.replace('mp3_description');</script>
                                    </div>
                                </div>
                                <br>
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

<?php } else {// end if ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="card mrg_bottom">
                <div class="page_title_block">
                    <div class="col-md-5 col-xs-12">
                        <div class="page_title">Manage Mp3</div>
                    </div>
                    <div class="col-md-7 col-xs-12">
                        <div class="search_list">
                            <div class="add_btn_primary"><a href="mp3.php?action=add">Add Mp3</a></div>
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
                        <?php foreach ($template_vars['mp3s'] as $result) { ?>
                            <tr>
                                <td><?php echo $result['title']; ?></td>
                                <td>Title</td>
                                <td>
                                    <?php if ($result['active'] === '1') { ?>
                                        <a href="mp3.php?status_deactivate_id=<?php echo $result['id']?>" title="Change Status">
                                            <span class="badge badge-success badge-icon">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                <span>Enable</span>
                                            </span>
                                        </a>
                                    <?php } else { // end if ?>
                                        <a href="mp3.php?status_activate_id=<?php echo $result['id'];?>" title="Change Status">
                                            <span class="badge badge-danger badge-icon">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                <span>Disable </span>
                                            </span>
                                        </a>
                                    <?php } // end else ?>
                                </td>
                                <td>
                                    <a href="mp3.php?action=edit&id=<?php echo $result['id'] ?>" class="btn btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <?php if (has_permission(PERMISSION_DELETE)) { ?>
                                    <a href="?action=delete&id=<?php echo $result['id']; ?>" class="btn btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this song?');">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <?php } // end has permission check ?>

                                </td>
                            </tr>
                        <?php } // end while ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 col-xs-12">
                    <div class="pagination_item_block">
                        <!--                <nav>
                        <?php /*include("pagination.php");*/ ?>
                    </nav>-->
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<?php } ?>




