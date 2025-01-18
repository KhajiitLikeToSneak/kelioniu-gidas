<?php   
 session_start();  
 if(isset($_SESSION["tipas"]) && $_SESSION["tipas"] == 'administratorius')  {  
	 if(isset($_POST["logout"]))
	 {
		 header("location:logout.php"); 
	 }
	 if(isset($_POST["block"]))
	 {
		 header("location:blokavimas.php"); 
	 }
?> 
<!DOCTYPE html>
<html>   
      <head>  
      	<link rel="stylesheet" type="text/css" href="css.css">
      </head>   
<body>
	  <h2 align="center">Kelionių gidas. Lukas Kemfertas </h2>
	<br /><br />  
	<h3 align="center"> Administratoriaus funkcijos </h3>
	<form method="post" action="" class="center-form">
	<div class="containerFUN">
		<button type="submit" name="block" class="fun-button">Blokuoti/Atblokuoti vartotoją</button>  
		<button type="submit" name="logout" class="fun-buttonA">Atsijungti</button>  
	</div>
	</form>
</body>
</html>
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