<?php
/* Database config */
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') ?: '';
$db_database = getenv('DB_NAME') ?: 'tos'; 

/* End config */

$db = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

class App {   
    public static function message($type, $message, $code = ''){
        $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
        $code = htmlspecialchars($code, ENT_QUOTES, 'UTF-8');
        // Rest of the code...
    }
}

function get($val){
    if (isset($_GET[$val])) {
        return htmlspecialchars($_GET[$val], ENT_QUOTES, 'UTF-8');
    }
    return null;
}
?>