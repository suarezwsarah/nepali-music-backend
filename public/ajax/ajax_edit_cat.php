<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$errors = [];
$category_id = '';
$category_name = '';
$succeed_msg = '';


if (is_post_request()) {
    $category_id = $_POST['cat_id'];
    $category_name = $_POST['category_name'];

    if (is_blank($category_id)) {
        $errors[] = 'Category id is required';
    }

    if (is_blank($category_name)) {
        $errors[] = 'Category name cant be blank';
    }

    if (empty($errors)) {
        $field = [
            "id" => $category_id,
            "name" => $category_name
        ];

        $update_succeed = update_table('category', $field);

        if ($update_succeed) {
            $succeed_msg = 'Successfully updated';
            echo $succeed_msg;
        }

    }

}

?>

<?php db_disconnect($db); ?>

