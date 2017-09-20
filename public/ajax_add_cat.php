<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$errors = [];
$category_name = '';
$succeed_msgs = [];

function get_input_categories()
{
    $categories = [];
    foreach ($_POST as $key => $value) {
        if (preg_match('/category_name/', $key)) {
            if (is_blank($value)) {
                $errors[] = 'Category name cant be blank';
            } else {
                $categories[$key] = $value;
            }
        }
    }
    return $categories;
}

if (is_post_request()) {

    $categories = get_input_categories();

    if (empty($errors)) {
        foreach ($categories as $cat_name => $cat_val) {
            $fields = ['name' => $cat_val];
            $insert_category = insert_table('category', $fields);
            if ($insert_category) {
                $succeed_msgs[] = "Sucessfully inserted ${cat_val}";
            }
        }
    }

    foreach ($succeed_msgs as $succeed_msg) {
        echo "${succeed_msg} </br>";
    }
}

?>
