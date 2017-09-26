<?php require_once('../private/initialize.php');
require_login();

$page_title = 'categories';

$javascript_files = ['category']; // arrays of js file need for this script

include(SHARED_PATH . '/public_header.php');

include (PUBLIC_PATH . '/template/category.php');

include(SHARED_PATH . '/public_footer.php');

?>
