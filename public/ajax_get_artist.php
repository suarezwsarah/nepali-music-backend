<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

// return only 1 artist if the url has artist id
$has_id = $_GET && array_key_exists('id', $_GET) && !is_blank($_GET['id']) ?? false;
$has_search_key = $_GET && !is_blank($_GET['search_txt']);

$results = [];

if ($has_id) {

}
else if ($has_search_key) {
    $result_artists = [];
    $artists = find_results_query('artist', 'first_name', $_GET['search_txt'], true);
    while ($current_artist = mysqli_fetch_assoc($artists)) {
        $result_artists[] = $current_artist;
    }
    mysqli_free_result($artists);
    db_disconnect($db);
    $results['status'] = true;
    $results['data'] = $result_artists;
    echo json_encode($results);
} else {
    $results['status'] = 'true';
    $results['data'] = get_artists();
    echo json_encode($results);
}

function get_artists($id = null) {
    global $db;
    $result_artists = [];
    if ($id) {

    } else {
        $artists = find_results_query('artist');
        while ($current_artist = mysqli_fetch_assoc($artists)) {
            $result_artists[] = $current_artist;
        }
        mysqli_free_result($artists);
        db_disconnect($db);
        return $result_artists;
    }
}


?>