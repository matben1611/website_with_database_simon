<?php
include('context.php');

// Überprüfen, ob die mitarbeiternr übergeben wurde
if(isset($_GET['mitarbeiternr']))
{
    $mitarbeiternr = $_GET['mitarbeiternr'];
    
    // SQL-Abfrage, um den Mitarbeiter mit der gegebenen mitarbeiternr zu löschen
    $query = "DELETE FROM mitarbeiter WHERE mitarbeiternr = '$mitarbeiternr'";
    $result = $mysqli->query($query);
    
    if($result)
    {
        echo "Mitarbeiter erfolgreich gelöscht.";
        echo '<br><br><a href="mitarbeiter.php">Zurück</a>'; // Zurück-Button
    }
    else
    {
        echo "Fehler beim Löschen des Mitarbeiters: " . $mysqli->error;
    }
}
else
{
    echo "Ungültige Anforderung.";
}
?>

