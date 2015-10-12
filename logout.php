<?php session_start(); ?>
<!doctype html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
        <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body id = "bodylogout">
    <div id = "wraper">
    <?php
$homepage = file_get_contents('includes/head_content.php');
echo $homepage;
?>
<?php
if(isset($_SESSION['korisnik']) && isset($_GET['logout'])) {
    session_destroy();
    echo '<h3>Uspešno ste se odjavili!</h3>';
}
echo '<a href="index.php">Vratite se na početnu stranu</a>';
?>
</div>
<?php
$homepage = file_get_contents('includes/foot_content.php');
echo $homepage;
?>
</body>
</html>
