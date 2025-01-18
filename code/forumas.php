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
<form action="vartotojashome.php" method="get">
    <input type="submit" value="Atgal">
    </form>
</body>
</html>  


<?php
$sql = "SELECT * FROM objektas";
$result = $db->query($sql);

echo "<table border='1'>";
echo "<caption>Objektų sąrašas</caption>";
echo "<tr><th>Paveikslėlis</th><th>Pavadinimas</th><th>Koordinatės</th><th>Lankytina trukmė</th><th>Tipas</th><th>Aprašymas</th><th></th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td><img src='" . $row['paveikslelis'] . "' alt='Objekto paveikslėlis' style='max-width:200px; height:auto;'></td>";
    echo "<td>" . $row['pavadinimas'] . "</td>";
    echo "<td>" . "(" .$row['koordinatex'] . " , " . $row['koordinatey'] . ")". "</td>";
    echo "<td>" . $row['trukme'] . " min." . "</td>";
    echo "<td>" . $row['tipas'] . "</td>";
    echo "<td>" . $row['aprasymas'] . "</td>";

    echo "<td>";
    echo "<form action='atsiliepimai.php' method='get' style='display:inline;'>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "<button type='submit' class='fun-button' style='margin-right:10px;'>Atsiliepimai</button>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}

echo "</table>";

$db->close();
?>
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
