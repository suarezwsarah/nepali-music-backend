<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$results = [];
$categories = [];


if ($_GET && !is_blank($_GET['action']) && $_GET['action'] == 'count') {
    $row_count = col_count('category', 'name', trim($_GET['name']));
    $results['status'] = true;
    $results['row'] = $row_count;
    echo json_encode($results);
    db_disconnect($db);
} else if ($_GET && !is_blank($_GET['search_txt'])) {
    $filter_string = $_GET['search_txt'];
    $categories = find_results_query('category', 'name', $filter_string, true);
} else {
    $categories = find_results_query('category');
}
?>


<?php
if (!empty($categories)) {
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
}
?>
