<?php   
 session_start();  
 if(isset($_SESSION["tipas"]) && $_SESSION["tipas"] == 'keliautojas')  {  

  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_DATABASE', 'itproj');
 
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE); 

if(isset($_POST["atgal"]))
{
    header("location:vartotojashome.php"); 
}

if (isset($_GET['id'])) {
    $objekto_id = $_GET['id'];

    
    $check_sql = "SELECT * FROM objektas WHERE id = $objekto_id";
    $check_result = $db->query($check_sql);

    if ($check_result->num_rows == 0) {
        header("location:forumas.php"); 
        exit();
    }
} else {
    header("location:forumas.php"); 
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
	  <h2 align="center">Kelionių gidas. Lukas Kemfertas </h2>
    <br /><br />  
	<h2 align="center"> Forumas </h2>
<form action="forumas.php" method="get">
    <input type="submit" value="Atgal">
    </form>
</body>
</html>  


<?php
$sql = "SELECT * FROM objektas WHERE id = $objekto_id";
$result = $db->query($sql);

echo "<table border='1'>";
echo "<caption>Objekto informacija</caption>";
echo "<tr><th>Paveikslėlis</th><th>Pavadinimas</th><th>Koordinatės</th><th>Lankytina trukmė</th><th>Tipas</th><th>Aprašymas</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td><img src='" . $row['paveikslelis'] . "' alt='Objekto paveikslėlis' style='max-width:200px; height:auto;'></td>";
    echo "<td>" . $row['pavadinimas'] . "</td>";
    echo "<td>" . "(" .$row['koordinatex'] . " , " . $row['koordinatey'] . ")". "</td>";
    echo "<td>" . $row['trukme'] . " min." . "</td>";
    echo "<td>" . $row['tipas'] . "</td>";
    echo "<td>" . $row['aprasymas'] . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "<br><br>";


$sql = "SELECT * FROM atsiliepimas WHERE fk_objektas_id = '$objekto_id'";
$result = $db->query($sql);

echo "<table border='1'>";
echo "<caption>Objekto atsiliepimai</caption>";
echo "<tr><th>Vartotojas</th><th>Komentaras</th></tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['fk_vartotojas_slapyvardis'] . "</td>";
        echo "<td>" . $row['komentaras'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr>";
    echo "<td colspan='2'>Šis objektas atsiliepimų neturi.</td>";
    echo "</tr>";
}

echo "</table>";
echo "<br><br>";

?>

    <form method="post" action="">
        <table border='1'>
            <caption>Palikti atsiliepimą</caption>
            <tr>
                <th>Komentaras</th>
            </tr>
            <tr>
                <td><input type="text" name="komentaras" value=""></td>
            </tr>
        </table>
        <br>
        <button type="submit" class="below">Sukurti atsiliepimą</button>
    </form>

    <?php

    $vartotojo_slapyvardis = $_SESSION['username'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST['atgal'])) {
            $komentaras = mysqli_real_escape_string($db, $_POST["komentaras"]);

            if ($komentaras != '') {
                $sql = "INSERT INTO atsiliepimas (komentaras, fk_vartotojas_slapyvardis, fk_objektas_id) 
                        VALUES ('$komentaras', '$vartotojo_slapyvardis', '$objekto_id')";
                $db->query($sql);

                echo "<script>alert('Atsiliepimas sukurtas'); window.location.href = 'atsiliepimai.php?id=$objekto_id';</script>";
            } else {
                echo "<script>alert('Neužpildytas atsiliepimas');</script>";
            }
        }
    }

    $db->close();
    ?>

</body>
</html>

<?php  
 }  else if (isset($_SESSION["tipas"]))  {
	 	  switch ($_SESSION["tipas"]) {
		case 'administratorius':
		  header("location:administratoriushome.php");  
		  break;
		case 'kūrėjas':
		  header("location:kurejashome.php");  
		  break;
 } 
 } else {
	header("location:index.php");  
	}
?> 


