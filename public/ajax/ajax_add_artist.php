<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

$errors = [];
$artist_id = '';
$artist_name = '';
$succeed_msg = '';
$results = [];

if (is_get_request()) {

    $is_check_img_req = is_get_defined('check_img');

    if ($is_check_img_req) {
        $image_file_name = SERVER_ROOT . url_for('/images/') . $_GET['check_img'];
        $image_already_in_server = file_exists($image_file_name);
        if ($image_already_in_server) {
            $results['status'] = true;
            $results['exists'] = true;
        } else {
            $results['status'] = true;
            $results['exists'] = false;
        }
        echo json_encode($results);
    }

}

if (is_post_request()) {

    $artist_first_name = $_POST['artist_first_name'] ?? '';
    $artist_last_name = $_POST['artist_last_name'] ?? '';

    if (is_blank($artist_first_name)) {
        $errors[] = 'Artist name is required';
    }

    if (is_blank($artist_last_name)) {
        $errors[] = 'Artist last name is required';
    }

    // Check if artist has image in ajax request
    $has_image = has_img_file('artist_image');

    if ($has_image) {
        $file = $_FILES['artist_image'];
        // step 1 get image directory
        $img_dir = SERVER_ROOT . url_for('/images/');
        // step 2 create the name of image...it will be the actual file name of what user uploaded
        // lowercase the string and remove all the spaces from the name
        $img_name = strtolower($file['name']);
        $img_name = str_replace(' ', '', $img_name);
        // create image path to store the image
        $img_path = $img_dir . basename($img_name);

        $is_image = getimagesize($file['tmp_name']);

        if ($is_image == false) {
            $errors[] = 'File you selected is not an image';
        }

        if (file_exists($img_path)) {
            $errors[] = 'Image you are trying to upload is already on the server';
        }

        $image_file_type = pathinfo($img_path, PATHINFO_EXTENSION);

        if (!valid_img_extension($image_file_type)) {
            $errors[] = 'Invalid image extension';
        }

        if (empty($errors)) {
            // upload the main image
            $uploaded =  compress_and_save_image($file['tmp_name'], $img_path, 80);
            // also create the thumb of the image
            $thumb_path = $img_dir . 'thumbs/' . $img_name;
            $thumb_img_created = create_thumb_img($img_path, $thumb_path, 200, 200);

            // insert into artist
            $thumb_server_path = url_for('/images/thumbs/') . $img_name;
            $fields = ['first_name' => $artist_first_name, 'last_name' => $artist_last_name, 'img_url' => $thumb_server_path, 'active' => 1];
            $add_artist =  insert_table('artist', $fields);

            if ($uploaded) {
                $succeed_msg = 'Sucessfully uploaded the image';
                $results['status'] = 'true';
                $results['msg'] = $succeed_msg;
            }
        } else {
            $results['error'] = $errors;
        }

        echo json_encode($results);

    }
}

?>

<?php db_disconnect($db); ?>

