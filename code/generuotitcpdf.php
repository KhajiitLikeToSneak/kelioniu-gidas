<?php
session_start();

require_once('TCPDF-main/tcpdf.php');
require_once('PDFHelper.php');

$pdfHelper = new PDFHelper();

// Get the HTML content from the session variable
$html = isset($_SESSION['html_content']) ? $_SESSION['html_content'] : '';

// Append the HTML content to the PDF
$pdfHelper->append($html);

// Output the PDF
$pdfHelper->output('Kelionės maršrutas.pdf');

// Clear the session variable
unset($_SESSION['html_content']);
?>