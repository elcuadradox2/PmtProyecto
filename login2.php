<?php
//Start session
session_start();

//Array to store validation errors
$errmsg_arr = array();

//Validation error flag
$errflag = false;

//Connect to mysql server
$link = mysqli_connect('localhost', 'root', '', 'tos');
if (!$link) {
    die('Failed to connect to server: ' . mysqli_connect_error());
}

//Function to sanitize values received from the form. Prevents SQL injection
function clean($link, $str) {
    $str = trim($str);
    if (function_exists('mysqli_real_escape_string')) {
        $str = mysqli_real_escape_string($link, $str);
    }
    return $str;
}

//Sanitize the POST values
$login = clean($link, $_POST['username']);
$password = clean($link, $_POST['pass']);

//Input Validations
if ($login == '') {
    $errmsg_arr[] = 'Username missing';
    $errflag = true;
}
if ($password == '') {
    $errmsg_arr[] = 'Password missing';
    $errflag = true;
}

//If there are input validations, redirect back to the login form
if ($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: index.php");
    exit();
}

//Create query (Using prepared statement to prevent SQL Injection)
$qry = "SELECT id, name, position, username FROM user WHERE username=? AND pass=?";
$stmt = mysqli_prepare($link, $qry);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'ss', $login, $password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    //Check whether the query was successful or not
    if (mysqli_stmt_num_rows($stmt) == 1) {
        //Login Successful
        mysqli_stmt_bind_result($stmt, $id, $name, $position, $username);
        mysqli_stmt_fetch($stmt);

        session_regenerate_id();
        $_SESSION['SESS_MEMBER_ID'] = $id;
        $_SESSION['SESS_FIRST_NAME'] = $name;
        $_SESSION['SESS_LAST_NAME'] = $position;
        $_SESSION['SESS_PRO_PIC'] = $username;
        mysqli_stmt_close($stmt);
        session_write_close();
        header("location: index.php");
        exit();
    } else {
        //Login failed
        header("location: login.php");
        exit();
    }
} else {
    die("Query failed");
}
?>
