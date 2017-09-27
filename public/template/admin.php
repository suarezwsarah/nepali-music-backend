<div class="row" ng-controller="adminCtrl">
    <div class="col-xs-12">
        <br/>
        <div class="row" ng-hide="isHidePanel">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><a ng-click="getUsers()" href="#"
                                                                 class="card card-banner card-green-light">
                    <div class="card-body"><i class="icon fa fa-users fa-4x"></i>
                        <div class="content">
                            <div class="title">Manage user</div>
                            <div class="value"><span class="sign"></span></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><a href="artist.php"
                                                                 class="card card-banner card-green-light">
                    <div class="card-body"><i class="icon fa fa-globe fa-4x"></i>
                        <div class="content">
                            <div class="title">Artist</div>
                            <div class="value"><span class="sign"></span>Test</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><a href="mp3.php"
                                                                 class="card card-banner card-yellow-light">
                    <div class="card-body"><i class="icon fa fa-music fa-4x"></i>
                        <div class="content">
                            <div class="title">Mp3 Songs</div>
                            <div class="value"><span class="sign"></span>Test</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row"  ng-show="showUserTable">
            <div class="col-xs-12">
            <div class="card mrg_bottom">
                <div class="col-md-12 mrg-top" id="divManageCatTbl">
                    <table class="table table-striped table-bordered table-hover" id="tblCategory">
                        <thead>
                        <tr>
                            <th class="col-md-3">First Name</th>
                            <th class="col-md-3">Last Name</th>
                            <th class="col-md-3">Email</th>
                            <th class="col-md-3 cat_action_list">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="user in users track by $index">
                            <td>{{user.first_name}}</td>
                            <td>{{user.last_name}}</td>
                            <td>{{user.email}}</td>
                            <td>
                                <button ng-click="editUser(user.id)" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>
            </div>
            </div>
        </div>

    </div>

    <!-- Modal start-->
    <!-- Modal -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
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
                                            <label class="col-md-4 control-label">First Name</label>
                                            <div class="col-md-8">
                                                <input ng-model="currentUser.first_name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Last Name</label>
                                            <div class="col-md-8">
                                                <input ng-model="currentUser.last_name" name="category_name_1" id="category_name_1"
                                                       class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Email</label>
                                            <div class="col-md-8">
                                                <input ng-model="currentUser.email" name="category_name_1" id="category_name_1"
                                                       class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Active</label>
                                            <div class="col-md-8">
                                                <input name="category_name_1" id="category_name_1"
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
                    <button type="button" ng-click="updateUser()" id="btnAddCatModalSave" class="btn btn-primary"><span>Save changes</span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal end-->

</div> <!-- end adminCtrl-->

