<?php
session_start();
header('content-type: text/html; charset=utf-8');
if (!isset($_SESSION['lastName'])) {
    header("Location: ../deconnexion.php");
    exit();
}

$siretNo = isset($_GET["siret"]) ? $_GET["siret"] : '';
$detteNette = isset($_POST["detteNette"]) ? $_POST["detteNette"] : -1;
$chiffreAffaire = isset($_POST["chiffreAffaire"]) ? $_POST["chiffreAffaire"] : -1;
$resultatNet = isset($_POST["resultatNet"]) ? $_POST["resultatNet"] : -1;
$fondsPropres = isset($_POST["fondsPropres"]) ? $_POST["fondsPropres"] : -1;
$bfr = isset($_POST["bfr"]) ? $_POST["bfr"] : -1;

$variationBFR = isset($_POST["variationBFR"]) ? $_POST["variationBFR"] : -1; // Si on a qu'une année, c'est useless

$fr = isset($_POST["fr"]) ? $_POST["fr"] : -1;
$ebe = isset($_POST["ebe"]) ? $_POST["ebe"] : -1;
$capitalSocial = isset($_POST["capitalSocial"]) ? $_POST["capitalSocial"] : -1;
$coutDette = isset($_POST["coutDette"]) ? $_POST["coutDette"] : -1;

$detteCT = isset($_POST["detteCT"]) ? $_POST["detteCT"] : -1; // En suspend
$detteLT = isset($_POST["detteLT"]) ? $_POST["detteLT"] : -1; // En suspend

$tresorerie = isset($_POST["tresorerie"]) ? $_POST["tresorerie"] : -1;
$caf = isset($_POST["caf"]) ? $_POST["caf"] : -1;
$bilanTotal = isset($_POST["bilanTotal"]) ? $_POST["bilanTotal"] : -1;

$ratioGearing = $detteNette / $fondsPropres;
$rentabiliteExploitation = $ebe / $chiffreAffaire;
$rentabiliteGlobale = $resultatNet / $chiffreAffaire;
$ratioEquity = $fondsPropres / $bilanTotal;
$ratioLevier = $detteNette / $ebe;
$icr = $ebe / $coutDette;

date_default_timezone_set('UTC');
$date = date('Y-m-d H:i:s', time());

// Partie API FLASK

// GET Method
// $response = json_decode(file_get_contents("http://localhost:5000/api"));
// var_dump($response->{"message"});
// echo $response->{"message"}[0] . ", " . $response->{"message"}[1];

$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, "pfe_pandore");

// POST Method
if ($db_found) {
    $sql = "SELECT * FROM company WHERE siret='$siretNo'";
    $result = mysqli_query($db_handle, $sql);

    if (mysqli_num_rows($result) == 0) {
        $error = "An error has been occurred. Try again...";
        header("Location: ../audit.php?error=$error");
        mysqli_close($db_handle);
        exit();
    } else {
        $data = mysqli_fetch_assoc($result);
        $formeJuridique = $data['legalStatus'];
        $effectif = $data['numberOfEmployees'];
        $codeNAF = $data['codeAPE'];
    }
} else {
    $error = "An error has been occurred. Try again...";
    header("Location: ../audit.php?error=$error");
    mysqli_close($db_handle);
    exit();
}

$url = "http://localhost:5000/api/prediction";
$data = [
    'formeJuridique' => $formeJuridique,
    'effectif' => $effectif,
    'codeNAF' => $codeNAF,
    'siretNo' => $siretNo,
    'detteNette' => $detteNette,
    'chiffreAffaire' => $chiffreAffaire,
    'resultatNet' => $resultatNet,
    'fondsPropres' => $fondsPropres,
    'bfr' => $bfr,
    'variationBFR' => $variationBFR,
    'fr' => $fr,
    'ebe' => $ebe,
    'capitalSocial' => $capitalSocial,
    'coutDette' => $coutDette,
    'detteCT' => $detteCT,
    'detteLT' => $detteLT,
    'tresorerie' => $tresorerie,
    'caf' => $caf,
    'bilanTotal' => $bilanTotal,
    'ratioGearing' => $ratioGearing,
    'rentabiliteExploitation' => $rentabiliteExploitation,
    'rentabiliteGlobale' => $rentabiliteGlobale,
    'ratioEquity' => $ratioEquity,
    'ratioLevier' => $ratioLevier,
    'icr' => $icr
];

function httpPost($url, $data)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

$response = json_decode(httpPost($url, $data));
var_dump($response);
$resultAudit = $response->{'result'};
echo "<h1>Class: " . $resultAudit . "</h1>";



// Partie MySQL

if ($db_found) {
    $sql = "INSERT INTO audit (dateRealization,userEmail,siret,detteNette,chiffreAffaire,resultatNet,fondsPropres,bfr,variationBFR,fr,ebe,capitalSocial,coutDette,detteCT,detteLT,tresorerie,caf,bilanTotal,ratioGearing,rentabiliteExploitation,rentabiliteGlobale,ratioEquity,ratioLevier,icr,resultAudit) VALUES('{$date}','{$_SESSION['email']}','{$siretNo}',{$detteNette},{$chiffreAffaire},{$resultatNet},{$fondsPropres},{$bfr},{$variationBFR},{$fr},{$ebe},{$capitalSocial},{$coutDette},{$detteCT},{$detteLT},{$tresorerie},{$caf},{$bilanTotal},{$ratioGearing},{$rentabiliteExploitation},{$rentabiliteGlobale},{$ratioEquity},{$ratioLevier}, {$icr},{$resultAudit})";
    $result = mysqli_query($db_handle, $sql);
    $affectedRows = mysqli_affected_rows($db_handle);

    if ($affectedRows >= 0) {
        $msg = "The audit has been performed!";
        $sql = "SELECT id FROM audit ORDER BY id DESC LIMIT 1";
        $id_new = mysqli_fetch_assoc(mysqli_query($db_handle, $sql))['id'];
        // header("Location: ../audit.php?siret=$siretNo&vld=$msg");
        header("Location: ../infos_audit.php?id=$id_new&vld=$msg");
    } else {
        $msg = "An error has occurred...";
        header("Location: ../audit.php?siret=$siretNo&error=$msg");
    }
} else {
    echo "<strong>Database not found</strong>";
}
mysqli_close($db_handle);
exit();