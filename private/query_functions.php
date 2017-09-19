<?php


// Subjects

function find_all_subjects($options = [])
{
    global $db;

    $visible = $options['visible'] ?? false;

    $sql = "SELECT * FROM subjects ";
    if ($visible) {
        $sql .= "WHERE visible = true ";
    }
    $sql .= "ORDER BY position ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_subject_by_id($id, $options = [])
{
    global $db;

    $visible = $options['visible'] ?? false;

    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    if ($visible) {
        $sql .= "AND visible = true";
    }
    // echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; // returns an assoc. array
}

function validate_subject($subject)
{
    $errors = [];

    // menu_name
    if (is_blank($subject['menu_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif (!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
    }

    // position
    // Make sure we are working with an integer
    $postion_int = (int)$subject['position'];
    if ($postion_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }
    if ($postion_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string)$subject['visible'];
    if (!has_inclusion_of($visible_str, ["0", "1"])) {
        $errors[] = "Visible must be true or false.";
    }

    return $errors;
}

function insert_subject($subject)
{
    global $db;

    $errors = validate_subject($subject);
    if (!empty($errors)) {
        return $errors;
    }

    shift_subject_positions(0, $subject['position']);

    $sql = "INSERT INTO subjects ";
    $sql .= "(menu_name, position, visible) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $subject['menu_name']) . "',";
    $sql .= "'" . db_escape($db, $subject['position']) . "',";
    $sql .= "'" . db_escape($db, $subject['visible']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_subject($subject)
{
    global $db;

    $errors = validate_subject($subject);
    if (!empty($errors)) {
        return $errors;
    }

    $old_subject = find_subject_by_id($subject['id']);
    $old_position = $old_subject['position'];
    shift_subject_positions($old_position, $subject['position'], $subject['id']);

    $sql = "UPDATE subjects SET ";
    $sql .= "menu_name='" . db_escape($db, $subject['menu_name']) . "', ";
    $sql .= "position='" . db_escape($db, $subject['position']) . "', ";
    $sql .= "visible='" . db_escape($db, $subject['visible']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $subject['id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}

function delete_subject($id)
{
    global $db;

    $old_subject = find_subject_by_id($id);
    $old_position = $old_subject['position'];
    shift_subject_positions($old_position, 0, $id);

    $sql = "DELETE FROM subjects ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function shift_subject_positions($start_pos, $end_pos, $current_id = 0)
{
    global $db;

    if ($start_pos == $end_pos) {
        return;
    }

    $sql = "UPDATE subjects ";
    if ($start_pos == 0) {
        // new item, +1 to items greater than $end_pos
        $sql .= "SET position = position + 1 ";
        $sql .= "WHERE position >= '" . db_escape($db, $end_pos) . "' ";
    } elseif ($end_pos == 0) {
        // delete item, -1 from items greater than $start_pos
        $sql .= "SET position = position - 1 ";
        $sql .= "WHERE position > '" . db_escape($db, $start_pos) . "' ";
    } elseif ($start_pos < $end_pos) {
        // move later, -1 from items between (including $end_pos)
        $sql .= "SET position = position - 1 ";
        $sql .= "WHERE position > '" . db_escape($db, $start_pos) . "' ";
        $sql .= "AND position <= '" . db_escape($db, $end_pos) . "' ";
    } elseif ($start_pos > $end_pos) {
        // move earlier, +1 to items between (including $end_pos)
        $sql .= "SET position = position + 1 ";
        $sql .= "WHERE position >= '" . db_escape($db, $end_pos) . "' ";
        $sql .= "AND position < '" . db_escape($db, $start_pos) . "' ";
    }
    // Exclude the current_id in the SQL WHERE clause
    $sql .= "AND id != '" . db_escape($db, $current_id) . "' ";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}


// Pages

function find_all_pages()
{
    global $db;

    $sql = "SELECT * FROM pages ";
    $sql .= "ORDER BY subject_id ASC, position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_page_by_id($id, $options = [])
{
    global $db;

    $visible = $options['visible'] ?? false;

    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    if ($visible) {
        $sql .= "AND visible = true";
    }
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $page; // returns an assoc. array
}

function validate_page($page)
{
    $errors = [];

    // subject_id
    if (is_blank($page['subject_id'])) {
        $errors[] = "Subject cannot be blank.";
    }

    // menu_name
    if (is_blank($page['menu_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif (!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
    }
    $current_id = $page['id'] ?? '0';
    if (!has_unique_page_menu_name($page['menu_name'], $current_id)) {
        $errors[] = "Menu name must be unique.";
    }


    // position
    // Make sure we are working with an integer
    $postion_int = (int)$page['position'];
    if ($postion_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }
    if ($postion_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string)$page['visible'];
    if (!has_inclusion_of($visible_str, ["0", "1"])) {
        $errors[] = "Visible must be true or false.";
    }

    // content
    if (is_blank($page['content'])) {
        $errors[] = "Content cannot be blank.";
    }

    return $errors;
}

function insert_page($page)
{
    global $db;

    $errors = validate_page($page);
    if (!empty($errors)) {
        return $errors;
    }

    shift_page_positions(0, $page['position'], $page['subject_id']);

    $sql = "INSERT INTO pages ";
    $sql .= "(subject_id, menu_name, position, visible, content) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $page['subject_id']) . "',";
    $sql .= "'" . db_escape($db, $page['menu_name']) . "',";
    $sql .= "'" . db_escape($db, $page['position']) . "',";
    $sql .= "'" . db_escape($db, $page['visible']) . "',";
    $sql .= "'" . db_escape($db, $page['content']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_page($page)
{
    global $db;

    $errors = validate_page($page);
    if (!empty($errors)) {
        return $errors;
    }

    $old_page = find_page_by_id($page['id']);
    $old_position = $old_page['position'];
    shift_page_positions($old_position, $page['position'], $page['subject_id'], $page['id']);

    $sql = "UPDATE pages SET ";
    $sql .= "subject_id='" . db_escape($db, $page['subject_id']) . "', ";
    $sql .= "menu_name='" . db_escape($db, $page['menu_name']) . "', ";
    $sql .= "position='" . db_escape($db, $page['position']) . "', ";
    $sql .= "visible='" . db_escape($db, $page['visible']) . "', ";
    $sql .= "content='" . db_escape($db, $page['content']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $page['id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}

function delete_page($id)
{
    global $db;

    $old_page = find_page_by_id($id);
    $old_position = $old_page['position'];
    shift_page_positions($old_position, 0, $old_page['subject_id'], $id);

    $sql = "DELETE FROM pages ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_pages_by_subject_id($subject_id, $options = [])
{
    global $db;

    $visible = $options['visible'] ?? false;

    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE subject_id='" . db_escape($db, $subject_id) . "' ";
    if ($visible) {
        $sql .= "AND visible = true ";
    }
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function count_pages_by_subject_id($subject_id, $options = [])
{
    global $db;

    $visible = $options['visible'] ?? false;

    $sql = "SELECT COUNT(id) FROM pages ";
    $sql .= "WHERE subject_id='" . db_escape($db, $subject_id) . "' ";
    if ($visible) {
        $sql .= "AND visible = true ";
    }
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $row = mysqli_fetch_row($result);
    mysqli_free_result($result);
    $count = $row[0];
    return $count;
}

function shift_page_positions($start_pos, $end_pos, $subject_id, $current_id = 0)
{
    global $db;

    if ($start_pos == $end_pos) {
        return;
    }

    $sql = "UPDATE pages ";
    if ($start_pos == 0) {
        // new item, +1 to items greater than $end_pos
        $sql .= "SET position = position + 1 ";
        $sql .= "WHERE position >= '" . db_escape($db, $end_pos) . "' ";
    } elseif ($end_pos == 0) {
        // delete item, -1 from items greater than $start_pos
        $sql .= "SET position = position - 1 ";
        $sql .= "WHERE position > '" . db_escape($db, $start_pos) . "' ";
    } elseif ($start_pos < $end_pos) {
        // move later, -1 from items between (including $end_pos)
        $sql .= "SET position = position - 1 ";
        $sql .= "WHERE position > '" . db_escape($db, $start_pos) . "' ";
        $sql .= "AND position <= '" . db_escape($db, $end_pos) . "' ";
    } elseif ($start_pos > $end_pos) {
        // move earlier, +1 to items between (including $end_pos)
        $sql .= "SET position = position + 1 ";
        $sql .= "WHERE position >= '" . db_escape($db, $end_pos) . "' ";
        $sql .= "AND position < '" . db_escape($db, $start_pos) . "' ";
    }
    // Exclude the current_id in the SQL WHERE clause
    $sql .= "AND id != '" . db_escape($db, $current_id) . "' ";
    $sql .= "AND subject_id = '" . db_escape($db, $subject_id) . "'";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}


// Admins

// Find all admins, ordered last_name, first_name
function find_all_admins()
{
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "ORDER BY last_name ASC, first_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_admin_by_id($id)
{
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
}

function find_admin_by_username($username)
{
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
}

function validate_admin($admin, $options = [])
{

    $password_required = $options['password_required'] ?? true;

    if (is_blank($admin['first_name'])) {
        $errors[] = "First name cannot be blank.";
    } elseif (!has_length($admin['first_name'], array('min' => 2, 'max' => 255))) {
        $errors[] = "First name must be between 2 and 255 characters.";
    }

    if (is_blank($admin['last_name'])) {
        $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($admin['last_name'], array('min' => 2, 'max' => 255))) {
        $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if (is_blank($admin['email'])) {
        $errors[] = "Email cannot be blank.";
    } elseif (!has_length($admin['email'], array('max' => 255))) {
        $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($admin['email'])) {
        $errors[] = "Email must be a valid format.";
    }

    if (is_blank($admin['username'])) {
        $errors[] = "Username cannot be blank.";
    } elseif (!has_length($admin['username'], array('min' => 8, 'max' => 255))) {
        $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($admin['username'], $admin['id'] ?? 0)) {
        $errors[] = "Username not allowed. Try another.";
    }

    if ($password_required) {
        if (is_blank($admin['password'])) {
            $errors[] = "Password cannot be blank.";
        } elseif (!has_length($admin['password'], array('min' => 12))) {
            $errors[] = "Password must contain 12 or more characters";
        } elseif (!preg_match('/[A-Z]/', $admin['password'])) {
            $errors[] = "Password must contain at least 1 uppercase letter";
        } elseif (!preg_match('/[a-z]/', $admin['password'])) {
            $errors[] = "Password must contain at least 1 lowercase letter";
        } elseif (!preg_match('/[0-9]/', $admin['password'])) {
            $errors[] = "Password must contain at least 1 number";
        } elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
            $errors[] = "Password must contain at least 1 symbol";
        }

        if (is_blank($admin['confirm_password'])) {
            $errors[] = "Confirm password cannot be blank.";
        } elseif ($admin['password'] !== $admin['confirm_password']) {
            $errors[] = "Password and confirm password must match.";
        }
    }

    return $errors;
}

function insert_admin($admin)
{
    global $db;

    $errors = validate_admin($admin);
    if (!empty($errors)) {
        return $errors;
    }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO admins ";
    $sql .= "(first_name, last_name, email, username, hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $admin['first_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['last_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['email']) . "',";
    $sql .= "'" . db_escape($db, $admin['username']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function update_admin($admin)
{
    global $db;

    $password_sent = !is_blank($admin['password']);

    $errors = validate_admin($admin, ['password_required' => $password_sent]);
    if (!empty($errors)) {
        return $errors;
    }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE admins SET ";
    $sql .= "first_name='" . db_escape($db, $admin['first_name']) . "', ";
    $sql .= "last_name='" . db_escape($db, $admin['last_name']) . "', ";
    $sql .= "email='" . db_escape($db, $admin['email']) . "', ";
    if ($password_sent) {
        $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
    }
    $sql .= "username='" . db_escape($db, $admin['username']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_admin($admin)
{
    global $db;

    $sql = "DELETE FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_all_categories()
{
    global $db;
    $sql = "SELECT * FROM category";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_category_by_id($id)
{
    global $db;
    $sql = "SELECT * FROM category ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $category = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $category;
}

function find_all_from($table_name)
{
    global $db;
    $sql = "SELECT * FROM ${table_name}";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_mp3_by_id($id)
{
    global $db;
    $sql = "SELECT * FROM mp3 ";
    $sql .= "WHERE id=" . db_escape($db, $id);
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $mp3 = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $mp3;
}

function find_mp3_artist_by_mp3_id($id)
{
    return find_by_id('mp3_id', $id, 'mp3_artist', 'artist_id', 'artist');
}

function find_mp3_category_by_mp3_id($id) {
    return find_by_id('mp3_id', $id, 'mp3_category', 'category_id', 'category');
}

function find_by_id($junction_tbl_id_nm, $junction_tbl_id_val, $junction_tbl, $actual_tbl_id, $actual_tbl)
{
    global $db;
    $junction_tbl_id_nm = db_escape($db, $junction_tbl_id_nm);
    $junction_tbl_id_val = db_escape($db, $junction_tbl_id_val);
    $sql = "SELECT * FROM ${junction_tbl} WHERE ${junction_tbl_id_nm} = ${junction_tbl_id_val}";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $ids = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $ids[] = $row[$actual_tbl_id];
    }
    mysqli_free_result($result);
    $actual_tbl_ids = implode(",", $ids);
    $sql = "SELECT * FROM ${actual_tbl} WHERE id IN (" . $actual_tbl_ids . ")";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function update_table($table_name, $fields)
{
    global $db;
    $sql = "UPDATE ${table_name} SET ";
    foreach ($fields as $field_name => $field_value) {
        if ($field_name != 'id') {
            $clean_field_name = db_escape($db, $field_name);
            $clean_field_value = db_escape($db, $field_value);
            $sql .= $clean_field_name . " = " . "'${clean_field_value}' ,";
        }
    }

    $last_comma_position = strrpos($sql, ',');
    $sql = substr($sql, 0, $last_comma_position);

    $sql .= "WHERE id = " . db_escape($db, $fields['id']) . ' ';
    $sql .= "LIMIT 1";
    do_audit_log('SQL', $sql);
    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function insert_table($table_name, $fields)
{
    global $db;
    $sql = "INSERT INTO ${table_name} (";
    $field_names = array_keys($fields);

    foreach ($field_names as $field_name) {
        $sql .= $field_name . ',';
    }

    $last_comma_position = strrpos($sql, ',');
    $sql = substr($sql, 0, $last_comma_position);

    $sql .= ")";

    $sql .= ' VALUES (';

    $field_values = array_values($fields);

    foreach ($field_values as $field_value) {
        $sql .= "'" . db_escape($db, $field_value) . "',";
    }

    $last_comma_position = strrpos($sql, ',');
    $sql = substr($sql, 0, $last_comma_position);

    $sql .= ')';

    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}

function delete_from($table_name, $id_col_name, $id)
{
    global $db;
    $sql = "DELETE FROM ${table_name} WHERE ${id_col_name} = ${id}";
    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function get_array_key_by_value($input_value, $inputs = array())
{
  foreach ($inputs as $key => $value) {
    $value = trim($value);
    $input_value = trim($input_value);
    if ($value == $input_value) {
      return $key;
    }
  }
  return '';
}

function update_junction_table($input = array())
{
  global $db;
  $search_field = $input['search_field'];
  $search_table = $input['search_tbl'];
  $search_id = $input['search_id'];
  $primary_search_col_nm = $input['primary_search_col_nm'];

  $sql = "SELECT ${search_field} FROM ${search_table} WHERE ${primary_search_col_nm} = ${search_id}";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);

  $user_selected_fields = $input['user_selected_fields'];

  while ($row = mysqli_fetch_assoc($result)) {
    if ($row != null && $row[$search_field] != null) {
      if (!in_array($row[$search_field], $user_selected_fields)) {
        $delete_row = delete_from($search_table, $search_field, $row[$search_field]);
        if ($delete_row) {
            $log_msg = "${_SESSION['username']} remove ${search_field} ${row[$search_field]} from ${search_table} table";
            do_audit_log('INFO', $log_msg);
        }
      }
    }
  }

  mysqli_free_result($result);

  $ret_result = true;
  foreach ($user_selected_fields as $user_selected_field) {
      $id = db_escape($db, $user_selected_field);
      $sql = "SELECT id  FROM ${search_table} WHERE ${primary_search_col_nm} = ${search_id} AND ${search_field} = ${id}";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      $row = mysqli_fetch_assoc($result);
      mysqli_free_result($result);
      if ($row == null) {
          $fields = [$primary_search_col_nm => $search_id, $search_field => $user_selected_field];
          $insert_result =  insert_table($search_table, $fields);
          if (!$insert_result) {
              $ret_result = false;
          }
      }
  }
  return $ret_result;
}

function update_artists($mp3_id, $artists = array())
{
    $input = [
        'search_field' => 'artist_id',
        'search_tbl' => 'mp3_artist',
        'search_id' => $mp3_id,
        'primary_search_col_nm' => 'mp3_id',
        'user_selected_fields' => $artists
    ];

    return update_junction_table($input);
}

function update_categories($mp3_id, $categories = array())
{
    $input = [
        'search_field' => 'category_id',
        'search_tbl' => 'mp3_category',
        'search_id' => $mp3_id,
        'primary_search_col_nm' => 'mp3_id',
        'user_selected_fields' => $categories
    ];

    return update_junction_table($input);
}

// Log related function

function do_audit_log($log_level, $log_text)
{
    $fields = ['log_level' => $log_level, 'log_text' => $log_text];
    return insert_table('log_audit', $fields);
}

function tbl_count_query($tbl) {
    global $db;
    $sql = "SELECT count(*) AS result FROM $tbl";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    $result_row = $row['result'];
    mysqli_free_result($result);
    return $result_row;
}

function find_config($key) {
    global $db;
    $sql = "SELECT * FROM config WHERE config_key = '" . trim($key) . "'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    $result_row = $row['config_value'];
    mysqli_free_result($result);
    return $result_row;
}

?>
