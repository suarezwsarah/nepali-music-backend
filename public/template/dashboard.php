<div class="row">
        <div class="col-xs-12">

            <div class="btn-floating" id="help-actions">
                <div class="btn-bg"></div>
                <button type="button" class="btn btn-default btn-toggle" data-toggle="toggle" data-target="#help-actions"><i
                        class="icon fa fa-plus"></i> <span class="help-text">Shortcut</span></button>
                <div class="toggle-content">
                    <ul class="actions">
                        <li><a href="#" target="_blank">Website</a></li>
                        <li><a href="#" target="_blank">Documentation</a></li>
                        <li><a href="#" target="_blank">About</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><a href="category.php"
                                                                     class="card card-banner card-green-light">
                        <div class="card-body"><i class="icon fa fa-sitemap fa-4x"></i>
                            <div class="content">
                                <div class="title">Categories</div>
                                <div class="value"><span class="sign"></span><?php echo $template_vars['num_categories']; ?></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><a href="artist.php"
                                                                     class="card card-banner card-green-light">
                        <div class="card-body"><i class="icon fa fa-buysellads fa-4x"></i>
                            <div class="content">
                                <div class="title">Artist</div>
                                <div class="value"><span class="sign"></span><?php echo $template_vars['num_artists']; ?></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><a href="mp3.php"
                                                                     class="card card-banner card-yellow-light">
                        <div class="card-body"><i class="icon fa fa-music fa-4x"></i>
                            <div class="content">
                                <div class="title">Mp3 Songs</div>
                                <div class="value"><span class="sign"></span><?php echo $template_vars['num_mp3s']; ?></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
