<?php
session_start();
header('content-type: text/html; charset=utf-8');

//Récupération des données venant de la page d'Inscription
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

$error = "";
//Identification de notre BDD
$database = "pfe_pandore";

//Connexion dans notre BDD
//Rappel : Votre serveur = localhost | votre login = root | votre MDP = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

//Si le bouton "Envoyer" est cliqué
if (isset($_POST["btnConnexion"])) {
    //Si la BDD existe
    if ($db_found) {
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($db_handle, $sql);

        //Si les données saisies sont incorrectes
        if (mysqli_num_rows($result) == 0) {
            $error = "The email or the password is incorrect. Try again...";
            header("Location: ../connexion.php?error=$error");
        } else {
            $data = mysqli_fetch_assoc($result);
            $_SESSION['lastName'] = $data['lastName'];
            $_SESSION['firstName'] = $data['firstName'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['password'] = $data['password'];
            $_SESSION['occupation'] = $data['occupation'];
            $_SESSION['phoneNumber'] = $data['phoneNumber'];

            header('Location: ../home.php');
        }
    } else {
        echo "<strong>Database not found</strong>";
    }
}
mysqli_close($db_handle);
exit();
