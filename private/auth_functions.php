<?php

  // Performs all actions necessary to log in an admin
  function log_in_admin($admin) {
  // Renerating the ID protects the admin from session fixation.
    session_regenerate_id();
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['username'] = $admin['username'];
    populate_user_roles();
    return true;
  }

  function populate_user_roles() {
    global $db;
    $sql = "SELECT r.* FROM role r INNER JOIN user_role ur ON ur.role_id = r.id WHERE ur.user_id = " . $_SESSION['admin_id'];
    $results = mysqli_query($db, $sql);
    $roles = [];
    while ($result = mysqli_fetch_assoc($results)) {
      $roles[] = $result;
    }
    mysqli_free_result($results);
    $_SESSION['roles'] = $roles;
  }

  // Create 2D array of permission map
  // Whenever we want to check the current user permission
  // We first find the current role of user and map to
  // to the available permission in Permission map
  function has_permission($permission_type) {
    $permission_map = [
        'ADMIN' => [PERMISSION_EDIT, PERMISSION_DELETE, PERMISSION_UPDATE]
    ];
    foreach ($_SESSION['roles'] as $role) {
      if ($role['name'] === 'ADMIN') {
        return in_array($permission_type, $permission_map[$role['name']]);
      }
    }
  }

  // Performs all actions necessary to log out an admin
  function log_out_admin() {
    unset($_SESSION['admin_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['username']);
    // session_destroy(); // optional: destroys the whole session
    return true;
  }

  function get_current_username() {
    return $_SESSION['username'];
  }


  // is_logged_in() contains all the logic for determining if a
  // request should be considered a "logged in" request or not.
  // It is the core of require_login() but it can also be called
  // on its own in other contexts (e.g. display one link if an admin
  // is logged in and display another link if they are not)
  function is_logged_in() {
    // Having a admin_id in the session serves a dual-purpose:
    // - Its presence indicates the admin is logged in.
    // - Its value tells which admin for looking up their record.
    return isset($_SESSION['admin_id']);
  }

  // Call require_login() at the top of any page which needs to
  // require a valid login before granting acccess to the page.
  // If a user came from page other than normal login in secure page
  // store the required url in the session so they can be redirect after
  // loggin into the page
  function require_login() {
    if(!is_logged_in()) {
      $request_page_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING'];
      do_audit_log('URL', $request_page_uri);
      //$_SESSION['page_to_redirect'] = $request_page_uri;
      redirect_to(url_for('/index.php'));
    } else {
      // Do nothing, let the rest of the page proceed
    }
  }

?>
