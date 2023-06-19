<?php
include('context.php');

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(isset($_POST['edit'])) {
            $mitarbeiternr = $_POST['edit'];
    
            // SQL-Abfrage, um den Mitarbeiter mit der gegebenen mitarbeiternr zu erhalten
            $query = "SELECT * FROM mitarbeiter WHERE mitarbeiternr = $mitarbeiternr";
            $result = $mysqli->query($query);

            if(mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $nachname = $row['nachname'];
                $vorname = $row['vorname'];
                $geburtsdatum = $row['geburtsdatum'];
                
                // Formular anzeigen, um den Mitarbeiter zu bearbeiten
                echo '
                    <form method="POST">
                        <input type="hidden" name="mitarbeiternr" value="'.$mitarbeiternr.'">
                        Nachname: <input type="text" name="nachname" value="'.$nachname.'"><br>
                        Vorname: <input type="text" name="vorname" value="'.$vorname.'"><br>
                        Geburtsdatum: <input type="date" name="geburtsdatum" value="'.$geburtsdatum.'"><br>
                        <input type="submit" value="Update" name = "Update">
                    </form>
                ';
            }
        }
        if(isset($_POST['Update'])){
            $query = "UPDATE mitarbeiter set nachname = '{$_POST['nachname']}', vorname = '{$_POST['vorname']}', geburtsdatum = '{$_POST['geburtsdatum']}' WHERE mitarbeiternr = {$_POST['mitarbeiternr']}";
            $result = $mysqli->query($query);
        }
        if(isset($_POST['delete'])) {
            $mitarbeiternr = $_POST['delete'];
    
            // SQL-Abfrage, um den Mitarbeiter mit der gegebenen mitarbeiternr zu löschen
            $query = "DELETE FROM mitarbeiter WHERE mitarbeiternr = $mitarbeiternr";
            $result = $mysqli->query($query);
            
            if(!$result)
            {
                echo "Fehler beim Löschen des Mitarbeiters: " . $mysqli->error;
            }
        }
        if(isset($_POST['add'])) {

        ?><form method="POST" action="">
        <label for="nachname">Nachname:</label>
        <input type="text" name="nachname" id="nachname"><br>
        <label for="vorname">Vorname:</label>
        <input type="text" name="vorname" id="vorname"><br>
        <label for="geburtsdatum">Geburtsdatum:</label>
        <input type="date" name="geburtsdatum" id="geburtsdatum"><br>
        <input type="submit" value="Add" name ="sql_add">
        </form>
        <?php   
                
        }}
        if(isset($_POST['sql_add'])){

            $nachname = $_POST['nachname'];
            $vorname = $_POST['vorname'];
            $geburtsdatum = $_POST['geburtsdatum'];
            
            // SQL-Abfrage, um einen neuen Mitarbeiter zur Datenbank hinzuzufügen
            $query = "INSERT INTO mitarbeiter (nachname, vorname, geburtsdatum) VALUES ('$nachname', '$vorname', '$geburtsdatum')";
            $result = $mysqli->query($query);
            
            if(!$result)
            {
                echo "Fehler beim Hinzufügen des Mitarbeiters.";
            }
        }

    $result1 = $mysqli->query("SELECT * FROM mitarbeiter");

if(mysqli_num_rows($result1) > 0)
{
    $table = '<form method = "POST">
        <table border=1>
        <tr>
            <th>mitarbeiternr</th>
            <th>nachname</th>
            <th>vorname</th>
            <th>geburtsdatum</th>
            <th>Actions</th>
            <th><button name = "add" value = "add" type = "submit">Add</button></th>
        </tr>
    ';

    while($row = mysqli_fetch_array($result1))
    {
        $mitarbeiternr = $row["mitarbeiternr"];
        $nachname = $row["nachname"];
        $vorname = $row["vorname"];
        $geburtsdatum = $row["geburtsdatum"];
        
        

        $table .= '
            <tr>
                <td>'.$mitarbeiternr.'</td>
                <td>'.$nachname.'</td>
                <td>'.$vorname.'</td>
                <td>'.$geburtsdatum.'</td>
                <td>
                    <button name = "edit" value = '.$mitarbeiternr.' type = "Submit">edit</button>
                    <button name = "delete" value = '.$mitarbeiternr.' type = "Submit">delete</button>
                </td>
            </tr>
            ';
    }
    
    $table .= '</table> </form>';
    
    echo $table;

    echo '<br><br><a href="index.html">Zurück</a>';
}
?>


