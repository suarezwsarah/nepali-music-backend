<?php require_once('../private/initialize.php');

require_login();

function get_mp3s()
{
    global $db;
    $sql = "SELECT * FROM mp3";
    $results = mysqli_query($db, $sql);
    confirm_result_set($results);
    $ret_result = [];
    while ($result = mysqli_fetch_assoc($results)) {
        $ret_result[] = $result;
    }
    mysqli_free_result($results);
    return $ret_result;
}

function get_selected_artists($id)
{
    $results = find_mp3_artist_by_mp3_id($id);
    $ret_result = [];
    while ($result = mysqli_fetch_assoc($results)) {
        $ret_result[] = $result;
    }
    mysqli_free_result($results);
    return $ret_result;
}

function get_selected_categories($id)
{
    $results = find_mp3_category_by_mp3_id($id);
    $ret_result = [];
    while ($result = mysqli_fetch_assoc($results)) {
        $ret_result[] = $result;
    }
    mysqli_free_result($results);
    return $ret_result;
}

function find_all_artists()
{
    $ret_result = [];
    $results = find_all_from('artist');
    while ($result = mysqli_fetch_assoc($results)) {
        $ret_result[] = $result;
    }
    mysqli_free_result($results);
    return $ret_result;
}

function get_all_categories()
{
    $ret_result = [];
    $results = find_all_from('category');
    while ($result = mysqli_fetch_assoc($results)) {
        $ret_result[] = $result;
    }
    mysqli_free_result($results);
    return $ret_result;
}

function is_edit()
{
    return is_get_defined('action') && $_GET['action'] === 'edit';
}

function is_add()
{
    return is_get_request() && is_get_defined('action') && $_GET['action'] === 'add';
}

function is_delete()
{
    return is_get_request() && is_get_defined('action') && $_GET['action'] === 'delete';
}


function is_status_deactivate() {
    return is_get_defined('status_deactivate_id') && $_GET['status_deactivate_id'] !== null;
}

function is_status_activate() {
    return is_get_defined('status_activate_id') && $_GET['status_activate_id'] !== null;
}

$template_vars = [
    'errors' => [],
    'succeed_msgs' => [],
    'selected_artists' => [],
    'all_artists' => find_all_artists(),
    'selected_categories' => [],
    'all_categories' => get_all_categories(),
    'mp3' => ['id' => '', 'url' => '', 'description' => '', 'title' => '', 'duration' => '']

];

if (is_get_request()) {

    if (is_edit()) {

        $id = $_GET['id'];

        $template_vars['selected_artists'] = get_selected_artists($id);

        $template_vars['all_artists'] = find_all_artists();

        $template_vars['selected_categories'] = get_selected_categories($id);

        $template_vars['all_categories'] = get_all_categories();

        // Find the mp3
        $template_vars['mp3'] = find_mp3_by_id($id);

        $template_url = '/template/template_edit_mp3.php';

    } elseif (is_add()) {

    } elseif (is_status_deactivate()) {
        $deactivate_status_id = $_GET['status_deactivate_id'];
        $deactivate_status_id = db_escape($db, $deactivate_status_id);
        $fields = ['id' => $deactivate_status_id, 'active' => 0];
        if (update_table('mp3', $fields)) {
            redirect_to(url_for('mp3.php'));
        }
    } elseif(is_status_activate()) {
        $activate_status_id = $_GET['status_activate_id'];
        $activate_status_id = db_escape($db, $activate_status_id);
        $fields = ['id' => $activate_status_id, 'active' => 1];
        if (update_table('mp3', $fields)) {
            $succeed_msgs[] = 'Sucessfully activated';
            redirect_to(url_for('mp3.php'));
        }
    } elseif (is_delete()) {
        $id = $_GET['id'];
        $id = db_escape($db, $id);
        if (delete_from('mp3', 'id', $id)) {
            redirect_to(url_for('mp3.php'));
        }
    } else {

        $template_vars['mp3s'] = get_mp3s();

    }
}

if (is_post_request()) {

    $errors = [];
    $succeed_msgs = [];

    $errors = validate_fields(['mp3_title' => 'Mp3 title', 'mp3_duration' => 'mp3 duration']);
    $mp3_url = $_POST['mp3_url'];

    if (!preg_match('/.mp3/', $mp3_url)) {
        $errors[] = 'Invalid mp3 url';
    }

    $mp3_id = $_POST['id'] ?? '';

    if (empty($errors)) {
        $fields = ['url' => $_POST['mp3_url'], 'title' => $_POST['mp3_title'], 'duration' => $_POST['mp3_duration'], 'description' => h($_POST['mp3_description'])];
        if (is_blank($mp3_id)) {
            $mp3_id = insert_table('mp3', $fields);
            if ($mp3_id) {
                $succeed_msgs[] = 'Sucessfully added mp3';
            }
        } else {
            $fields['id'] = $mp3_id;
            $updated = update_table('mp3', $fields);
            if ($updated) {
                $succeed_msgs[] = 'Sucessfully updated';
            }
        }


        $artists = trimed_array($_POST['mp3_artist']);
        $update_artist = update_artists($mp3_id, $artists);
        if (!$update_artist) {
            $errors[] = 'Failed to update artists';
        } else {
            do_audit_log('INFO', "${_SESSION['username']} updated artists");
        }

        // update categories
        $categories = trimed_array($_POST['cat_ids']);
        $update_categories = update_categories($mp3_id, $categories);
        if ($update_categories) {
            do_audit_log('INFO', "${_SESSION['username']} updated category for mp3 id ${mp3_id}");
        } else {
            $errors[] = 'Failed to update category';
        }

    }

    $template_vars['selected_artists'] = get_selected_artists($mp3_id);

    $template_vars['selected_categories'] = get_selected_categories($mp3_id);

    // Find the mp3
    $template_vars['mp3'] = find_mp3_by_id($mp3_id);

    $template_vars['errors'] = $errors;

    $template_vars['succeed_msgs'] = $succeed_msgs;
}


$page_title = 'mp3';

include(SHARED_PATH . '/public_header.php');
include PUBLIC_PATH . '/template/mp3.php';
include(SHARED_PATH . '/public_footer.php');

unset($template_vars);
?>