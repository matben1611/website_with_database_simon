<?php
include('context.php');

// Überprüfen, ob die mitarbeiternr-Parameter übergeben wurden
if(isset($_GET['mitarbeiternr']))
{
    $mitarbeiternr = $_GET['mitarbeiternr'];
    
    // SQL-Abfrage, um den Mitarbeiter mit der gegebenen mitarbeiternr zu erhalten
    $query = "SELECT * FROM mitarbeiter WHERE mitarbeiternr = '$mitarbeiternr'";
    $result = $mysqli->query($query);
    
    if(mysqli_num_rows($result) == 1)
    {
        $row = mysqli_fetch_assoc($result);
        $nachname = $row['nachname'];
        $vorname = $row['vorname'];
        $geburtsdatum = $row['geburtsdatum'];
        
        // Formular anzeigen, um den Mitarbeiter zu bearbeiten
        echo '
            <form method="POST" action="update.php">
                <input type="hidden" name="mitarbeiternr" value="'.$mitarbeiternr.'">
                Nachname: <input type="text" name="nachname" value="'.$nachname.'"><br>
                Vorname: <input type="text" name="vorname" value="'.$vorname.'"><br>
                Geburtsdatum: <input type="text" name="geburtsdatum" value="'.$geburtsdatum.'"><br>
                <input type="submit" value="Update">
            </form>
        ';
        echo '<br><br><a href="mitarbeiter.php">Zurück</a>'; // Zurück-Button;
    }
    else
    {
        echo "Mitarbeiter nicht gefunden.";
        echo '<br><br><a href="mitarbeiter.php">Zurück</a>'; // Zurück-Button;
    }
}
else
{
    echo "Ungültige Anforderung.";
    echo '<br><br><a href="mitarbeiter.php">Zurück</a>'; // Zurück-Button;
}
?>
