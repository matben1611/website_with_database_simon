<?php
include('context.php');

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(isset($_POST['edit'])) {
            $arr = explode("|",$_POST['edit']);
            $exemplarnr = $arr[0];
            $mitarbeiternr = $arr[1];    
            $ausleihdatum = $arr[2];    

            $query = "SELECT * FROM werkzeugausleihe WHERE exemplarnr = $exemplarnr and mitarbeiternr = $mitarbeiternr and ausleihdatum = '$ausleihdatum'";
            $result = $mysqli->query($query);

            if(mysqli_num_rows($result) == 1)
            {
                $row = mysqli_fetch_assoc($result);
                $exemplarnr = $row["exemplarnr"];
                $mitarbeiternr = $row["mitarbeiternr"];
                $ausleihdatum = $row["ausleihdatum"];
                $rueckgabedatum = $row["rueckgabedatum"];
                $zurueckgegebenam = $row["zurueckgegebenam"];
                
                ?><form method="POST" action="">
        <input type="hidden" name="mitarbeiternr" value="<?php echo $mitarbeiternr; ?>"></input>
        <input type="hidden" name="ausleihdatum" value="<?php echo $ausleihdatum; ?>"></input>
        <label for="rueckgabedatum">rueckgabedatum:</label>
        <input type="date" name="rueckgabedatum"><br>
        <label for="zurueckgegebenam">zurueckgegebenam:</label>
        <input type="date" name="zurückgegebenam"><br>
        <input type="hidden" name="exemplarnr" value="<?php echo $exemplarnr; ?>"></input>
        <input type="submit" value="Update" name ="Update">
        </form>
        <?php   
                
            }
        }
        if(isset($_POST['Update'])){
            if(isset($_POST['zurueckgegebenam'])){
                $date = $_POST['zurueckgegebenam'];
                $_POST['zurueckgegebenam'] = "'$date'";
            }else{
                $_POST['zurueckgegebenam'] = "NULL";
            }
            // DOES NOT WORK I DONT KNOW WHY
            $query = "UPDATE werkzeugausleihe SET rueckgabedatum='{$_POST['rueckgabedatum']}', zurueckgegebenam={$_POST['zurueckgegebenam']} WHERE  exemplarnr={$_POST['exemplarnr']} AND mitarbeiternr={$_POST['mitarbeiternr']} AND ausleihdatum='{$_POST['ausleihdatum']}'";
            $result = $mysqli->query($query);
            echo $query;
            echo $result;
        }
        if(isset($_POST['delete'])) {
            $arr = explode("|",$_POST['delete']);
            $exemplarnr = $arr[0];
            $mitarbeiternr = $arr[1];    
            $ausleihdatum = $arr[2];    
    
            $query = "DELETE FROM werkzeugausleihe WHERE exemplarnr = $exemplarnr AND mitarbeiternr = $mitarbeiternr AND ausleihdatum = '$ausleihdatum'";
            $result = $mysqli->query($query);
            
            if(!$result)
            {
                echo "Fehler beim Löschen des Lieferant: " . $mysqli->error;
            }
        }
        if(isset($_POST['add'])) {

        ?><form method="POST" action="">
        <label for="mitarbeiter">Mitarbeiter:</label>
        <select name="mitarbeiternr">
          <?php
          $rows = $mysqli->query("SELECT vorname, nachname, mitarbeiternr FROM mitarbeiter");
          foreach($rows as $row) {
            ?>
             <option value="<?php echo $row["mitarbeiternr"]; ?>"><?php echo $row["vorname"].$row["nachname"]; ?></option>
          <?php } ?>
        </select><br>
        <label for="ausleihdatum">ausleihdatum:</label>
        <input type="date" name="ausleihdatum"><br>
        <label for="rueckgabedatum">rueckgabedatum:</label>
        <input type="date" name="rueckgabedatum"><br>
        <label for="exemplar">Exemplar:</label>
        <select name="exemplarnr">
         <?php
          $rows = $mysqli->query("SELECT exemplarnr FROM werkzeuglieferant");
          foreach($rows as $row) {
            ?>
             <option value="<?php echo $row["exemplarnr"]; ?>"><?php echo $row["exemplarnr"]; ?></option>
          <?php } ?>

        </select>
        <input type="submit" value="Add" name ="sql_add">
        </form>
        <?php   
                
        }
        if(isset($_POST['sql_add'])){

          $mitarbeiternr = $_POST["mitarbeiternr"];
          $ausleihdatum = $_POST["ausleihdatum"];
          $rueckgabedatum = $_POST["rueckgabedatum"];
          $exemplarnr = $_POST["exemplarnr"];
            
            $query = "INSERT INTO werkzeugausleihe (exemplarnr, mitarbeiternr, ausleihdatum, rueckgabedatum) VALUES ($exemplarnr,'$mitarbeiternr', '$ausleihdatum', '$rueckgabedatum')";
            $result = $mysqli->query($query);
            
            if(!$result)
            {
                echo "Fehler beim Hinzufügen des Lieferanten.";
            }
        }
    }

    $result1 = $mysqli->query("SELECT * FROM werkzeugausleihe");

if(mysqli_num_rows($result1) > 0)
{
    $table = '<form method = "POST">
        <table border=1>
        <tr>
            <th>werkzeuglieferung</th>
            <th>mitarbeiter</th>
            <th>ausleihdatum</th>
            <th>rueckgabedatum</th>
            <th>zurueckgegebenam</th>
            <th><button name = "add" value = "add" type = "submit">Add</button></th>
        </tr>
    ';

    while($row = mysqli_fetch_array($result1))
    {
        $exemplarnr = $row["exemplarnr"];
        $mitarbeiternr = $row["mitarbeiternr"];
        $ausleihdatum = $row["ausleihdatum"];
        $rueckgabedatum = $row["rueckgabedatum"];
        $zurueckgegebenam = $row["zurueckgegebenam"];
        
        
        $lieferantinfo = $mysqli->query("SELECT lieferant.firma, werkzeug.bezeichnung FROM lieferant, werkzeug, werkzeuglieferant WHERE exemplarnr = $exemplarnr AND werkzeuglieferant.werkzeugnr = werkzeug.werkzeugnr AND werkzeuglieferant.lieferantennr = lieferant.lieferantennr") -> fetch_assoc();
        $mitarbeiter = $mysqli->query("SELECT vorname, nachname FROM mitarbeiter WHERE mitarbeiternr = $mitarbeiternr") -> fetch_assoc();
        $mitgeben = "$exemplarnr|$mitarbeiternr|$ausleihdatum";
        $table .= '
            <tr>
                <td>'.$lieferantinfo["firma"].$lieferantinfo["bezeichnung"].'</td>
                <td>'.$mitarbeiter["vorname"].$mitarbeiter["nachname"].'</td>
                <td>'.$ausleihdatum.'</td>
                <td>'.$rueckgabedatum.'</td>
                <td>'.$zurueckgegebenam.'</td>
                <td>
                    <button name = "edit" value = '.$mitgeben.' type = "Submit">edit</button>
                    <button name = "delete" value = '.$mitgeben.' type = "Submit">delete</button>
                </td>
            </tr>
            ';
    }
    
    $table .= '</table> </form>';
    
    echo $table;

    echo '<br><br><a href="index.html">Zurück</a>';
}
?>


