<?php
	use Dompdf\Dompdf;

	include_once __DIR__ . '/dompdf/autoload.inc.php';

	$html = $_COOKIE["conv"];
	ob_end_clean();
	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream("sample.pdf");
	
?>