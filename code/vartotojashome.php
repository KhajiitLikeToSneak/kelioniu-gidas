<?php   
 session_start();  
 if(isset($_SESSION["tipas"]) && $_SESSION["tipas"] == 'keliautojas')  {  

 if(isset($_POST["logout"]))
 {
	 header("location:logout.php"); 
 }
 if(isset($_POST["forumas"]))
 {
	 header("location:forumas.php"); 
 }
 if(isset($_POST["rinktikelione"]))
 {
	 header("location:kelionesrinkimas.php"); 
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
	<h3 align="center"> Keliautojo funkcijos </h3>
	<form method="post" action="" class="center-form">
	<div class="containerFUN">
		<button type="submit" name="rinktikelione" class="fun-button">Gauti kelionės maršrutą</button>  
		<button type="submit" name="forumas" class="fun-button">Forumas</button>  
		<button type="submit" name="logout" class="fun-buttonA">Atsijungti</button>  
	</div>
	</form>
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