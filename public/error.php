<?php require_once('../private/initialize.php'); ?>
<?php require_login(); ?>

<?php
$errors =  ['Error occured!!! not sure what you were really expecting..']
?>

<?php include(SHARED_PATH . '/public_meromusic_header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="page_title_block">
                <div class="col-md-5 col-xs-12">
                    <div class="page_title">Error</div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row mrg-top">
                <div class="col-md-12">

                    <div class="col-md-12 col-sm-12">
                        <?php echo display_my_errors_sec_pages($errors); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include(SHARED_PATH . '/public_meromusic_footer.php'); ?>
