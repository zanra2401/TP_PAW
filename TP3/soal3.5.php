<?php 
    $students = array 
    ( 
        array("Alex","220401","0812345678"), 
        array("Bianca","220402","0812345687"), 
        array("Candice","220403","0812345665"), 
    ); 

    for ($row = 0; $row < 3; $row++) { 
        echo "<p><b>Row number $row</b></p>"; 
        echo "<ul>"; 
        for ($col = 0; $col < 3; $col++) { 
            echo "<li>" . $students[$row][$col]."</1i>"; 
        }
        echo "</ul>";
    }

    $students = array 
    ( 
        array("Alex","220401","0812345678"), 
        array("Bianca","220402","0812345687"), 
        array("Candice","220403","0812345665"), 
        array("Zanuar","220401","0812345678"), 
        array("Rikza","220402","0812345687"), 
        array("Aditiya","220403","0812345665"), 
        array("Nana","220401","0812345678"), 
        array("Rex","220402","0812345687"), 
    ); 
    
    echo "<table border='1'>";
    echo "<tr><th>Nama</th><th>NIM</th><th>Nomor Hp</th></tr>";
    for ($row = 0; $row < count($students); $row++)
    {
        echo "<tr>";
        echo "<td>{$students[$row][0]}</td> <td>{$students[$row][1]}</td> <td>{$students[$row][2]}</td>";
        echo "</tr>";
    }
    echo "</table>";