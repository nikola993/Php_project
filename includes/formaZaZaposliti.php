
<form id = "zaposlenje" action="prikaz.php" method="post">
    <h3>Zaposli radnika:</h3>
    <label for="idbr">IDBR:</label><input type="number" id="idbr" name="idbr"><br>
    <label for="ime_prezime">Ime i prezime:</label><input type="text" id="ime_prezime" name="ime_prezime"><br>
    <label for="odeljenje">Odeljenje:</label><input type="text" name="odeljenje" id="odeljenje"><br>
    <label for="pozicija">Pozicija</label><select name="pozicija">
        <option value="stažista">stažista</option>
        <option value=radnik">radnik</option>
        <option value="rukovodilac">rukovodilac</option>
    </select><br>
    <label for="plata">Plata</label><input type="number" id="plata" name="plata"><br>
    <button type="submit">Zaposli radnika</button>
</form>