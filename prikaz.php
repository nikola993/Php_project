<?php session_start();
require_once('functions/database_functions.php');
    if(!isset($_SESSION['korisnik'])) { 
        if(!isset($_POST['korisnik'])) { 
            header('Location:index.php?error=UserPass');
        } else if(!validacijaKorisnika($_POST['korisnik'],$_POST['lozinka'])){
            header('Location:index.php?error=UserPass');
        }
    }
?>
<!doctype html>
<html lang="sr">
<head>
       <meta charset="UTF-8">
       <link rel="stylesheet" href="css/style.css" type="text/css">  
</head>
<body>
    <div id = "wraper">
            <?php
$homepage = file_get_contents('includes/head_content.php');
echo $homepage;
?>
    <p id = "pretraga"><a href="pretraga.php">Pretraži</a></p>
    <p id = "odjava"><a href="logout.php?logout=true">Odjavi se</a></p>
    <p id = "razmak"></p>
<?php
    if(isset($_POST['idbr']) && $_SESSION['tip']=='admin') {
            $idbr = $_POST['idbr'];
            $imePrezime = strip_tags(addslashes($_POST['ime_prezime']));
            $odeljenje = strip_tags(addslashes($_POST['odeljenje']));
            $pozicija = $_POST['pozicija'];
            $plata = $_POST['plata'];
            zaposliRadnika($idbr,$imePrezime,$odeljenje,$pozicija,$plata);
        }

    switch($_SESSION['tip']) {
        case 'gost': prikazZaGosta(); break;
        case 'rukovodilac': prikazZaRukovodioca(); break;
        case 'admin':  prikazZaRukovodioca();
            include('includes/formaZaZaposliti.php');
            break;
    }
?>
</div>
    <?php
$homepage = file_get_contents('includes/foot_content.php');
echo $homepage;
?>
</body>
</html>