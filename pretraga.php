<?php session_start();
    if(!isset($_SESSION['korisnik']) && $_SESSION['tip'] != "admin") header("Location: index.php");
    require_once('functions/database_functions.php');
?>
<!doctype html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body id = "bodypretraga">
<div id = "wraper">
    <?php
$homepage = file_get_contents('includes/head_content.php');
echo $homepage;
?>
    <p id = "pretraga"><a href="prikaz.php">Prikaz</a></p>
    <p id = "odjava"><a href="logout.php?logout=true">Odjavi se</a></p>
    <p id = "razmak"></p>   
    <h3>Pronađi radnika</h3>
    <form action="pretraga.php" method="post">
        <label for="paramIme">Unesite ime ili prezime: </label><input type="text" name="paramIme">
        <button type="submit">Pronađi</button>
    </form>
    <form action="pretraga.php" method="post">
        <?php
            padajucaListaOdeljenja();
        ?>
        <button type="submit">Prikaži</button>
    </form>
    <?php
        if(isset($_POST['paramOdeljenje'])) {
            echo '<h3>Rezultat pretrage za ' . $_POST['paramOdeljenje'] .  ' </h3>';
            radnikSaNajvecomPlatom($_POST['paramOdeljenje']);
        }
        if(isset($_POST['paramIme'])) {
            echo '<h3>Rezultat pretrage za ' .$_POST['paramIme'] .  ' </h3>';
            pretragaPoImenuIliPrezimenu($_POST['paramIme']);
        }
    ?>
</div>
        <?php
$homepage = file_get_contents('includes/foot_content.php');
echo $homepage;
?>
</body>
</html>