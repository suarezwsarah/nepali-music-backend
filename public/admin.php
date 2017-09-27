<?php

require_once('../private/initialize.php');

require_login();

$page_title = 'admin';

$javascript_files = ['admin']; // arrays of js file need for this script

$template_vars = [
    'num_categories' => tbl_count_query('category'),
    'num_artists' => tbl_count_query('artist'),
    'num_mp3s' =>  tbl_count_query('mp3')
];

include(SHARED_PATH . '/public_header.php');

include(PUBLIC_PATH . '/template/admin.php');

include(SHARED_PATH . '/public_footer.php');

// clean up at the end
unset($template_vars);

?>