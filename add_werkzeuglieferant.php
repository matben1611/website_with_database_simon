<?php
include('context.php');

?>
<label for="cars">Wähle den lieferant:</label>

<select name="lieferantnr">
    <?php
    $rows = $mysqli->query("SELECT firma, lieferantennr FROM lieferant");
    foreach($rows as $row) {
        ?>
        <option value="<?php echo $row["lieferantennr"]; ?>"><?php echo $row["firma"]; ?></option>
    <?php } ?>
</select>

<label for="cars">Wähle das Werkzeug:</label>

<select name="werkzeug">
    <?php
    $rows = $mysqli->query("SELECT bezeichnung, werkzeugnr FROM werkzeug");
    foreach($rows as $row) {
        ?>
        <option value="<?php echo $row["werkzeugnr"]; ?>"><?php echo $row["bezeichnung"]; ?></option>
    <?php } ?>

</select>



<form method="POST" action="POST">
    <label for="werkzeugname">Werkzeugname:</label>
    <input type="text" name="werkzeugname" id="werkzeugname"><br>
    <label for="ausleihdatum">Ausleihdatum:</label>
    <input type="text" name="ausleihdatum" id="ausleihdatum"><br>
    <label for="rückgabedatum">Rückgabedatum:</label>
    <input type="text" name="rückgabedatum" id="rückgabedatum"><br>
    <input type="submit" value="Add">
</form>
<?
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Überprüfen, ob die Formulardaten gesendet wurden
    if(isset($_POST['werkzeugname']) && isset($_POST['ausleihdatum']) && isset($_POST['rückgabedatum']))
    {
        $werkzeugname = $_POST['werkzeugname'];
        $ausleihdatum = $_POST['ausleihdatum'];
        $rückgabedatum = $_POST['rückgabedatum'];
        
        // SQL-Abfrage, um ein neues Werkzeug zur Datenbank hinzuzufügen
        $query = "INSERT INTO werkzeugausleihe (werkzeugname, ausleihdatum, rückgabedatum) VALUES ('$werkzeugname', '$ausleihdatum', '$rückgabedatum', ["lieferantennr"], ["werkzeugnr"])";
        $result = $mysqli->query($query);
        
        if($result)
        {
            echo "Neues Werkzeug wurde erfolgreich hinzugefügt.";
        }
        else
        {
            echo "Fehler beim Hinzufügen des Werkzeugs.";
        }
    }
    else
    {
        echo "Ungültige Anforderung.";
    }
}


<a href="werkzeuglieferant.php">Zurück</a> <!-- Zurück-Button -->
?>