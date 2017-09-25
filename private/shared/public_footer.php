<footer class="app-footer">
    <div class="row">
        <div class="col-xs-12">
            <div class="footer-copyright">Copyright © <?php echo date('Y');?> <a href="#" target="_blank">Music Online</a>. All Rights Reserved.</div>
        </div>
    </div>
</footer>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

<script>
    $('.select2').select2();
</script>
</body>
</html>

<?php db_disconnect($db); ?>
