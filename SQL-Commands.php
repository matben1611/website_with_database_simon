<?php
//SQL-Commands.php
include('context.php');

//Get($mysqli,'mitarbeiter');


$result1 = $mysqli->query("SELECT * FROM lieferant");
$result2 = $mysqli->query("SELECT * FROM mitarbeiter");


if(mysqli_num_rows($result1) > 0)
 {
  $table = '
   <table border=1>
                    <tr>
                         <th> Lieferanten ID </th>
                         <th>Firma</th>
                         <th>ansprechpartnerName</th>
                         <th>ansprechparnerEmail</th>
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


                    </tr>
   ';
  }
  $table .= '</table>';
  echo $table;
 }

 if(mysqli_num_rows($result2) > 0)
 {
  $table = '
   <table border=1>
                    <tr>
                         <th> Mitarbeiter Nr </th>
                         <th>Nachname</th>
                         <th>Vorname/th>
                         <th>Geburtsdatum</th>


                    </tr>
  ';
  while($row = mysqli_fetch_array($result2))
  {
   $table .= '
    <tr>
                        <td>'.$row["mitarbeiternr"].'</td>
                         <td>'.$row["nachname"].'</td>
                         <td>'.$row["vorname"].'</td>
                         <td>'.$row["geburtsdatum"].'</td>


                    </tr>
   ';
  }
  $table .= '</table>';
  echo $table;
 }


function Insert($mysqli, $InterfaceObj){
    $InterfaceObj -> Info();
    // $string = "eins,zwei,2002-01-01";
    // $query = 'INSERT INTO mitarbeiter (nachname, vorname, geburtsdatum) VALUES ("eins","zwei","2002-01-01")';
    // $mysqli->query($query);
    // echo('Finished');
}

// function insertWorker($nachname, $vorname, $geburtsdatum){

// }

// function insertSupplier(){

// }

// function insertTool(){

// }

// function Delete(){

// }

// function deleteWorker(){

// }
// $mysqli -> close();
?>