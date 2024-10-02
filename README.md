# Sistema de Gestión de Boletas 

## Descripción
Este sistema es una aplicación web diseñada para la gestión de diversos tipos de boletas, incluyendo actividades, operativos, multas administrativas, servicios sociales, entrevistas, peritajes vehiculares, y más. Permite a los usuarios subir fotos asociadas a cada tipo de reporte y descargar todas las fotos en un archivo ZIP.

## Características principales
- Registro de múltiples tipos de boletas y reportes
- Carga de fotos (hasta 10 por reporte)
- Almacenamiento organizado de fotos en carpetas específicas
- Descarga masiva de todas las fotos en formato ZIP
- Interfaz de usuario para búsqueda y visualización de fotos

## Estructura de carpetas
El sistema utiliza las siguientes carpetas y son necesarias para almacenar las fotos:
- files_bitacoraactividades
- files_bitacoraoperativos
- files_boletaadministrativas
- files_boletaagresiones
- files_boletaalcoholemia
- files_boletaavisopago
- files_boletacolisiones
- files_boletaconsignaciones
- files_boletaentrevista
- files_boletanotificaciones
- files_boletaperitajevehicular
- files_boletaperitajevehiculartransportes
- files_boletasremociones
- files_boletareporteinterno
- files_boletaserviciossociales

## Requisitos del sistema
- PHP 7.0 o superior
- MySQL
- Servidor web (por ejemplo, Apache), se puede utilizar un servicio como wampp o xampp que ya incluye todo para pruebas locales
- Extensión ZipArchive de PHP habilitada

## Instalación
1. Clone el repositorio en su servidor web
2. Configure la conexión a la base de datos en `configbd.php`, `connect.php` y `login2.php`
3. Asegúrese de que las carpetas mencionadas anteriormente tengan permisos de escritura
4. Acceda a la aplicación a través de su navegador web

## Uso
- Para subir fotos, utilice los formularios específicos para cada tipo de boleta o reporte
- Para descargar todas las fotos, use la función "Descargar todas las fotos" en el panel de control

## Seguridad
- El sistema incluye autenticación de usuarios
- Se limita el tamaño y tipo de archivos que se pueden subir
- Se generan nombres de archivo únicos para evitar conflictos

## Mantenimiento
- Revise regularmente el espacio en disco disponible
- Realice copias de seguridad periódicas de la base de datos y las carpetas de fotos

