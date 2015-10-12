<?php
function konektuj() {
    @$db = mysqli_connect("localhost","root","","baza");
    if(!$db) {
        echo "Konekcija nije uspela! Aplikacija prekida izvršavanje.";
        exit(1);
    }
    mysqli_set_charset($db,"utf8");
    return $db; 
}


function validacijaKorisnika($korisnicko_ime, $lozinka) {
    $baza = konektuj(); 
    $sql  = "SELECT * FROM korisnici WHERE korisnik = '";
    $sql .= strip_tags(addslashes(trim($korisnicko_ime))) ."' "; 
    $sql .= "AND lozinka = '" . strip_tags(addslashes(trim($lozinka))) ."'";
    $rezultat = mysqli_query($baza,$sql);
    if(mysqli_num_rows($rezultat) > 0)
    {
        $redTabele = mysqli_fetch_assoc($rezultat); 
        $_SESSION['korisnik'] = $redTabele['korisnik'];
        $_SESSION['tip'] = $redTabele['tip'];
        return true; 
    }
    return false; 
}


function prikazZaGosta() {
    $baza = konektuj();
    $sql = "SELECT ime_prezime FROM zaposleni";
    $rezultat = mysqli_query($baza,$sql); 
    echo '<table><thead><th>Ime i prezime:</th></thead>';
    echo '<tbody>';
    while($red = mysqli_fetch_assoc($rezultat)) {
        echo '<tr><td>' . $red['ime_prezime'] . '</td></tr>';
    }
    echo '</tbody></table>';
}


function prikazZaRukovodioca() {
    $baza = konektuj();
    $sql = "SELECT idbr, ime_prezime FROM zaposleni";
    $rezultat = mysqli_query($baza,$sql);
    echo '<table><thead><th>Ime i prezime:</th><th>Projekti</th></thead>';
    while($red = mysqli_fetch_assoc($rezultat)) {
        echo '<tr><td>' . $red['ime_prezime'] . '</td>';
        echo '<td><ul>';
        $sql_novi = "SELECT naziv FROM projekti WHERE idbr = " . $red['idbr'];
        $rezultat_novi = mysqli_query($baza,$sql_novi);
        while($red_novi = mysqli_fetch_assoc($rezultat_novi)) {
            echo '<li>' . $red_novi['naziv'] .'</li>';
        }
        echo '</ul></td></tr>';
    }
    echo '</tbody></table>';
    echo '<tbody>';
}



function padajucaListaOdeljenja() {
    $baza = konektuj();
    $sql = "SELECT DISTINCT odeljenje FROM zaposleni"; 
    $rezultat = mysqli_query($baza,$sql);
    echo ' <label for="odeljenje">Informacije o radniku sa najvećom platom u odeljenju:</label>';
    echo '<select name="paramOdeljenje" id="odeljenje">';
    while($red = mysqli_fetch_assoc($rezultat)) {
        echo '<option value="' . $red['odeljenje'] .'">' . $red['odeljenje'] . '</option>';
    }
    echo '<select>';
}


function zaposliRadnika($idbr, $imePrezime, $odeljenje, $pozicija, $plata) {
    $danas = date("Y-m-d");
    $baza = konektuj();
    $provera = mysqli_query($baza, "SELECT idbr FROM zaposleni WHERE idbr =" . $idbr);
    if(mysqli_num_rows($provera) != 0) echo '<p class="error">Već postoji radnik sa datim brojem</p>';
    else {
        $sql = "INSERT INTO zaposleni VALUES (";
        $sql .= $idbr . ",'" . $imePrezime ."','" . $odeljenje ."','" . $pozicija . "',";
        if($pozicija != "stažista") $sql .= "'" . $danas . "','";
        else $sql .= "NULL,'";
        $sql.= $plata ."')";
        $rezultat = mysqli_query($baza,$sql);
        if($rezultat != false) {
            echo '<p class="allgood">Radnik je uspešno upisan u bazu.</p>';
        } else {
            echo '<p class="error">Nije moguće upisati radnika u bazu</p>';
        }
    }

}


function pretragaPoImenuIliPrezimenu($parametar) {
    $parametar = strip_tags(addslashes(trim($parametar)));
    $baza = konektuj();
    $sql = "SELECT * FROM zaposleni WHERE ime_prezime LIKE '%" . $parametar . "%'";
    $rezultat = mysqli_query($baza,$sql);
    if(mysqli_num_rows($rezultat) == 0) {
        echo '<p>Nema rezultata koji odgovaraju tom parametru.</p>';
    } else {
        echo '<h4>Nađeni rezultati su:</h4>';
        echo '<ul>';
        while($red = mysqli_fetch_assoc($rezultat)) {
            echo '<li>' . $red['ime_prezime'] . "[" . $red['odeljenje'] . " - ". $red['pozicija'] ."] </li>";
        }
        echo '</ul>';
    }
}


function radnikSaNajvecomPlatom($parametar) {
    $radnik = array(); 
    $baza = konektuj();
    $sql = "SELECT * FROM zaposleni WHERE odeljenje = '" . $parametar . "'";
    $rezultat = mysqli_query($baza,$sql);
  
    $red = mysqli_fetch_assoc($rezultat);
    $radnik['ime_prezime'] = $red['ime_prezime'];
    $radnik['pozicija'] = $red['pozicija'];
    $radnik['datum_zaposlenja'] = $red['datum_zaposlenja'];
    $radnik['plata'] = $red['plata'];
  
    while($red = mysqli_fetch_assoc($rezultat)) {
        if($radnik['plata'] < $red['plata']) {
            $radnik['ime_prezime'] = $red['ime_prezime'];
            $radnik['pozicija'] = $red['pozicija'];
            $radnik['datum_zaposlenja'] = $red['datum_zaposlenja'];
            $radnik['plata'] = $red['plata'];
        }
    }
    echo '
    <table>
        <thead>
            <th>Ime i prezime</th>
            <th>Pozicija</th>
            <th>Datum zaposlenja</th>
            <th>plata</th>
        </thead>
        <tbody>
        ';
        echo '<tr>';
        echo       '<td>' . $radnik['ime_prezime'] . '</td>';
        echo       '<td>' . $radnik['pozicija'] . '</td>';
        echo       '<td>' . date('d.m.Y',strtotime($radnik['datum_zaposlenja'])) . '</td>';
        echo       '<td>' . $radnik['plata'] . '</td>';
        echo '</tr>
        </tbody>
    </table>
    ';

}


