<?php
session_start();
header('content-type: text/html; charset=utf-8');

//Récupération des données venant de la page d'Inscription
$lastName = isset($_POST["lastName"]) ? strtoupper($_POST["lastName"]) : "";
$firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$phoneNumber = isset($_POST["phoneNumber"]) ? $_POST["phoneNumber"] : "";
$occupation = isset($_POST["occupation"]) ? $_POST["occupation"] : "";

$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, "pfe_pandore");

//Si le bouton "Envoyer" est cliqué
if (isset($_POST["btnInscription"])) {
    //Si la BDD existe
    if ($db_found) {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($db_handle, $sql);

        //Si l'Email est déjà dans la table users
        if (mysqli_num_rows($result) != 0) {
            $msg = "Your account already exists...";
            header("Location: ../inscription.php?error=$msg");
        } else {
            $sql = "INSERT INTO users(lastName, firstName, email, password, occupation, phoneNumber) VALUES('$lastName', '$firstName', '$email', '$password', '$occupation', '$phoneNumber')";
            $result = mysqli_query($db_handle, $sql);
            $msg = "Your account has been created. You can now login...";
            header("Location: ../connexion.php?vld=$msg");
        }
    } else {
        echo "<strong>Database not found</strong>";
    }
}

mysqli_close($db_handle);
exit();
