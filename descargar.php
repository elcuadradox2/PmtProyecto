<?php
// Obtén el nombre del archivo desde la query string y asegúrate de que no contenga rutas relativas para seguridad
$archivo = basename($_GET['archivo']);

// Define la ruta al directorio donde se almacenan los archivos PDF
$rutaArchivo = __DIR__ . '/boletas/' . $archivo . '.pdf';

// Verifica si el archivo existe
if(file_exists($rutaArchivo)) {
    // Establece los encabezados para forzar la descarga
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($rutaArchivo) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($rutaArchivo));
    // Limpia el buffer de salida
    ob_clean();
    flush();
    // Lee el archivo y envíalo al navegador
    readfile($rutaArchivo);
    exit;
} else {
    // El archivo no existe
    echo "El archivo solicitado no existe.";
}
?>