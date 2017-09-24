<footer class="app-footer">
    <div class="row">
        <div class="col-xs-12">
            <div class="footer-copyright">Copyright © <?php echo date('Y');?> <a href="#" target="_blank">Music Online</a>. All Rights Reserved.</div>
        </div>
    </div>
</footer>
</div>
</div>
<script type="text/javascript" src="<?php echo url_for('/js/vendor.js') ?>"></script>
<script type="text/javascript" src="<?php echo url_for('/js/app.js') ?>"> </script>
</body>
</html>

<?php db_disconnect($db); ?>
