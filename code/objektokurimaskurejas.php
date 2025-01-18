<?php   
 session_start();  
 if(isset($_SESSION["tipas"]) && $_SESSION["tipas"] == 'kūrėjas')  {  

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'itproj');

$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (isset($_POST["atgal"])) {
    header("location:kurejashome.php");
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
<form action="kurejashome.php" method="get">
    <input type="submit" value="Atgal">
</form>
	<form method="post" action="" enctype="multipart/form-data">
        <?php
		echo "<table border='1'>";
		echo "<caption>Objekto kūrimas</caption>";
        echo "<table border='1'><tr><th>Paveikslėlis</th><th>Pavadinimas</th><th>Koordinatė X</th><th>Koordinatė Y</th><th>Lankytina trukmė, min</th><th>Tipas</th><th>Aprašymas</th></tr>";
        echo "<tr>";
		echo "<td><input type='file' name='paveikslelis'></td>";
		echo "<td><input type='text' name='pavadinimas' value=''></td>";
        echo "<td><input type='text' name='koordinatex' value=''></td>";
		echo "<td><input type='text' name='koordinatey' value=''></td>";
		echo "<td><input type='text' name='lankytinatrukme' value=''></td>";
        echo "<td>
			<select name='tipas'>
				<option value='gamtinis'>gamtinis</option>
				<option value='istorinis'>istorinis</option>
				<option value='kultūrinis'>kultūrinis</option>
				<option value='pramoginis'>pramoginis</option>
				<option value='religinis'>religinis</option>
				<option value='architektūrinis'>architektūrinis</option>
			</select>
		  </td>";
		echo "<td><input type='text' name='aprasymas' value=''></td>";
        echo "</tr>";
        echo "</table>";
        echo "<br>";

		echo "<button type='submit' class='below'>Sukurti</button>";
        ?>
    </form>
</body>

</html>

<?php
$vartotojo_slapyvardis = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['atgal'])) {
        $pavadinimas = mysqli_real_escape_string($db, $_POST["pavadinimas"]);
        $koordinatex = mysqli_real_escape_string($db, $_POST["koordinatex"]);
        $koordinatey = mysqli_real_escape_string($db, $_POST["koordinatey"]);
		$lankytinatrukme = mysqli_real_escape_string($db, $_POST["lankytinatrukme"]);
		$tipas = mysqli_real_escape_string($db, $_POST["tipas"]);
		$aprasymas = mysqli_real_escape_string($db, $_POST["aprasymas"]);

		$paveikslelis = "paveiksleliai/empty.jpg";
		$target_dir = "paveiksleliai/";
		if(isset($_FILES["paveikslelis"]) && $_FILES["paveikslelis"]["error"] == 0) {
			$file_name = basename($_FILES["paveikslelis"]["name"]);
			$target_file = $target_dir . $file_name;
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

			// Check if it's an image
			$check = getimagesize($_FILES["paveikslelis"]["tmp_name"]);
			if($check !== false) {
				// Allow only certain file types
				if(in_array($imageFileType, ["jpg", "jpeg"])) {
					if (move_uploaded_file($_FILES["paveikslelis"]["tmp_name"], $target_file)) {
						$paveikslelis = $target_file;
					} else {
						echo "<script>alert('Paveikslėlio įkėlimas nepavyko.'); window.location.href = 'objektokurimaskurejas.php';</script>";
						return;
					}
				} else {
					echo "<script>alert('Leidžiami tik JPG, JPEG formatai.'); window.location.href = 'objektokurimaskurejas.php';</script>";
					return;
				}
			} else {
				echo "<script>alert('Failas nėra paveikslėlis.'); window.location.href = 'objektokurimaskurejas.php';</script>";
				return;
			}
		}

        if ($pavadinimas != '' and $koordinatex != '' and $koordinatey != '' and $tipas != '' and $aprasymas != '') {
			if (is_numeric($koordinatex) && is_numeric($koordinatey)) {
				if (empty($lankytinatrukme) || !filter_var($lankytinatrukme, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1)))) {
					echo '<script>alert("Lankytina objekto trukmė turi būti teigiamas sveikasis skaičius")</script>';
				} else {
					$sql = "INSERT INTO objektas (pavadinimas, koordinatex, koordinatey, trukme, tipas, aprasymas, paveikslelis) 
						VALUES ('$pavadinimas', '$koordinatex', '$koordinatey','$lankytinatrukme', '$tipas', '$aprasymas', '$paveikslelis')";
					$db->query($sql);
		
					echo "<script>alert('Objektas sukurtas'); window.location.href = 'kurejashome.php';</script>";
				}
			} else {
                echo '<script>alert("Koordinatė X ir Koordinatė Y turi būti skaitinė")</script>';
            }
		} else {
			echo '<script>alert("Neužpildyti visi objekto duomenys")</script>'; 
        }
    }
}


$db->close();
?>
<?php  
 }  else if (isset($_SESSION["tipas"]))  {
	 	  switch ($_SESSION["tipas"]) {
		case 'administratorius':
		  header("location:administratoriushome.php");  
		  break;
		case 'keliautojas':
		  header("location:vartotojashome.php");  
		  break;
 } 
 } else {
	header("location:index.php");  
	}
?> 