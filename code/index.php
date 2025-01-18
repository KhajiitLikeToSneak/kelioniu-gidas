<?php  
 session_start();  
if (isset($_SESSION["tipas"]))  {
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
 } else {
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_DATABASE', 'itproj');
  
  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);  
  if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

 if(isset($_POST["login"]))  
 {  
      if(empty($_POST["slapyvardis"]) || empty($_POST["slaptazodis"]))  
      {  
           echo '<script>alert("Užpildykite visus laukelius")</script>';  
      }  
      else  
      {  
           $username = mysqli_real_escape_string($db, $_POST["slapyvardis"]);  
           $password = mysqli_real_escape_string($db, md5($_POST["slaptazodis"]));
           $query = "SELECT * FROM vartotojas WHERE slapyvardis = '$username' AND slaptazodis = '$password'";   
           $result = mysqli_query($db, $query);  

		  if(mysqli_num_rows($result) > 0) {  
			$row = mysqli_fetch_assoc($result);
			if ($row['būsena'] === 'užblokuotas') {
			  echo '<script>alert("Jūs esate užblokuotas")</script>';
			} else {
			  switch ($row['tipas']) {
				case 'keliautojas':
				  $_SESSION['username'] = $username;  
				  $_SESSION['tipas'] = 'keliautojas';  
				  header("location:vartotojashome.php");  
				  break;
				case 'administratorius':
				  $_SESSION['username'] = $username;  
				  $_SESSION['tipas'] = 'administratorius';  
				  header("location:administratoriushome.php");  
				  break;
				case 'kūrėjas':
				  $_SESSION['username'] = $username;  
				  $_SESSION['tipas'] = 'kūrėjas';
				  header("location:kurejashome.php");  
				  break;
			  }
			}
		  } else {  
			echo '<script>alert("Neteisingi duomenys")</script>';  
		  } 
      }  
 }  
 if(isset($_POST["register"]))  
 {  
	header("location:registracija.php?action=register");  
 }  
 
 ?>  
 
 
  <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Kelionių gidas</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
        <link rel="stylesheet" type="text/css" href="css.css">
    </head>   
    <body>
        <h2 align="center">Kelionių gidas. Lukas Kemfertas </h2>
        <br /><br />  
        <h3 align="center"> Prisijungimas </h3>
           <div class="container" style="width:500px;">  
                <br />  
                <form method="post">  
                     <label>Prisijungimo vardas</label>  
                     <input type="text" name="slapyvardis" class="form-control" />  
                     <br />  
                     <label>Slaptažodis</label>  
                     <input type="password" name="slaptazodis" class="form-control" />  
                     <br />  
			<div class="containerFUN">
                <button type="submit" name="login" class="fun-button">Prisijungti</button>  
                <button type="submit" name="register" class="fun-button">Registracija</button>  
            </div>
                </form>  
           </div>  
      </body>  
 </html>  
 
 <?php 
 }
 ?>
 
 