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

require_once('PDFHelper.php');
$pdfHelper = new PDFHelper();

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
<form action="vartotojashome.php" method="get">
    <input type="submit" value="Atgal">
    </form>
    <form method="post" action="">
        <?php
        $gamtinis_checked = isset($_POST['gamtinis']) ? 'checked' : '';
        $istorinis_checked = isset($_POST['istorinis']) ? 'checked' : '';
        $kulturinis_checked = isset($_POST['kulturinis']) ? 'checked' : '';
        $pramoginis_checked = isset($_POST['pramoginis']) ? 'checked' : '';
        $religinis_checked = isset($_POST['religinis']) ? 'checked' : '';
        $architekturinis_checked = isset($_POST['architekturinis']) ? 'checked' : '';
        $nakvyne_checked = isset($_POST['nakvyne']) ? 'checked' : '';
        
        $isvykimasx_value = isset($_POST['isvykimasx']) ? htmlspecialchars($_POST['isvykimasx']) : '';
        $isvykimasy_value = isset($_POST['isvykimasy']) ? htmlspecialchars($_POST['isvykimasy']) : '';
        $maxatstumas_value = isset($_POST['maxatstumas']) ? htmlspecialchars($_POST['maxatstumas']) : '';
        $dienu_skaicius_value = isset($_POST['dienu_skaicius']) ? htmlspecialchars($_POST['dienu_skaicius']) : '';

        echo "<table border='1'>";
        echo "<caption>Pasirinkite objektų tipus, kuriuos norite apkeliauti ir užpildykite kelionės duomenis</caption>";
        echo "<tr><th>Gamtinis</th><th>Istorinis</th><th>Kultūrinis</th><th>Pramoginis</th><th>Religinis</th><th>Architektūrinis</th><th>Išvykimo koordinatė X</th><th>Išvykimo koordinatė Y</th><th>Maksimalus kelionės atstumas, km. per dieną</th><th>Dienų skaičius</th><th>Reikalinga nakvynė</th></tr>";
        echo "<tr>";
        echo "<td><input type='checkbox' name='gamtinis' $gamtinis_checked></td>";
        echo "<td><input type='checkbox' name='istorinis' $istorinis_checked></td>";
        echo "<td><input type='checkbox' name='kulturinis' $kulturinis_checked></td>";
        echo "<td><input type='checkbox' name='pramoginis' $pramoginis_checked></td>";
        echo "<td><input type='checkbox' name='religinis' $religinis_checked></td>";
        echo "<td><input type='checkbox' name='architekturinis' $architekturinis_checked></td>";
        echo "<td><input type='text' name='isvykimasx' value='$isvykimasx_value'></td>";
        echo "<td><input type='text' name='isvykimasy' value='$isvykimasy_value'></td>";
        echo "<td><input type='text' name='maxatstumas' value='$maxatstumas_value'></td>";
        echo "<td><input type='text' name='dienu_skaicius' value='$dienu_skaicius_value'></td>";
        echo "<td><input type='checkbox' name='nakvyne' $nakvyne_checked></td>";
        echo "</tr>";
        echo "</table>";

		echo "<button type='submit' class='below'>Rinktis</button>";
        ?>
    </form>
</body>
</html>  


<?php
$vartotojo_slapyvardis = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['atgal'])) {
        $maxatstumas = $_POST['maxatstumas'];
        $isvykimasx = $_POST['isvykimasx'];
        $isvykimasy = $_POST['isvykimasy'];
        $dienu_skaicius = $_POST['dienu_skaicius'];

        if (!filter_var($dienu_skaicius, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1)))) {
            echo '<script>alert("Dienų skaičius turi būti teigiamas sveikasis skaičius")</script>';
            exit;
        }

        if (!isset($_POST['gamtinis']) && !isset($_POST['istorinis']) && !isset($_POST['kulturinis']) && !isset($_POST['pramoginis']) && !isset($_POST['religinis']) && !isset($_POST['architekturinis'])) {
            echo '<script>alert("Turi būti pasirinktas bent vienas objekto tipas")</script>'; 
            exit;
        } elseif (empty($maxatstumas) || !filter_var($maxatstumas, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1)))) {
            echo '<script>alert("Maksimalus kelionės atstumas turi būti teigiamas sveikasis skaičius")</script>';
            exit;
        } elseif (!is_numeric($isvykimasx) || !is_numeric($isvykimasy) || (int)$isvykimasx != $isvykimasx || (int)$isvykimasy != $isvykimasy) {
            echo '<script>alert("Išvykimo koordinatės turi būti užpildytos sveikaisiais skaičiais")</script>';
            exit;
        } else {
            $selected_types = [];
            if (isset($_POST['gamtinis'])) $selected_types[] = 'gamtinis';
            if (isset($_POST['istorinis'])) $selected_types[] = 'istorinis';
            if (isset($_POST['kulturinis'])) $selected_types[] = 'kultūrinis';
            if (isset($_POST['pramoginis'])) $selected_types[] = 'pramoginis';
            if (isset($_POST['religinis'])) $selected_types[] = 'religinis';
            if (isset($_POST['architekturinis'])) $selected_types[] = 'architektūrinis';

            $query = "SELECT * FROM objektas WHERE tipas IN ('" . implode("','", $selected_types) . "')";
            $result = $db->query($query);

            $objects = [];
            while ($row = $result->fetch_assoc()) {
                $objects[] = $row;
            }

            $current_x = $isvykimasx;
            $current_y = $isvykimasy;
            $total_distance = 0;
            $route = [];
            $time = 0;
            $day_route = [];
            $previous_day_route = [];
            $day = 1;

            $last_day_x = null;
            $last_day_y = null;

            $cant_make = false;

            echo "<h3>Kelionės maršrutas</h3>";
            $pdfHelper->append("<h2>Jūsų kelionės maršrutas ir informacija</h2>");
            $pdfHelper->append("<br>");
            $pdfHelper->append("<br>");
            $pdfHelper->append("<strong><em>Pastaba*</em></strong><em> Jeigu kelionės maršrute yra mažiau dienų negu nustatyta, vadinasi likusioms dienoms, pagal jūsų nustatytus duomenis, kelionės pratęsti nebeįmanoma.</em>");

            echo "<br>";
            echo "<strong><em>Pastaba*</em></strong><em> Jeigu kelionės maršrute yra mažiau dienų negu nustatyta, vadinasi likusioms dienoms, pagal jūsų nustatytus duomenis, kelionės pratęsti nebeįmanoma.</em>";
            echo "<br>";

            while (!empty($objects) && $day <= $dienu_skaicius) {
                $day_distance = 0;
                $time = 0;
                $day_route = [];

                while (!empty($objects) && $day_distance < $maxatstumas && $time < 840) {
                    $closest_object = null;
                    $closest_distance = PHP_INT_MAX;

                    foreach ($objects as $key => $object) {
                        $distance = sqrt(pow($object['koordinatex'] - $current_x, 2) + pow($object['koordinatey'] - $current_y, 2));
                        if ($distance < $closest_distance) {
                            $closest_distance = $distance;
                            $closest_object = $key;
                        }
                    }

                    if ($closest_object !== null) {
                        $object = $objects[$closest_object];
                        unset($objects[$closest_object]);

                        if ($day_distance + $closest_distance > $maxatstumas) {
                            break;
                        }

                        $day_route[] = $object;
                        $day_distance += $closest_distance;
                        $total_distance += $closest_distance;
                        $time += round($closest_distance / 2) + $object['trukme'];
    
                        $current_x = $object['koordinatex'];
                        $current_y = $object['koordinatey'];
                    }
                }

                if (empty($day_route) && $day == 1) {
                    $cant_make = true;
                    break;
                }

                if (isset($_POST['nakvyne'])) {
                    $query = "SELECT * FROM nakvyne";
                    $result = $db->query($query);
                
                    $closest_nakvyne = null;
                    $closest_distance = PHP_INT_MAX;
                
                    while ($row = $result->fetch_assoc()) {
                        $distance = sqrt(pow($row['koordinatex'] - $current_x, 2) + pow($row['koordinatey'] - $current_y, 2));
                        if ($distance < $closest_distance) {
                            $closest_distance = $distance;
                            $closest_nakvyne = $row;
                        }
                    }
                
                    if ($closest_nakvyne !== null) {
                        while (!empty($day_route) && ($day_distance + $closest_distance > $maxatstumas)) {
                            $last_object = array_pop($day_route);
                            $previous_object = end($day_route);
                            
                            $previous_x = $previous_object ? $previous_object['koordinatex'] : $isvykimasx;
                            $previous_y = $previous_object ? $previous_object['koordinatey'] : $isvykimasy;
                
                            $removed_distance = sqrt(pow($last_object['koordinatex'] - $previous_x, 2) + pow($last_object['koordinatey'] - $previous_y, 2));
                            
                            $day_distance -= $removed_distance;
                            $time -= round($removed_distance / 2) + (isset($last_object['trukme']) ? $last_object['trukme'] : 0);
                
                            $closest_distance = sqrt(pow($closest_nakvyne['koordinatex'] - $previous_x, 2) + pow($closest_nakvyne['koordinatey'] - $previous_y, 2));
                        }
                
                        if ($day_distance + $closest_distance <= $maxatstumas) {
                            $day_route[] = $closest_nakvyne;
                            $travel_time = round($closest_distance / 2);
                            $time += $travel_time;
                            $day_distance += $closest_distance;
                        } else {
                            return;
                        }
                    }
                }

                if (count($day_route) == 1 && $day == 1 && isset($_POST['nakvyne'])) {
                    $cant_make = true;
                    break;
                }

                // Check for identical consecutive days
                if ($day_route == $previous_day_route) {
                    break;
                }

                // Skip empty day
                if (empty($day_route)) {
                    break;
                }

                // Skip non progressing day
                if ($day_distance == 0) {
                    break;
                }

                // Skip day if it only has one element and if nakvyne is checked
                if (count($day_route) == 1 && isset($_POST['nakvyne'])) {
                    break;
                }

                $pdfHelper->append("<br>");
                $pdfHelper->append("<br>");
                echo "<h3>Diena {$day}:</h3>";
                $pdfHelper->append("<h3>Diena {$day}:</h3>");
                echo "<table border='1'>";
                $pdfHelper->append("<table border='1'>");
                $pdfHelper->append('<hr style="border: 1px solid black; width: 100%;">');
                echo "<tr><th>Išvykimo koordinatės</th><th>Atvykimo koordinatės</th><th>Kelionės laikas</th><th>Objekto pavadinimas</th><th>Objekto lankytina trukmė</th><th>Paveikslėlis</th><th>Aprašymas</th><th>Tipas</th></tr>";
                $pdfHelper->append("<tr><th><strong>Išvykimo koordinatės</strong></th><th><strong>Atvykimo koordinatės</strong></th><th><strong>Kelionės laikas</strong></th><th><strong>Objektas</strong></th><th><strong>Lankytina trukmė</strong></th><th><strong>Aprašymas</strong></th><th><strong>Tipas</strong></th></tr>");
                $pdfHelper->append('<hr style="border: 1px solid black; width: 100%;">');

                if ($day == 1) {
                    $previous_x = $isvykimasx;
                    $previous_y = $isvykimasy;
                } else
                {
                    $previous_x = $last_day_x;
                    $previous_y = $last_day_y;
                }

                foreach ($day_route as $step) {
                    $distance = sqrt(pow($step['koordinatex'] - $previous_x, 2) + pow($step['koordinatey'] - $previous_y, 2));
                    $travel_time = round($distance / 2);
                    echo "<tr>";
                    $pdfHelper->append("<tr><td colspan='5'>&nbsp;</td></tr>");
                    $pdfHelper->append("<tr>");
                    
                    echo "<td>({$previous_x}, {$previous_y})</td>";
                    $pdfHelper->append("<td>({$previous_x}, {$previous_y})</td>");
                    echo "<td>({$step['koordinatex']}, {$step['koordinatey']})</td>";
                    $pdfHelper->append("<td>({$step['koordinatex']}, {$step['koordinatey']})</td>");
                    echo "<td>{$travel_time} min</td>";
                    $pdfHelper->append("<td>{$travel_time} min</td>");
                    if (isset($step['trukme'])) {
                        echo "<td>{$step['pavadinimas']}</td>";
                        $pdfHelper->append("<td>{$step['pavadinimas']}</td>");
                        echo "<td>{$step['trukme']} min</td>";
                        echo "<td><img src='{$step['paveikslelis']}' width='200' height='100' /></td>";
                        echo "<td>{$step['aprasymas']}</td>";
                        echo "<td>{$step['tipas']}</td>";
                        $pdfHelper->append("<td>{$step['trukme']} min</td>");
                        $pdfHelper->append("<td>{$step['aprasymas']}</td>");
                        $pdfHelper->append("<td>{$step['tipas']}</td>");
                    } else {
                        echo "<td>{$step['pavadinimas']}</td>";
                        $pdfHelper->append("<td>{$step['pavadinimas']}</td>");
                        echo "<td>-</td>";
                        echo "<td>-</td>";
                        echo "<td>-</td>";
                        echo "<td>-</td>";
                        $pdfHelper->append("<td>-</td>");
                        $pdfHelper->append("<td>-</td>");
                        $pdfHelper->append("<td>-</td>");
                    }

                    echo "</tr>";
                    $pdfHelper->append("</tr>");
                    $pdfHelper->append("<tr><td colspan='6'>&nbsp;</td></tr>");
                    $previous_x = $step['koordinatex'];
                    $previous_y = $step['koordinatey'];

                    $pdfHelper->append('<hr style="border: 1px solid black; width: 100%;">');
                }

                $pdfHelper->append("</table>");
                $pdfHelper->append('<hr style="border: 1px solid black; width: 100%;">');

                $hours = floor($time / 60);
                $minutes = $time % 60;
                $day_distance = round($day_distance, 2);


                echo "<tr><td colspan='8'>&nbsp;</td></tr>";
                $pdfHelper->append("<tr><td colspan='6'>&nbsp;</td></tr>");
                echo "<tr>";
                $pdfHelper->append("<table border='1'>");
                echo "<td colspan='2'><strong>Bendras $day dienos kelionės laikas:</strong></td>";
                echo "<td colspan='6'>{$hours} val. {$minutes} min.</td>";
                $pdfHelper->append("<tr><td colspan='2'><strong>Bendras $day dienos kelionės laikas:</strong> {$hours} val. {$minutes} min.</td></tr>");
                echo "</tr>";

                $pdfHelper->append("<tr><td colspan='6'>&nbsp;</td></tr>");

                echo "<tr>";
                echo "<td colspan='2'><strong>Bendras $day dienos kelionės atstumas:</strong></td>";
                echo "<td colspan='6'>{$day_distance} km</td>";
                $pdfHelper->append("<tr><td colspan='2'><strong>Bendras $day dienos kelionės atstumas:</strong> {$day_distance} km</td></tr>");
                echo "</tr>";

                echo "</table>";
                $pdfHelper->append("</table>");
                $pdfHelper->addLine();

                $day++;
                $previous_day_route = $day_route;
                $last_day_x = $previous_x;
                $last_day_y = $previous_y;
                $current_x = $last_day_x;
                $current_y = $last_day_y;
            }

            if ($cant_make) {
                echo "<script>alert('Su šia duomenų įvestimi kelionės maršruto neįmanoma sudaryti net vienai dienai.'); window.location.href = 'kelionesrinkimas.php';</script>";
                exit;
            }
        }

        // Store the HTML content in a session variable
        $_SESSION['html_content'] = $pdfHelper->html_content;

        echo "<form action='generuotitcpdf.php' method='post'> <button type='submit' class='below'>Atsisiųsti kelionės maršruto PDF</button></form>";
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
		case 'kūrėjas':
		  header("location:kurejashome.php");  
		  break;
 } 
 } else {
	header("location:index.php");  
	}
?> 
