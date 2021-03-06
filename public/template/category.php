<div class="row">
    <div class="col-xs-12">
        <div class="card mrg_bottom">
            <div class="page_title_block">
                <div class="col-md-5 col-xs-12">
                    <div class="page_title">Manage Categories</div>
                </div>
                <div class="col-md-7 col-xs-12">
                    <div class="search_list">
                        <div class="add_btn_primary">
                            <a id="addCategoryLink" href="#">Add Category</a>
                        </div>
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
                            <input name="search_cat_input" id="searchCatInputBox" value=""
                                   class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mrg-top" id="divManageCatTbl">
                <table class="table table-striped table-bordered table-hover" id="tblCategory">
                    <thead>
                    <tr>
                        <th class="col-md-8">Category</th>
                        <th class="col-md-4 cat_action_list">Action</th>
                    </tr>
                    </thead>
                    <tbody id="manageCatTblBody">
                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12 col-sm-12" id="modalErrors">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <form action="#" name="addeditcategory" method="post" class="form form-horizontal"
                              enctype="multipart/form-data">
                            <div class="section">
                                <div class="section-body" id="sectionBody">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Category Name</label>
                                        <div class="col-md-8">
                                            <input name="category_name_1" id="category_name_1" value=""
                                                   class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnAddCatModalSave" class="btn btn-primary"><span>Save changes</span></button>
            </div>
        </div>
    </div>
</div>


<!-- Template sections -->
<script type="text/template" id="myCustomTr">
    <tr>
        <td onblur="CategoryCrud.update('{{id}}', this)" tabindex="{{id}}" class="col-md-8 sd-category-editable"
            id="category_sd_{{id}}" contenteditable>{{name}}
        </td>
        <td class="md-col-4">
            <button onclick="CategoryCrud.delete('{{id}}')" class="btn btn-danger"><i
                    class="fa fa-trash"></i></button>
        </td>
    </tr>
</script>

<script type="text/template" id="templateModalError">
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <p>{{errorMessage}}</p>
    </div>
</script>