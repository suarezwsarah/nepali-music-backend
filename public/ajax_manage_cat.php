<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

if ($_GET && !is_blank($_GET['search_txt'])) {
    $filter_string = $_GET['search_txt'];
    $categories = find_results_query('category', 'name', $filter_string, true);
} else {
    $categories = find_results_query('category');
}
?>


<?php

$results = [];
$rows = array();
while ($category = mysqli_fetch_assoc($categories)) {
    $rows[] = $category;
}

$results['status'] = true;
$results['data'] = $rows;
$results['reason'] = null;

mysqli_free_result($categories);
db_disconnect($db);
echo json_encode($results);

?>
