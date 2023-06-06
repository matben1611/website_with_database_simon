<?php
include('context.php');

$result1 = $mysqli->query("SELECT * FROM lieferant");
//$result2 = $mysqli->query("SELECT * FROM mitarbeiter");


if(mysqli_num_rows($result1) > 0)
 {
  $table = '
   <table border=1>
                    <tr>
                         <th>lieferantennr</th>
                         <th>firma</th>
                         <th>ansprechparntnerName</th>
                         <th>ansprechpartnerEmail</th>
                         <th>ansprechpartnerTelefon</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result1))
  {
   $table .= '
    <tr>
                        <td>'.$row["lieferantennr"].'</td>
                         <td>'.$row["firma"].'</td>
                         <td>'.$row["ansprechpartnerName"].'</td>
                         <td>'.$row["ansprechpartnerEmail"].'</td>
                         <td>'.$row["ansprechpartnerTelefon"].'</td>
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