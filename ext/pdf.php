<?php
require_once '../dompdf/autoload.inc.php';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://viking.dev/ext/index.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$my_html = curl_exec($ch);
curl_close($ch);


// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($my_html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

$output = $dompdf->output();
file_put_contents('latest.pdf', $output);