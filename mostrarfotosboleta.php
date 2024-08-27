<?php
include 'session_timeout.php';
include "sidebar.php";
include('configbd.php');

// Ajustar la zona horaria a tu región
date_default_timezone_set('America/Mexico_City'); // Cambia esto a tu zona horaria

// Define la ruta a la carpeta que contiene las fotos
$rutaCarpeta = 'fotosboletas/';

// Verificar si la carpeta existe
if (!is_dir($rutaCarpeta)) {
    echo 'La carpeta de fotos no existe.';
    exit;
}

// Obtén todos los archivos de la carpeta
$archivos = scandir($rutaCarpeta);

// Elimina las entradas "." y ".." del array
$archivos = array_diff($archivos, array('.', '..'));

// Ordena los archivos en orden ascendente
sort($archivos);

// Verifica si se proporciona una consulta de búsqueda
if (isset($_GET['buscar'])) {
    $consultaBusqueda = filter_input(INPUT_GET, 'buscar', FILTER_SANITIZE_SPECIAL_CHARS);

    // Filtra los archivos basados en la consulta de búsqueda
    $archivosFiltrados = array_filter($archivos, function ($archivo) use ($consultaBusqueda) {
        return strpos($archivo, $consultaBusqueda) !== false;
    });

    // Utiliza los archivos filtrados para mostrar
    $archivos = $archivosFiltrados;
}

// Verifica si se proporciona una fecha de búsqueda
if (isset($_GET['fecha'])) {
    $consultaFecha = filter_input(INPUT_GET, 'fecha', FILTER_SANITIZE_SPECIAL_CHARS);

    // Filtra los archivos basados en la fecha de búsqueda
    $archivosFiltrados = array_filter($archivos, function ($archivo) use ($consultaFecha) {
        // Extrae la fecha del nombre del archivo (asumiendo que el formato es Y-m-d_H-i-s)
        $partes = explode('_', $archivo);
        if (count($partes) > 1) {
            $fechaArchivo = $partes[0];
            return strpos($fechaArchivo, $consultaFecha) !== false;
        }
        return false;
    });

    // Utiliza los archivos filtrados para mostrar
    $archivos = $archivosFiltrados;
}

// Paginación
$archivosPorPagina = 20;
$totalArchivos = count($archivos);
$totalPaginas = ceil($totalArchivos / $archivosPorPagina);

// Obtener la página actual de la URL, si no existe, por defecto es 1
$paginaActual = filter_input(INPUT_GET, 'pagina', FILTER_VALIDATE_INT, ['options' => ['default' => 1, 'min_range' => 1]]);
if ($paginaActual > $totalPaginas) $paginaActual = $totalPaginas;

// Calcular el índice de inicio y fin para los archivos de la página actual
$indiceInicio = ($paginaActual - 1) * $archivosPorPagina;
$indiceFin = min($indiceInicio + $archivosPorPagina, $totalArchivos);

// Obtener los archivos para la página actual
$archivosPagina = array_slice($archivos, $indiceInicio, $archivosPorPagina);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mostrar Fotos Boleta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Mostrar Fotos Boleta</h1>

        <form action="" method="GET" class="mb-4">
            <div class="form-row">
                <div class="col-md-4">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar foto">
                </div>
                <div class="col-md-4">
                    <input type="date" name="fecha" class="form-control" placeholder="Buscar por fecha">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="card-body">
                <?php if (empty($archivosPagina)): ?>
                    <p>No se encontraron fotos.</p>
                <?php else: ?>
                    <div class="list-group">
                        <?php foreach ($archivosPagina as $archivo): ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <span><?php echo htmlspecialchars($archivo); ?></span>
                                <a href="<?php echo htmlspecialchars($rutaCarpeta . $archivo); ?>" download="<?php echo htmlspecialchars($archivo); ?>" class="btn btn-secondary btn-sm">Descargar</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Controles de paginación -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-4">
                <li class="page-item <?php if ($paginaActual <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?pagina=<?php echo $paginaActual - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?php if ($i == $paginaActual) echo 'active'; ?>">
                        <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php if ($paginaActual >= $totalPaginas) echo 'disabled'; ?>">
                    <a class="page-link" href="?pagina=<?php echo $paginaActual + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</body>
</html>
<?php include "footer.php"; ?>