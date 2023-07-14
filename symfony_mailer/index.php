<?php 
session_start();
$message = '';

require_once '../vendor/autoload.php';
include 'mailer.php';
include view_path('_header.php');
?>

<form method="post">
    <h1>Symfomy Mailer</h1>
    <?php include view_path('_form.php')?>
    <button type="submit">Send</button>
</form>

<?php include view_path('_footer.php');?>