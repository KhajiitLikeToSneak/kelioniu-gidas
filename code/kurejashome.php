<?php   
 session_start();  
 if(isset($_SESSION["tipas"]) && $_SESSION["tipas"] == 'kūrėjas')  {  

	if(isset($_POST["kurtiobjekta"]))
	{
		header("location:objektokurimaskurejas.php");
		exit();
	}
	 if(isset($_POST["logout"]))
	 {
		 header("location:logout.php");
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
	<h3 align="center"> Kūrėjo funkcijos </h3>
	<form method="post" action="">
	<div class="containerFUN">
		<button type="submit" name="kurtiobjekta" class="fun-button">Sukurti objektą</button>  
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
		case 'keliautojas':
		  header("location:vartotojashome.php");  
		  break;
 } 
 } else {
	header("location:index.php");  
	}
?> 