<?php
$tipo = 'l';
// Si queremos exportar a PDF
if($tipo == 'pdf'){
    require_once 'dompdf/dompdf_config.inc.php';
    
    $dompdf = new DOMPDF();
    $dompdf->load_html( file_get_contents( 'totales.php' ) );
    $dompdf->render();
    $dompdf->stream("mi_archivo.pdf");
} else{
    require_once 'totales.php';
    
    header("Content-type: application/vnd.ms-pdf");
    header("Content-Disposition: attachment; filename=mi_archivo.pdf");
    header("Pragma: no-cache");
    header("Expires: 0");    
}