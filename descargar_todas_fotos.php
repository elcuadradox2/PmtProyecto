<?php
session_start();
if (!isset($_SESSION['SESS_MEMBER_ID'])) {
    header("Location: login.php");
    exit();
}

// Establecer la zona horaria a Ciudad de México
date_default_timezone_set('America/Mexico_City');

function zipDir($sourcePath, $zip, $exclusiveLength) {
    $sourcePath = str_replace('\\', '/', realpath($sourcePath));
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($sourcePath), RecursiveIteratorIterator::SELF_FIRST);

    foreach ($files as $file) {
        $file = str_replace('\\', '/', $file);

        if (in_array(substr($file, strrpos($file, '/') + 1), array('.', '..')))
            continue;

        $file = realpath($file);

        if (is_dir($file) === true) {
            $zip->addEmptyDir(substr(str_replace($sourcePath . '/', '', $file . '/'), $exclusiveLength));
        } else if (is_file($file) === true) {
            $zip->addFromString(substr(str_replace($sourcePath . '/', '', $file), $exclusiveLength), file_get_contents($file));
        }
    }
}

$rootPath = realpath('./');
$zipFileName = 'todas_las_fotos_' . date('Y-m-d_H-i-s') . '.zip';

$directories = [
    'files_bitacoraactividades',
    'files_bitacoraoperativos',
    'files_boletaadministrativas',
    'files_boletaagresiones',
    'files_boletaalcoholemia',
    'files_boletaavisopago',
    'files_boletacolisiones',
    'files_boletaconsignaciones',
    'files_boletaentrevista',
    'files_boletanotificaciones',
    'files_boletaperitajevehicular',
    'files_boletaperitajevehiculartransportes',
    'files_boletasremociones',
    'files_boletareporteinterno',
    'files_boletaserviciossociales'
];

$zip = new ZipArchive();
if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
    echo "No se pudo crear el archivo ZIP.";
    exit;
}

foreach ($directories as $directory) {
    $fullPath = $rootPath . '/' . $directory;
    if (is_dir($fullPath)) {
        $zip->addEmptyDir($directory);
        zipDir($fullPath, $zip, strlen($directory) + 1);
    }
}

$zip->close();

header("Content-Type: application/zip");
header("Content-Disposition: attachment; filename=$zipFileName");
header("Content-Length: " . filesize($zipFileName));
readfile($zipFileName);
unlink($zipFileName);
exit;
?>