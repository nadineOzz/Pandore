<?php
session_start();
header('content-type: text/html; charset=utf-8');
if (!isset($_SESSION['lastName'])) {
    header("Location: ../deconnexion.php");
    exit();
}

//Récupération des données venant de la page d'Inscription
$lastName = isset($_POST["lastName"]) ? strtoupper($_POST["lastName"]) : "";
$firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$phoneNumber = isset($_POST["phoneNumber"]) ? $_POST["phoneNumber"] : "";

$error = "";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, "pfe_pandore");

//Si le bouton "Envoyer" est cliqué
if (isset($_POST["btnModifyProfile"])) {
    if ($lastName == "" && $firstName == "" && $email == "" && $password == "" && $phoneNumber == "") {
        $error = "Please fill in at least one field...";
        mysqli_close($db_handle);
        header("Location: ../modify_profile.php?error=$error");
        exit();
    }
    if ($db_found) {
        if ($email != "") {
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($db_handle, $sql);

            if (mysqli_num_rows($result) != 0) {
                $error = "The email already exists...";
                header("Location: ../modify_profile.php?error=$error");
                exit();
            } else {
                $sql = "UPDATE users SET email='{$email}' WHERE email='{$_SESSION['email']}'";
                $result = mysqli_query($db_handle, $sql);
                $_SESSION['email'] = $email;
            }
        }
        if ($lastName != "") {
            $sql = "UPDATE users SET lastName='{$lastName}' WHERE email='{$_SESSION['email']}'";
            $result = mysqli_query($db_handle, $sql);
            $_SESSION['lastName'] = $lastName;
        }
        if ($firstName != "") {
            $sql = "UPDATE users SET firstName='{$firstName}' WHERE email='{$_SESSION['email']}'";
            $result = mysqli_query($db_handle, $sql);
            $_SESSION['firstName'] = $firstName;
        }
        if ($password != "") {
            $sql = "UPDATE users SET password='{$password}' WHERE email='{$_SESSION['email']}'";
            $result = mysqli_query($db_handle, $sql);
            $_SESSION['password'] = $password;
        }
        if ($phoneNumber != "") {
            $sql = "UPDATE users SET phoneNumber='{$phoneNumber}' WHERE email='{$_SESSION['email']}'";
            $result = mysqli_query($db_handle, $sql);
            $_SESSION['phoneNumber'] = $phoneNumber;
        }
    } else {
        echo "<strong>Database not found</strong>";
    }
}

mysqli_close($db_handle);
$msg = "Your profile has been updated...";
header("Location: ../profile.php?vld=$msg");
exit();
