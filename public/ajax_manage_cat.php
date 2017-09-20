<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php

if ($_GET && !is_blank($_GET['search_txt'])) {
    $filter_string = $_GET['search_txt'];
    $categories = find_results_query('category', 'name', $filter_string, true);
} else {
    $categories = find_results_query('category');
}
?>
<?php $counter = 1; ?>
<?php while ($category = mysqli_fetch_assoc($categories)) { ?>
    <tr>
        <?php  $id = $category['id'];  ?>
        <td tabindex="<?php echo $counter?>" onblur="updateCategory('<?php echo $id ?>',this);" class="md-col-8" data-id="<?php echo $category['id']?>" contenteditable><?php echo $category['name']?></td>
        <?php $url = url_for('edit_cat.php') . '?id=' . $category['id']; ?>
        <td class="md-col-4"><a href="<?php echo $url; ?>" class="btn btn-primary">Edit</a>
            <a href="?cat_id=" class="btn btn-default"
               onclick="return confirm('Are you sure you want to delete this category and related songs?');">Delete</a>
        </td>
    </tr>
    <?php $counter++; ?>
<?php } ?>
<?php mysqli_free_result($categories); ?>

<?php db_disconnect($db); ?>
