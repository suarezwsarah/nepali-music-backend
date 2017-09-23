<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$errors = [];
$artist_id = '';
$artist_name = '';
$succeed_msg = '';
$results = [];

if (is_post_request()) {

    mysqli_begin_transaction($db, MYSQLI_TRANS_START_READ_WRITE);

    $artist = mysqli_fetch_assoc(find_results_query('artist', 'id', $_POST['id']));

    $image_url = SERVER_ROOT . url_for('/images/') . substr($artist['img_url'], strrpos($artist['img_url'], '/'));

    $thumb_url = SERVER_ROOT . url_for('/images/thumbs/') . substr($artist['img_url'], strrpos($artist['img_url'], '/'));

    unlink($image_url);
    unlink($thumb_url);

    $deleted = delete_from('artist', 'id', $_POST['id']);
    if ($deleted) {
        $results['status'] = true;
        $results['msg'] = 'deleted';
    }
    echo json_encode($results);

    mysqli_commit($db);

}

?>

<?php db_disconnect($db); ?>

