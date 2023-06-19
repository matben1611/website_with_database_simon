<?php
include('context.php');

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(isset($_POST['edit'])) {
            $werkzeugnr = $_POST['edit'];
    
            // SQL-Abfrage, um den Mitarbeiter mit der gegebenen mitarbeiternr zu erhalten
            $query = "SELECT * FROM werkzeug WHERE werkzeugnr = $werkzeugnr";
            $result = $mysqli->query($query);

            if(mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $werkzeugnr = $row["werkzeugnr"];
                $bezeichnung = $row["bezeichnung"];
                $beschreibung = $row["beschreibung"];

                
                // Formular anzeigen, um den Mitarbeiter zu bearbeiten
                echo '
                    <form method="POST">
                        <input type="hidden" name="werkzeugnr" value="'.$werkzeugnr.'">
                        bezeichnung: <input type="text" name="bezeichnung" value="'.$bezeichnung.'"><br>
                        beschreibung: <input type="text" name="beschreibung" value="'.$beschreibung.'"><br>
                        <input type="submit" value="Update" name = "Update">
                    </form>
                ';
            }
        }
        if(isset($_POST['Update'])){
            $query = "UPDATE werkzeug set bezeichnung = '{$_POST['bezeichnung']}', beschreibung = '{$_POST['beschreibung']}' WHERE werkzeugnr = {$_POST['werkzeugnr']}";
            $result = $mysqli->query($query);
        }
        if(isset($_POST['delete'])) {
            $werkzeugnr = $_POST['delete'];
    
            // SQL-Abfrage, um den Mitarbeiter mit der gegebenen mitarbeiternr zu löschen
            $query = "DELETE FROM werkzeug WHERE werkzeugnr = $werkzeugnr";
            $result = $mysqli->query($query);
            
            if(!$result)
            {
                echo "Fehler beim Löschen des Lieferant: " . $mysqli->error;
            }
        }
        if(isset($_POST['add'])) {

        ?><form method="POST" action="">
        <label for="bezeichnung">bezeichnung:</label>
        <input type="text" name="bezeichnung"><br>
        <label for="beschreibung">beschreibung:</label>
        <input type="text" name="beschreibung"><br>
        <input type="submit" value="Add" name ="sql_add">
        </form>
        <?php   
                
        }}
        if(isset($_POST['sql_add'])){

          $bezeichnung = $_POST["bezeichnung"];
          $beschreibung = $_POST["beschreibung"];

            
            // SQL-Abfrage, um einen neuen Mitarbeiter zur Datenbank hinzuzufügen
            $query = "INSERT INTO werkzeug (bezeichnung, beschreibung) VALUES ('$bezeichnung', '$beschreibung')";
            $result = $mysqli->query($query);
            
            if(!$result)
            {
                echo "Fehler beim Hinzufügen des Lieferanten.";
            }
        }

    $result1 = $mysqli->query("SELECT * FROM werkzeug");

if(mysqli_num_rows($result1) > 0)
{
    $table = '<form method = "POST">
        <table border=1>
        <tr>
            <th>werkzeugnr</th>
            <th>bezeichnung</th>
            <th>beschreibung</th>
            <th><button name = "add" value = "add" type = "submit">Add</button></th>
        </tr>
    ';

    while($row = mysqli_fetch_array($result1))
    {
        $werkzeugnr = $row["werkzeugnr"];
        $bezeichnung = $row["bezeichnung"];
        $beschreibung = $row["beschreibung"];

        $table .= '
            <tr>
                <td>'.$werkzeugnr.'</td>
                <td>'.$bezeichnung.'</td>
                <td>'.$beschreibung.'</td>
                <td>
                    <button name = "edit" value = '.$werkzeugnr.' type = "Submit">edit</button>
                    <button name = "delete" value = '.$werkzeugnr.' type = "Submit">delete</button>
                </td>
            </tr>
            ';
    }
    
    $table .= '</table> </form>';
    
    echo $table;

    echo '<br><br><a href="index.html">Zurück</a>';
}
?>



