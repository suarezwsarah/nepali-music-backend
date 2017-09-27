<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

if (is_get_request()) {
    $is_all_users = is_get_defined('type') && $_GET['type'] == 'all_users';
    $has_id = is_get_defined('id');

    if ($is_all_users) {
        $results = find_all_from('admins');
        $ret_results = [];
        while ($result = mysqli_fetch_assoc($results)) {
            $ret_results[] = $result;
        }
        mysqli_free_result($results);
        echo json_encode($ret_results);
    }

    if($has_id) {
        $id =  db_escape($db, $_GET['id']);
        $results = find_results_query('admins', 'id', "'$id'" );
        $ret_result = mysqli_fetch_assoc($results);
        echo json_encode($ret_result);
        mysqli_free_result($results);
    }


}

?>