<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<script src="<?php echo get_js('manage_artist'); ?>"></script>

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
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-6">
                        <input name="search_cat_input" id="searchArtistInputBox" value=""
                               class="form-control" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mrg-top" id="divManageArtistTbl">
            <table class="table table-striped table-bordered table-hover" id="tblArtist">
                <thead>
                <tr>
                    <th>Artist Name</th>
                    <th>Artist Image</th>
                    <th class="cat_action_list">Action</th>
                </tr>
                </thead>
                <tbody id="manageArtistTblBody">
                </tbody>
            </table>
        </div>

        <div class="clearfix"></div>
    </div>
</div>

<script type="text/template" id="templateArtistTr">
    <tr>
        <td contenteditable onblur="ArtistCrud.update('{{id}}', this)">{{firstName}} {{lastName}}</td>
        <td><span class="category_img"><img src="#"/></span></td>
        <td>
            <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i></a>
            <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
</script>
