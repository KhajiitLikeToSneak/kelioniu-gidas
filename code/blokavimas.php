<?php   
 session_start();  
 if(isset($_SESSION["tipas"]) && $_SESSION["tipas"] == 'administratorius')  {  
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_DATABASE', 'itproj');
  
  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);  
  if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
  

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css.css">
</head>
  <h2 align="center">Kelionių gidas. Lukas Kemfertas </h2>
<br /><br />  
<body>
<form action="administratoriushome.php" method="get">
    <input type="submit" value="Atgal">
</form>

</body>
</html>

<?php
$sql = "SELECT * FROM vartotojas WHERE slapyvardis != '" . $_SESSION['username'] . "'";
$result = $db->query($sql);


echo "<table border='1'>";
echo "<caption>Vartotojų sąrašas</caption>";
echo "<tr><th>Slapyvardis</th><th>Tipas</th><th>Būsena</th><th>Veiksmas</th></tr>";


while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['slapyvardis'] . "</td>";
    echo "<td>" . $row['tipas'] . "</td>";
    echo "<td>" . $row['būsena'] . "</td>";


    echo "<td>";
    if ($row['būsena'] == 'neužblokuotas') {
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='slapyvardis' value='" . $row['slapyvardis'] . "'>";
        echo "<input type='submit' name='block' value='Blokuoti'>";
        echo "</form>";
    } elseif ($row['būsena'] == 'užblokuotas') {
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='slapyvardis' value='" . $row['slapyvardis'] . "'>";
        echo "<input type='submit' name='unblock' value='Atblokuoti'>";
        echo "</form>";
    }
    echo "</td>";

    echo "</tr>";
}

echo "</table>";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $slapyvardis = $_POST['slapyvardis'];

    if (isset($_POST['block'])) {
        $sql = "UPDATE vartotojas SET būsena = 'užblokuotas' WHERE slapyvardis = '$slapyvardis'";
        $db->query($sql);
    } elseif (isset($_POST['unblock'])) {
        $sql = "UPDATE vartotojas SET būsena = 'neužblokuotas' WHERE slapyvardis = '$slapyvardis'";
        $db->query($sql);
    }

    header("Location: " . $_SERVER['PHP_SELF']);
}


$db->close();
?>
<?php  
 }  else if (isset($_SESSION["tipas"]))  {
	 	  switch ($_SESSION["tipas"]) {
		case 'keliautojas':
		  header("location:vartotojashome.php");  
		  break;
		case 'kūrėjas':
		  header("location:kurejashome.php");  
		  break;
 } 
 } else {
	header("location:index.php");  
	}
?> 