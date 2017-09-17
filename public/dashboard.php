<?php require_once('../private/initialize.php'); ?>

<?php require_login() ?>

<?php include(SHARED_PATH . '/public_meromusic_header.php'); ?>

<div class="btn-floating" id="help-actions">
    <div class="btn-bg"></div>
    <button type="button" class="btn btn-default btn-toggle" data-toggle="toggle" data-target="#help-actions"><i
                class="icon fa fa-plus"></i> <span class="help-text">Shortcut</span></button>
    <div class="toggle-content">
        <ul class="actions">
            <li><a href="http://www.viaviweb.com" target="_blank">Website</a></li>
            <li><a href="Documentation/index.html" target="_blank">Documentation</a></li>
            <li><a href="https://codecanyon.net/user/viaviwebtech?ref=viaviwebtech" target="_blank">About</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><a href="manage_category.php"
                                                         class="card card-banner card-green-light">
            <div class="card-body"><i class="icon fa fa-sitemap fa-4x"></i>
                <div class="content">
                    <div class="title">Categories</div>
                    <div class="value"><span class="sign"></span> 500 </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><a href="manage_artist.php"
                                                         class="card card-banner card-green-light">
            <div class="card-body"><i class="icon fa fa-buysellads fa-4x"></i>
                <div class="content">
                    <div class="title">Artist</div>
                    <div class="value"><span class="sign"></span>300</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><a href="manage_mp3.php"
                                                         class="card card-banner card-yellow-light">
            <div class="card-body"><i class="icon fa fa-music fa-4x"></i>
                <div class="content">
                    <div class="title">Mp3 Songs</div>
                    <div class="value"><span class="sign"></span>200</div>
                </div>
            </div>
        </a>
    </div>
</div>

<?php include(SHARED_PATH . '/public_meromusic_footer.php'); ?>
