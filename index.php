<?php session_start();
      if(isset($_SESSION['korisnik'])) header("Location: prikaz.php");
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
    <form id = "login" action="prikaz.php" method="post">
        <label for="korisnik">Korisničko ime:</label>
        <input type="text" name="korisnik" id="korisnik" value="goran1"><br>
        <label for="lozinka">Lozinka:</label>
        <input type="password" name="lozinka" id="lozinka" value="pass1234"> <br>
        <button type="submit">Ulogujte se</button>
    </form>
    </div>
<?php
$homepage = file_get_contents('includes/foot_content.php');
echo $homepage;
?>
</body>
</html>