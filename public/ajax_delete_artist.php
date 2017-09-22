<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$errors = [];
$artist_id = '';
$artist_name = '';
$succeed_msg = '';
$results = [];

if (is_post_request()) {


        $deleted =  delete_from('artist', 'id', $_POST['id']);
        if ($deleted) {
            $results['status'] = true;
            $results['msg'] = 'deleted';
        }
        echo  json_encode($results);

}

?>

<?php db_disconnect($db); ?>

