<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$errors = [];
$category_id = '';
$category_name = '';
$succeed_msg = '';

if (is_post_request()) {
    $category_id = $_POST['id'];

    if (is_blank($category_id)) {
        $errors[] = 'Category id is required';
    }

    if (empty($errors)) {
        $delete = delete_from('category', 'id', $category_id);
        if ($delete) {
            echo 'sucessfully deleted';
        }
    }
}

?>

<?php db_disconnect($db); ?>

