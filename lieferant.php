<?php
include('context.php');

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(isset($_POST['edit'])) {
            $lieferantennr = $_POST['edit'];
    
            // SQL-Abfrage, um den Mitarbeiter mit der gegebenen mitarbeiternr zu erhalten
            $query = "SELECT * FROM lieferant WHERE lieferantennr = $lieferantennr";
            $result = $mysqli->query($query);

            if(mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $lieferantennr = $row["lieferantennr"];
                $firma = $row["firma"];
                $ansprechpartnerName = $row["ansprechpartnerName"];
                $ansprechpartnerEmail = $row["ansprechpartnerEmail"];
                $ansprechpartnerTelefon = $row["ansprechpartnerTelefon"];
                
                // Formular anzeigen, um den Mitarbeiter zu bearbeiten
                echo '
                    <form method="POST">
                        <input type="hidden" name="lieferantennr" value="'.$lieferantennr.'">
                        firma: <input type="text" name="firma" value="'.$firma.'"><br>
                        ansprechpartnerName: <input type="text" name="ansprechpartnerName" value="'.$ansprechpartnerName.'"><br>
                        ansprechpartnerEmail: <input type="text" name="ansprechpartnerEmail" value="'.$ansprechpartnerEmail.'"><br>
                        ansprechpartnerTelefon: <input type="text" name="ansprechpartnerTelefon" value="'.$ansprechpartnerTelefon.'"><br>
                        <input type="submit" value="Update" name = "Update">
                    </form>
                ';
            }
        }
        if(isset($_POST['Update'])){
            $query = "UPDATE lieferant set firma = '{$_POST['firma']}', ansprechpartnerName = '{$_POST['ansprechpartnerName']}', ansprechpartnerEmail = '{$_POST['ansprechpartnerEmail']}', ansprechpartnerTelefon = '{$_POST['ansprechpartnerTelefon']}' WHERE lieferantennr = {$_POST['lieferantennr']}";
            $result = $mysqli->query($query);
        }
        if(isset($_POST['delete'])) {
            $lieferantennr = $_POST['delete'];
    
            // SQL-Abfrage, um den Mitarbeiter mit der gegebenen mitarbeiternr zu löschen
            $query = "DELETE FROM lieferant WHERE lieferantennr = $lieferantennr";
            $result = $mysqli->query($query);
            
            if(!$result)
            {
                echo "Fehler beim Löschen des Lieferant: " . $mysqli->error;
            }
        }
        if(isset($_POST['add'])) {

        ?><form method="POST" action="">
        <label for="firma">firma:</label>
        <input type="text" name="firma"><br>
        <label for="ansprechpartnerName">ansprechpartnerName:</label>
        <input type="text" name="ansprechpartnerName"><br>
        <label for="ansprechpartnerEmail">ansprechpartnerEmail:</label>
        <input type="text" name="ansprechpartnerEmail"><br>
        <label for="ansprechpartnerTelefon">ansprechpartnerTelefon:</label>
        <input type="text" name="ansprechpartnerTelefon"><br>
        <input type="submit" value="Add" name ="sql_add">
        </form>
        <?php   
                
        }}
        if(isset($_POST['sql_add'])){

          $firma = $_POST["firma"];
          $ansprechpartnerName = $_POST["ansprechpartnerName"];
          $ansprechpartnerEmail = $_POST["ansprechpartnerEmail"];
          $ansprechpartnerTelefon = $_POST["ansprechpartnerTelefon"];
            
            // SQL-Abfrage, um einen neuen Mitarbeiter zur Datenbank hinzuzufügen
            $query = "INSERT INTO lieferant (firma, ansprechpartnerName, ansprechpartnerEmail, ansprechpartnerTelefon) VALUES ('$firma', '$ansprechpartnerName', '$ansprechpartnerEmail', '$ansprechpartnerTelefon')";
            $result = $mysqli->query($query);
            
            if(!$result)
            {
                echo "Fehler beim Hinzufügen des Lieferanten.";
            }
        }

    $result1 = $mysqli->query("SELECT * FROM lieferant");

if(mysqli_num_rows($result1) > 0)
{
    $table = '<form method = "POST">
        <table border=1>
        <tr>
            <th>lieferantennr</th>
            <th>firma</th>
            <th>ansprechpartnerName</th>
            <th>ansprechpartnerEmail</th>
            <th>ansprechpartnerTelefon</th>
            <th><button name = "add" value = "add" type = "submit">Add</button></th>
        </tr>
    ';

    while($row = mysqli_fetch_array($result1))
    {
        $lieferantennr = $row["lieferantennr"];
        $firma = $row["firma"];
        $ansprechpartnerName = $row["ansprechpartnerName"];
        $ansprechpartnerEmail = $row["ansprechpartnerEmail"];
        $ansprechpartnerTelefon = $row["ansprechpartnerTelefon"];
        
        

        $table .= '
            <tr>
                <td>'.$lieferantennr.'</td>
                <td>'.$firma.'</td>
                <td>'.$ansprechpartnerName.'</td>
                <td>'.$ansprechpartnerEmail.'</td>
                <td>'.$ansprechpartnerTelefon.'</td>
                <td>
                    <button name = "edit" value = '.$lieferantennr.' type = "Submit">edit</button>
                    <button name = "delete" value = '.$lieferantennr.' type = "Submit">delete</button>
                </td>
            </tr>
            ';
    }
    
    $table .= '</table> </form>';
    
    echo $table;

    echo '<br><br><a href="index.html">Zurück</a>';
}
?>


