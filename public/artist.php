<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php $page_title = 'artist';  ?>

<?php $javascript_files = ['artist']; // arrays of js file need for this script ?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div class="row">
    <div class="col-xs-12">
    <div class="card mrg_bottom">
        <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
                <div class="page_title">Manage Artist</div>
            </div>
            <div class="col-md-7 col-xs-12">
                <div class="search_list">
                    <div class="add_btn_primary"><a href="#" id="linkAddArtist">Add Artist</a></div>
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
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>

<!-- Modal -->
<div class="modal fade" id="addEditArtistModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Artist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12 col-sm-12" id="modalMessages">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card-body mrg_bottom">
                            <form action="#" id="addArtistForm" name="addartist" method="post" class="form form-horizontal" enctype="multipart/form-data">
                                <input type="hidden" id="hiddenInputArtistId"/>
                                <div class="section">
                                    <div class="section-body">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">First Name : </label>
                                            <div class="col-md-6">
                                                <input type="text" name="artist_first_name" id="inputArtistFirstName" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Last Name : </label>
                                            <div class="col-md-6">
                                                <input type="text" name="artist_last_name" id="inputArtistLastName"  class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Image : </label>
                                            <div class="col-md-6">
                                                <div class="fileupload_block">
                                                    <input type="file" name="artist_image" value="fileupload" id="artistFileUploadInput">
                                                    <div class="fileupload_img"><img type="image" id="imgAristEditDisplay" src="" alt="category image"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnAddCatModalSave" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->

<script type="text/template" id="templateArtistTr">
    <tr>
        <td contenteditable onblur="ArtistCrud.update('{{id}}', this)">{{firstName}} {{lastName}}</td>
        <td><span class="category_img"><img src="{{imgUrl}}"/></span></td>
        <td>
            <button onclick="ArtistCrud.edit('{{id}}')" class="btn btn-primary"><i class="fa fa-edit"></i></button>
            <button onclick="ArtistCrud.delete('{{id}}');" class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </td>
    </tr>
</script>

<script type="text/template" id="templateModalMessages">
    <div class="alert alert-{{msgType}} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <p>{{msg}}</p>
    </div>
</script>