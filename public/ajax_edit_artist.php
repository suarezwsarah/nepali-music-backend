<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$errors = [];
$artist_id = '';
$artist_name = '';
$succeed_msg = '';


if (is_post_request()) {
    $artist_id = $_POST['artist_id'];
    $artist_name = $_POST['first_name'];

    if (is_blank($artist_id)) {
        $errors[] = 'Category id is required';
    }

    if (is_blank($artist_name)) {
        $errors[] = 'Category name cant be blank';
    }

    if (empty($errors)) {
        $field = [
            "id" => $artist_id,
            "first_name" => $artist_name
        ];

        $update_succeed = update_table('artist', $field);

        if ($update_succeed) {
            $succeed_msg = 'Successfully updated';
            echo $succeed_msg;
        }

    }

}

?>

<?php db_disconnect($db); ?>

