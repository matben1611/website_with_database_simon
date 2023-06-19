<?php
include('context.php');

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(isset($_POST['edit'])) {
            $exemplarnr = $_POST['edit'];
    
            // SQL-Abfrage, um den Mitarbeiter mit der gegebenen mitarbeiternr zu erhalten
            $query = "SELECT * FROM werkzeuglieferant WHERE exemplarnr = $exemplarnr";
            $result = $mysqli->query($query);

            if(mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $exemplarnr = $row["exemplarnr"];
                $lieferantennr = $row["lieferantennr"];
                $anschaffungsdatum = $row["anschaffungsdatum"];
                $anschaffungspreis = $row["anschaffungspreis"];
                $werkzeugnr = $row["werkzeugnr"];
                
                // Formular anzeigen, um den Mitarbeiter zu bearbeiten
                ?>
                    <form method="POST">
                        <input type="hidden" name="exemplarnr" value="<?php echo $exemplarnr ?>">
                        lieferant: <select name="lieferantennr">
          <?php
          $rows = $mysqli->query("SELECT firma, lieferantennr FROM lieferant");
          foreach($rows as $row) {
            ?>
             <option value="<?php echo $row["lieferantennr"]; ?>"><?php echo $row["firma"]; ?></option>
          <?php } ?>
        </select><br>
                        anschaffungsdatum: <input type="text" name="anschaffungsdatum" value="<?php echo $anschaffungsdatum ?>"><br>
                        anschaffungspreis: <input type="text" name="anschaffungspreis" value="<?php echo $anschaffungspreis ?>"><br>
                        werkzeug: <select name="werkzeugnr">
         <?php
          $rows = $mysqli->query("SELECT bezeichnung, werkzeugnr FROM werkzeug");
          foreach($rows as $row) {
            ?>
             <option value="<?php echo $row["werkzeugnr"]; ?>"><?php echo $row["bezeichnung"]; ?></option>
          <?php } ?>

        </select>
                        <input type="submit" value="Update" name = "Update">
                    </form>
                <?php
            }
        }
        if(isset($_POST['Update'])){
            $query = "UPDATE werkzeuglieferant set lieferantennr = '{$_POST['lieferantennr']}', anschaffungsdatum = '{$_POST['anschaffungsdatum']}', anschaffungspreis = '{$_POST['anschaffungspreis']}', werkzeugnr = '{$_POST['werkzeugnr']}' WHERE exemplarnr = {$_POST['exemplarnr']}";
            $result = $mysqli->query($query);
        }
        if(isset($_POST['delete'])) {
            $exemplarnr = $_POST['delete'];
    
            // SQL-Abfrage, um den Mitarbeiter mit der gegebenen mitarbeiternr zu löschen
            $query = "DELETE FROM werkzeuglieferant WHERE exemplarnr = $exemplarnr";
            $result = $mysqli->query($query);
            
            if(!$result)
            {
                echo "Fehler beim Löschen des Lieferant: " . $mysqli->error;
            }
        }
        if(isset($_POST['add'])) {

        ?><form method="POST" action="">
        <label for="Lieferant">Lieferant:</label>
        <select name="lieferantennr">
          <?php
          $rows = $mysqli->query("SELECT firma, lieferantennr FROM lieferant");
          foreach($rows as $row) {
            ?>
             <option value="<?php echo $row["lieferantennr"]; ?>"><?php echo $row["firma"]; ?></option>
          <?php } ?>
        </select><br>
        <label for="anschaffungsdatum">anschaffungsdatum:</label>
        <input type="date" name="anschaffungsdatum"><br>
        <label for="anschaffungspreis">anschaffungspreis:</label>
        <input type="text" name="anschaffungspreis"><br>
        <label for="Werkzeug">Werkzeug:</label>
        <select name="werkzeugnr">
         <?php
          $rows = $mysqli->query("SELECT bezeichnung, werkzeugnr FROM werkzeug");
          foreach($rows as $row) {
            ?>
             <option value="<?php echo $row["werkzeugnr"]; ?>"><?php echo $row["bezeichnung"]; ?></option>
          <?php } ?>

        </select>
        <input type="submit" value="Add" name ="sql_add">
        </form>
        <?php   
                
        }
        if(isset($_POST['sql_add'])){

          $lieferantennr = $_POST["lieferantennr"];
          $anschaffungsdatum = $_POST["anschaffungsdatum"];
          $anschaffungspreis = $_POST["anschaffungspreis"];
          $werkzeugnr = $_POST["werkzeugnr"];
            
            // SQL-Abfrage, um einen neuen Mitarbeiter zur Datenbank hinzuzufügen
            $query = "INSERT INTO werkzeuglieferant (lieferantennr, anschaffungsdatum, anschaffungspreis, werkzeugnr) VALUES ('$lieferantennr', '$anschaffungsdatum', '$anschaffungspreis', '$werkzeugnr')";
            $result = $mysqli->query($query);
            
            if(!$result)
            {
                echo "Fehler beim Hinzufügen des Lieferanten.";
            }
        }
    }

    $result1 = $mysqli->query("SELECT * FROM werkzeuglieferant");

if(mysqli_num_rows($result1) > 0)
{
    $table = '<form method = "POST">
        <table border=1>
        <tr>
            <th>exemplarnr</th>
            <th>lieferant</th>
            <th>anschaffungsdatum</th>
            <th>anschaffungspreis</th>
            <th>werkzeug</th>
            <th><button name = "add" value = "add" type = "submit">Add</button></th>
        </tr>
    ';

    while($row = mysqli_fetch_array($result1))
    {
        $exemplarnr = $row["exemplarnr"];
        $lieferantennr = $row["lieferantennr"];
        $anschaffungsdatum = $row["anschaffungsdatum"];
        $anschaffungspreis = $row["anschaffungspreis"];
        $werkzeugnr = $row["werkzeugnr"];
        
        

        $table .= '
            <tr>
                <td>'.$exemplarnr.'</td>
                <td>'.$mysqli->query("SELECT firma FROM lieferant where lieferantennr = {$row['lieferantennr']}") -> fetch_assoc()["firma"].'</td>
                <td>'.$anschaffungsdatum.'</td>
                <td>'.$anschaffungspreis.'</td>
                <td>'.$mysqli->query("SELECT bezeichnung FROM werkzeug where werkzeugnr = {$row['werkzeugnr']}") -> fetch_assoc()["bezeichnung"].'</td>
                <td>
                    <button name = "edit" value = '.$exemplarnr.' type = "Submit">edit</button>
                    <button name = "delete" value = '.$exemplarnr.' type = "Submit">delete</button>
                </td>
            </tr>
            ';
    }
    
    $table .= '</table> </form>';
    
    echo $table;

    echo '<br><br><a href="index.html">Zurück</a>';
}
?>


