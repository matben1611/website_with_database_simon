<?php
include('context.php');

// SQL-Abfrage, um die Daten aus der Tabelle "Werkzeuglieferant" abzurufen
$query = "SELECT * FROM werkzeuglieferant";

$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    // Ausgabe der Daten in einer Tabelle
    echo "<table>
            <tr>
                <th>exemplarnr</th>
                <th>lieferantennr</th>
                <th>anschaffungsdatum</th>
                <th>anschaffungspreis</th>
                <th>werkzeugnr</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["exemplarnr"]."</td>
                <td>".$mysqli->query("SELECT firma FROM lieferant where lieferantennr = {$row['lieferantennr']}") -> fetch_assoc()["firma"]."</td>
                <td>".$row["anschaffungsdatum"]."</td>
                <td>".$row["anschaffungspreis"]."</td>
                <td>".$mysqli->query("SELECT bezeichnung FROM werkzeug where werkzeugnr = {$row['werkzeugnr']}") -> fetch_assoc()["bezeichnung"]."</td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "Keine Daten gefunden.";
}
?>

<a href="add_werkzeuglieferant.php">Neues Werkzeug hinzufügen</a> <!-- Button zur Werkzeugausleihe -->

<a href="index.html">Zurück</a> <!-- Zurück-Button -->

