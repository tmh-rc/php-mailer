<?php include '../vendor/autoload.php'; ?>
<?php include view_path('_header.php'); ?>

<form action="phpmailer.php" method="post">
    <h1>PHP Mailer</h1>
    <?php include view_path('_form.php') ?>
    <button type="submit">Send</button>
</form>

<?php include view_path('_footer.php'); ?>