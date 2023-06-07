<?php
include('context.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Überprüfen, ob die Formulardaten gesendet wurden
    if(isset($_POST['nachname']) && isset($_POST['vorname']) && isset($_POST['geburtsdatum']))
    {
        $nachname = $_POST['nachname'];
        $vorname = $_POST['vorname'];
        $geburtsdatum = $_POST['geburtsdatum'];
        
        // SQL-Abfrage, um einen neuen Mitarbeiter zur Datenbank hinzuzufügen
        $query = "INSERT INTO mitarbeiter (nachname, vorname, geburtsdatum) VALUES ('$nachname', '$vorname', '$geburtsdatum')";
        $result = $mysqli->query($query);
        
        if($result)
        {
            echo "Neuer Mitarbeiter wurde erfolgreich hinzugefügt.";
            echo '<br><br><a href="mitarbeiter.php">Zurück</a>'; // Zurück-Button
        }
        else
        {
            echo "Fehler beim Hinzufügen des Mitarbeiters.";
            echo '<br><br><a href="mitarbeiter.php">Zurück</a>'; // Zurück-Button
        }
    }
    else
    {
        echo "Ungültige Anforderung.";
        echo '<br><br><a href="mitarbeiter.php">Zurück</a>'; // Zurück-Button
    }
}
?>


<form method="POST" action="">
    <label for="nachname">Nachname:</label>
    <input type="text" name="nachname" id="nachname"><br>
    <label for="vorname">Vorname:</label>
    <input type="text" name="vorname" id="vorname"><br>
    <label for="geburtsdatum">Geburtsdatum:</label>
    <input type="text" name="geburtsdatum" id="geburtsdatum"><br>
    <input type="submit" value="Add">
</form>
<br><br><a href="mitarbeiter.php">Zurück</a>
