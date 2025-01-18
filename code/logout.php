<?php

session_start();
unset($_SESSION['username']);
unset($_SESSION['tipas']);
header("location:index.php")

?>