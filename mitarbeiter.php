<?php
include('context.php');

$result1 = $mysqli->query("SELECT * FROM mitarbeiter");

if(mysqli_num_rows($result1) > 0)
{
    $table = '
        <table border=1>
        <tr>
            <th>mitarbeiternr</th>
            <th>nachname</th>
            <th>vorname</th>
            <th>geburtsdatum</th>
            <th>Actions</th>
            <th><a href="add_employee.php">Add</a></th>
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
                    <a href="edit.php?mitarbeiternr='.$mitarbeiternr.'">edit</a>
                    <a href="delete.php?mitarbeiternr='.$mitarbeiternr.'">delete</a>
                </td>
            </tr>
        ';
    }
    
    $table .= '</table>';
    echo $table;

    echo '<br><br><a href="index.html">Zurück</a>';
}
?>


