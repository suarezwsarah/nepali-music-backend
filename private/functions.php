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

function has_img_file($file_arr_key) {
    return $_FILES !== null && !empty($_FILES) && array_key_exists($file_arr_key, $_FILES);
}

function valid_img_extension($image_file_type) {
    $acceptable_format = ['jpg', 'png', 'jpeg', 'gif'];
    return in_array($image_file_type, $acceptable_format);
}

// This function will compress and save the image
function compress_and_save_image($source_url, $destination_url, $quality) {

    $info = getimagesize($source_url);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source_url);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source_url);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source_url);

    return imagejpeg($image, $destination_url, $quality);

}


function create_thumb_img($actual_img_path, $thump_path, $thump_width, $thump_height) {
    list($width, $height) = getimagesize($actual_img_path);
    // create an image identifier representing the size of thumb image we want to create
    $create_thumb = imagecreatetruecolor($thump_width, $thump_height);
    $actual_image_extension = pathinfo($actual_img_path, PATHINFO_EXTENSION);

    $source = null;
    switch ($actual_image_extension) {
        case 'jpg' || 'jpeg' :
            $source = imagecreatefromjpeg($actual_img_path);
            break;
        case 'png' :
            $source = imagecreatefromjpeg($actual_img_path);
            break;
        case 'gif' :
            $source = imagecreatefromgif($actual_img_path);
            break;
        default:
            $source = imagecreatefromjpeg($actual_img_path);
    }

    $image_resized = imagecopyresized($create_thumb, $source, 0, 0,0,0, $thump_width, $thump_height, $width, $height);

    if ($image_resized && $source !== null) {
        if ($actual_image_extension === 'jpg' || $actual_image_extension === 'jpeg') {
            return imagejpeg($create_thumb, $thump_path, 80);
        } else if ($actual_image_extension === 'png') {
            return imagepng($create_thumb, $thump_path, 80);
        } else if ($actual_image_extension === 'gif') {
            return imagegif($create_thumb, $thump_path, 80);
        }
    }

}

function delete_image($path) {
    return unlink($path);
}

?>
