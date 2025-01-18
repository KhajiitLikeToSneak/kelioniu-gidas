<?php   
 session_start();  
 if(isset($_SESSION["tipas"]))  
 {  
	  switch ($_SESSION["tipas"]) {
		case 'keliautojas':
		  header("location:vartotojashome.php");  
		  break;
		case 'administratorius':
		  header("location:administratoriushome.php");  
		  break;
		case 'kūrėjas':
		  header("location:kurejashome.php");  
		  break;
	  } 
 }  else {
	  define('DB_SERVER', 'localhost');
	  define('DB_USERNAME', 'root');
	  define('DB_PASSWORD', '');
	  define('DB_DATABASE', 'itproj');
	  
	  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);  
	  if ($db->connect_error) {
	  die("Connection failed: " . $db->connect_error);
	}
	 if(isset($_POST["atgal"]))  
	 {  
		header("location:index.php");  
	 }  

	 if(isset($_POST["register"]))  
	 {  
		  $password = $_POST['slaptazodis'];
		  $username = $_POST['slapyvardis'];

			$usernameChars = preg_match('/[^A-Za-z0-9]/', $username);
			if ($usernameChars) {
				echo '<script>alert("Slapyvardyje turi būti tik raidės ir skaičiai")</script>';  
			} else {

		  $uppercase = preg_match('@[A-Z]@', $password);
		  $lowercase = preg_match('@[a-z]@', $password);
		  $number    = preg_match('@[0-9]@', $password);
		  $specialChars = preg_match('@[^\w]@', $password);
			  
			
		  if(empty($_POST["slapyvardis"]) || empty($_POST["slaptazodis"]))  
		  {  
			   echo '<script>alert("Užpildykite visus laukelius")</script>';  
		  }  
		  elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 6) {
			  echo '<script>alert("Slaptažodį turi sudaryti bent 6 simboliai, bent viena didžioji raidė, bent vienas skaičius ir bent vienas specialusis simbolis.")</script>';
			  }
		  else  
		  {  
			   $username = mysqli_real_escape_string($db, $_POST["slapyvardis"]);  
			   $password = mysqli_real_escape_string($db, md5($_POST["slaptazodis"])); 
			   $tipas = mysqli_real_escape_string($db, $_POST["tipas"]);

				$checkUsername = "SELECT * FROM vartotojas WHERE slapyvardis = '$username'";
				$checkResult = mysqli_query($db, $checkUsername);

				if (mysqli_num_rows($checkResult) > 0) {
					echo '<script>alert("Toks slapyvardis sistemoje jau egzistuoja, pasirinkite kitą")</script>';
				} else {
					$query = "INSERT INTO vartotojas (slaptazodis, slapyvardis, tipas) VALUES('$password','$username','$tipas')";  
					$db->query($query);
			  		$db->close();
			  		echo "<script>alert('Registracija sėkminga'); window.location.href = 'index.php';</script>";
				}
		  }  
			}
	 } 
	 ?>  

	 <!DOCTYPE html>  
	 <html>  
		  <head>  
				<title>Registracija</title>  
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
			   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
			   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
			   <link rel="stylesheet" type="text/css" href="css.css">
		  </head>  
		  <body>  
			<h2 align="center">Kelionių gidas. Lukas Kemfertas </h2>
			<br /><br />  
			<h3 align="center"> Registracija </h3>
					<div class="container" style="width:500px;">  
					<br />  
					<form method="post">  
						 <label>Prisijungimo vardas</label>  
						 <input type="text" name="slapyvardis" class="form-control" />  
						 <br />  
						 <label>Slaptažodis</label>  
						 <input type="password" name="slaptazodis" class="form-control" />  
						 <br />  
						<label>Vartotojo tipas: </label>
						<select name="tipas" class="form-control">
							<option value="keliautojas">Keliautojas</option>
							<option value="kūrejas">Kūrėjas</option>
						</select>
						<br />  
						<div class="containerFUN">
							<button type="submit" name="register" class="fun-button">Registruotis</button>  
							<button type="submit" name="atgal" class="fun-button">Atgal</button>  
						</div>

					</form>
					</div>
					
			   
		  </body>  
	 </html>  
	 <?php  
	}
	?> 
