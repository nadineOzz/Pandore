<?php
session_start();
header('content-type: text/html; charset=utf-8');
if (!isset($_SESSION['lastName'])) {
    header("Location: ../deconnexion.php");
    exit();
}

$siret = isset($_GET["siret"]) ? $_GET["siret"] : "";

$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, "pfe_pandore");

if ($db_found) {
    $sql = "INSERT INTO companyregistration VALUES('{$_SESSION['email']}', '$siret')";
    $result = mysqli_query($db_handle, $sql);
    $test = mysqli_affected_rows($db_handle);
    
    if($test >= 0) {
        $msg = "You have joined the company!";
        header("Location: ../home.php?vld=$msg");
    } else {
        $msg = "An error has occurred...";
        header("Location: ../home.php?error=$msg");
    }
} else {
    echo "<strong>Database not found</strong>";
}
mysqli_close($db_handle);
exit();