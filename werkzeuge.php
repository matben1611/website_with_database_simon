<?php
include('context.php');

$result1 = $mysqli->query("SELECT * FROM werkzeug");
//$result2 = $mysqli->query("SELECT * FROM mitarbeiter");




if(mysqli_num_rows($result1) > 0)
 {
  $table = '
   <table border=1>
                    <tr>
                         <th>werkzeugnr</th>
                         <th>bezeichnung</th>
                         <th>beschreibung</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result1))
  {
   $table .= '
    <tr>
                        <td>'.$row["werkzeugnr"].'</td>
                         <td>'.$row["bezeichnung"].'</td>
                         <td>'.$row["beschreibung"].'</td>
                         <td><input type="submit" name="test" id="test" value="delete"</td>
                         <td><input type="submit" name="test" id="test" value="edit"</td>
                    </tr>
   ';
  }
  $table .= '</table>';
  echo $table;
 }

function Insert($mysqli, $InterfaceObj){
    $InterfaceObj -> Info();
}
