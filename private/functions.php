<?php

function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

function get_stylesheet($filename) {
  return url_for('/stylesheets/' . $filename . '.css');
}

function get_img($filename) {
  return url_for('/images/' . $filename);
}

function get_js($filename) {
  return url_for('/js/' . $filename . '.js');
}

function u($string="") {
  return urlencode($string);
}

function raw_u($string="") {
  return rawurlencode($string);
}

function h($string="") {
  return htmlspecialchars($string);
}

function error_404() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

function error_500() {
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

function redirect_to($location) {
  header("Location: " . $location);
  exit;
}

function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}

function display_my_errors($errors = array()) {
  $output = '';
  if (!empty($errors)) {
    $output .= '<div class="alert alert-danger  alert-dismissible" role="alert">';
    foreach ($errors as $error) {
          $output .= "<p> ${error} </p>";
    }
    $output .= '</div>';
  }
  return $output;
}

// Display error inside login secured pages
function display_my_errors_sec_pages($errors = array()) {
  if (!empty($errors)) {
      $output = '<div class="alert alert-danger alert-dismissible" role="alert">';
      $output .=  '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
      $output .=  '<span aria-hidden="true">×</span>';
      $output .=  '</button>';
      foreach ($errors as $error) {
          $output .= "<p>${error}</p>";
      }
      $output .= '</div>';
      return $output;
  }
}

function display_my_success_sec_pages($msgs = array()) {
    if (!empty($msgs)) {
        $output = '<div class="alert alert-success alert-dismissible" role="alert">';
        $output .=  '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        $output .=  '<span aria-hidden="true">×</span>';
        $output .=  '</button>';
        foreach ($msgs as $msg) {
            $output .= "<p>${msg}</p>";
        }
        $output .= '</div>';
        return $output;
    }
}


function get_and_clear_session_message() {
  if(isset($_SESSION['message']) && $_SESSION['message'] != '') {
    $msg = $_SESSION['message'];
    unset($_SESSION['message']);
    return $msg;
  }
}

function display_session_message() {
  $msg = get_and_clear_session_message();
  if(!is_blank($msg)) {
    return '<div id="message">' . h($msg) . '</div>';
  }
}

function trimed_array($arr = array()) {
  return array_map('trim', $arr);
}

?>
