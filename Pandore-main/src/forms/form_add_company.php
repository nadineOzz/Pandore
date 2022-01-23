<?php
session_start();
header('content-type: text/html; charset=utf-8');
if (!isset($_SESSION['lastName'])) {
    header("Location: ../deconnexion.php");
    exit();
}

$siretNumber = isset($_POST["siretNumber"]) ? $_POST["siretNumber"] : "";
$companyName = isset($_POST["companyName"]) ? $_POST["companyName"] : "";
$legalStatus = isset($_POST["legalStatus"]) ? $_POST["legalStatus"] : "";
$codeAPE = isset($_POST["codeAPE"]) ? $_POST["codeAPE"] : "";
$numberOfEmployees = isset($_POST["numberOfEmployees"]) ? $_POST["numberOfEmployees"] : -1;

$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, "pfe_pandore");

if ($db_found) {
    $sql = "SELECT * FROM company WHERE siret = '$siretNumber'";
    $result = mysqli_query($db_handle, $sql);

    if (mysqli_num_rows($result) != 0) {
        $error = "The SIRET Number already exists...";
        header("Location: ../add_company.php?error=$error");
    } else {
        $sql = "INSERT INTO company VALUES('{$siretNumber}', '{$companyName}', '{$legalStatus}', '{$codeAPE}', '{$numberOfEmployees}', '{$_SESSION['email']}')";
        $result = mysqli_query($db_handle, $sql);
        $affectedRows = mysqli_affected_rows($db_handle);

        if ($affectedRows >= 0) {
            $msg = "You have added the company!";
            header("Location: ../home.php?vld=$msg");
        } else {
            $msg = "An error has occurred...";
            header("Location: ../add_company.php?error=$msg");
        }
    }
} else {
    echo "<strong>Database not found</strong>";
}
mysqli_close($db_handle);
exit();
