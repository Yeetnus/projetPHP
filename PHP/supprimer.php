<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projetr301";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $sql = "SELECT Nom, Prenom, Civilite FROM medecin";
    $result = mysqli_query($conn, $sql);
}

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>Nom</th>";
    echo "<th>Prenom</th>";
    echo "<th>Civilite</th>";
    echo "</tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["Nom"] . "</td>";
        echo "<td>" . $row["Prenom"] . "</td>";
        echo "<td>" . $row["Civilite"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($conn);
?>