<?php
include('context.php');

// Überprüfen, ob die Formulardaten gesendet wurden
if(isset($_POST['mitarbeiternr']) && isset($_POST['nachname']) && isset($_POST['vorname']) && isset($_POST['geburtsdatum']))
{
    $mitarbeiternr = $_POST['mitarbeiternr'];
    $nachname = $_POST['nachname'];
    $vorname = $_POST['vorname'];
    $geburtsdatum = $_POST['geburtsdatum'];
    
    // SQL-Abfrage, um den Mitarbeiter mit der gegebenen mitarbeiternr zu aktualisieren
    $query = "UPDATE mitarbeiter SET nachname = '$nachname', vorname = '$vorname', geburtsdatum = '$geburtsdatum' WHERE mitarbeiternr = '$mitarbeiternr'";
    $result = $mysqli->query($query);
    
    if($result)
    {
        echo "Mitarbeiter erfolgreich aktualisiert.";
        echo '<br><br><a href="mitarbeiter.php">Zurück</a>'; // Zurück-Button
    }
    else
    {
        echo "Fehler beim Aktualisieren des Mitarbeiters.";
        echo '<br><br><a href="mitarbeiter.php">Zurück</a>'; // Zurück-Button
    }
}
else
{
    echo "Ungültige Anforderung.";
    echo '<br><br><a href="mitarbeiter.php">Zurück</a>'; // Zurück-Button
}
?>
