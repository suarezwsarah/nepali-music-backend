<!doctype html>
<html lang="en">
<head>
    <title><?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo get_stylesheet('vendor'); ?>" />
    <link rel="stylesheet" media="all" href="<?php echo get_stylesheet('flat-admin'); ?>" />
    <link rel="stylesheet" media="all" href="<?php echo get_stylesheet('theme/blue-sky'); ?>" />
    <link rel="stylesheet" media="all" href="<?php echo get_stylesheet('theme/blue'); ?>" />
    <link rel="stylesheet" media="all" href="<?php echo get_stylesheet('theme/yellow'); ?>" />

    <script src="<?php echo url_for('/ckeditor/ckeditor.js')?>"></script>
    <script src="<?php echo get_js('jquery-3.2.1'); ?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <?php if (isset($javascript_files) && !empty($javascript_files)) { ?>
        <?php foreach ($javascript_files as $javascript_file) {  ?>
            <script src="<?php echo get_js($javascript_file); ?>"></script>
        <?php } // end foreach ?>
    <?php } // end isset?>

</head>
<body>
<div class="app app-default" id="mainAppContainer">
    <aside class="app-sidebar" id="sidebar">
        <div class="sidebar-header"> <a class="sidebar-brand" href="home.php"><img src="<?php echo get_img('app_logo.png') ?>" alt="app logo" /></a>
            <button type="button" class="sidebar-toggle"> <i class="fa fa-times"></i> </button>
        </div>
        <div class="sidebar-menu">
            <ul class="sidebar-nav" id="navBar">
                <li class="<?php if ($page_title === 'dashboard') { echo 'active'; } ?>">
                    <a href="<?php echo url_for('dashboard.php'); ?>" id="linkDashboard" data-url="<?php echo url_for('dashboard.php')?>">
                        <div class="icon"> <i class="fa fa-dashboard" aria-hidden="true"></i> </div>
                        <div class="title">Dashboard</div>
                    </a>
                </li>
                <li class="<?php if ($page_title === 'categories') { echo 'active'; } ?>"><a href="<?php echo url_for('category.php'); ?>" id="linkCategories" data-url="<?php echo url_for('category.php'); ?>">
                        <div class="icon"> <i class="fa fa-sitemap" aria-hidden="true"></i> </div>
                        <div class="title">Categories</div>
                    </a>
                </li>
                <li class="<?php if ($page_title === 'artist') { echo 'active'; } ?>"> <a href="<?php echo url_for('artist.php'); ?>" id="linkArtists">
                        <div class="icon"> <i class="fa fa-buysellads" aria-hidden="true"></i> </div>
                        <div class="title">Artist</div>
                    </a>
                </li>

                <li class="<?php if ($page_title === 'mp3') { echo 'active'; } ?>"> <a href="<?php echo url_for('mp3.php'); ?>" id="linkMp3">
                        <div class="icon"> <i class="fa fa-music" aria-hidden="true"></i> </div>
                        <div class="title">Mp3 Songs</div>
                    </a>
                </li>


                <li> <a href="<?php echo url_for('setting.php'); ?>">
                        <div class="icon"> <i class="fa fa-cog" aria-hidden="true"></i> </div>
                        <div class="title">Settings</div>
                    </a>
                </li>

            </ul>
        </div>

    </aside>
    <div class="app-container">
        <nav class="navbar navbar-default" id="navbar">
            <div class="container-fluid">
                <div class="navbar-collapse collapse in">
                    <ul class="nav navbar-nav navbar-mobile">
                        <li>
                            <button type="button" class="sidebar-toggle"> <i class="fa fa-bars"></i> </button>
                        </li>
                        <li class="logo"> <a class="navbar-brand" href="#"><?php echo find_config(APP_NAME); ?></a> </li>
                        <li>
                            <button type="button" class="navbar-toggle">
                                <img class="profile-img" src="images/<?php get_img('profile.png'); ?>">
                            </button>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-left">
                        <li class="navbar-title"><?php echo find_config(APP_NAME); ?></li>

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown profile"> <a href="profile.php" class="dropdown-toggle" data-toggle="dropdown">
                                    <img class="profile-img" src="<?php echo get_img('profile.png'); ?>">
                                <div class="title">Profile</div>
                            </a>
                            <div class="dropdown-menu">
                                <div class="profile-info">
                                    <h4 class="username"><?php echo get_current_username(); ?></h4>
                                </div>
                                <ul class="action">
                                    <li><a href="profile.php">Profile</a></li>
                                    <li><a href="<?php echo url_for('logout.php');?>">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
