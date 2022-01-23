<?php
session_start();
header('content-type: text/html; charset=utf-8');
if (!isset($_SESSION['lastName'])) {
    header("Location: deconnexion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pandore</title>

    <!-- CSS Sheets -->
	<link rel="stylesheet" href="css/general_style.css" />

    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/icons/favicon-16x16.png">
    <link rel="manifest" href="img/icons/site.webmanifest">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<style>

    @media (min-width: 1025px) {
  .h-custom {
    height: 170vh !important;
    margin-top: 0rem;
    margin-bottom: -20rem;
  }
}
.card-registration .select-input.form-control[readonly]:not([disabled]) {
  font-size: 1rem;
  line-height: 2.15;
  padding-left: .75em;
  padding-right: .75em;
}
.card-registration .select-arrow {
  top: 13px;
}

.gradient-custom-2 {
  /* fallback for old browsers */
  background: #a1c4fd;

  /* Chrome 10-25, Safari 5.1-6 */
  background: -webkit-linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1));

  /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  background: #ffff;
}

.bg-indigo {
  background-color: #ffff;
}
@media (min-width: 992px) {
  .card-registration-2 .bg-indigo {
    border-top-right-radius: 15px;
    border-bottom-right-radius: 15px;
  }
}
@media (max-width: 991px) {
  .card-registration-2 .bg-indigo {
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
  }
}
</style>

</head>

<body style="background-color: whitesmoke;">
<header>
        <nav class="navbar navbar-expand-lg" style="background-color: #5582C8">
            <div class="container-fluid">
                <a class="navbar-brand" href="home.php" style="color: #ffff">Pandore</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown" >
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #ffff">Home</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="home.php">Registered Companies</a></li>
                                <?php
                                if ($_SESSION['occupation'] == "employee") {
                                ?>
                                    <li><a class="dropdown-item" href="join_company.php">Join Company</a></li>
                                <?php
                                } else {
                                ?>
                                    <li><a class="dropdown-item" href="add_company.php">Add Company</a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php" style="color: #ffff">About Pandore</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #ffff">
                                    <?php echo "{$_SESSION['lastName']} {$_SESSION['firstName']}"; ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                                    <li><a class="dropdown-item" href="modify_profile.php">Edit Profile</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="deconnexion.php" style="color:red;">Sign Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
                               

    <div id="content" name="content">
        <div id="error_vld_msg">
            <?php if (isset($_GET['vld'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </symbol>
                    </svg>
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <?php echo $_GET['vld']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </symbol>
                    </svg>
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <?php echo $_GET['error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
        </div>


        <div class="container py-5 h-2" style="background-color: #101047">
    <div class="row d-flex justify-content-center align-items-center h-10">
      <div class="col-10">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-3">
            <div class="row g-0">
              <div class="col-lg-7">
                <div class="p-5">





                <h3 class="fw-normal mb-5" style="color: #101047    ">Add a Company</h3>             
        <form action="forms/form_add_company.php" method="post" id="list_companies" name="list_companies">
            <div class="form-group">
                <label for="siretNumber">SIRET Number</label>
                <input type="text" class="form-control form-control-lg" id="siretNumber" name="siretNumber" placeholder="N° SIRET" required minlength="14" maxlength="14">
            </div>
            <div class="form-group">
                <label for="companyName">Company Name</label>
                <input type="text" class="form-control form-control-lg" id="companyName" name="companyName" placeholder="Company Name" required>
            </div>
            <div class="form-group">
                <label for="companyName">Legal Status</label>
                <input type="text" class="form-control form-control-lg" id="legalStatus" name="legalStatus" placeholder="Legal Status" required>
                <datalist id="suggestions_legalStatus">
                    <option>EURL</option>
                    <option>Groupement foncier agricole</option>
                    <option>SA</option>
                    <option>SARL</option>
                    <option>SAS</option>
                    <option>SASU</option>
                    <option>Société coopérative agricole</option>
                </datalist>
            </div>
            <div class="form-group">
                <label for="codeAPE">APE/NAF Code</label>
                <input type="text" list="suggestions_NAF" class="form-control form-control-lg" id="codeAPE" name="codeAPE" placeholder="APE/NAF Code" required>
                <datalist id="suggestions_NAF">
                    <option value="0111Z">Culture de céréales (à l'exception du riz), de légumineuses et de graines oléagineuses
                    </option>
                    <option value="0112Z">Culture du riz
                    </option>
                    <option value="0113Z">Culture de légumes, de melons, de racines et de tubercules
                    </option>
                    <option value="0114Z">Culture de la canne à sucre
                    </option>
                    <option value="0115Z">Culture du tabac
                    </option>
                    <option value="0116Z">Culture de plantes à fibres
                    </option>
                    <option value="0119Z">Autres cultures non permanentes
                    </option>
                    <option value="0121Z">Culture de la vigne
                    </option>
                    <option value="0122Z">Culture de fruits tropicaux et subtropicaux
                    </option>
                    <option value="0123Z">Culture d'agrumes
                    </option>
                    <option value="0124Z">Culture de fruits à pépins et à noyau
                    </option>
                    <option value="0125Z">Culture d'autres fruits d'arbres ou d'arbustes et de fruits à coque
                    </option>
                    <option value="0126Z">Culture de fruits oléagineux
                    </option>
                    <option value="0127Z">Culture de plantes à boissons
                    </option>
                    <option value="0128Z">Culture de plantes à épices, aromatiques, médicinales et pharmaceutiques
                    </option>
                    <option value="0129Z">Autres cultures permanentes
                    </option>
                    <option value="0130Z">Reproduction de plantes
                    </option>
                    <option value="0141Z">Élevage de vaches laitières
                    </option>
                    <option value="0142Z">Élevage d'autres bovins et de buffles
                    </option>
                    <option value="0143Z">Élevage de chevaux et d'autres équidés
                    </option>
                    <option value="0144Z">Élevage de chameaux et d'autres camélidés
                    </option>
                    <option value="0145Z">Élevage d'ovins et de caprins
                    </option>
                    <option value="0146Z">Élevage de porcins
                    </option>
                    <option value="0147Z">Élevage de volailles
                    </option>
                    <option value="0149Z">Élevage d'autres animaux
                    </option>
                    <option value="0150Z">Culture et élevage associés
                    </option>
                    <option value="0161Z">Activités de soutien aux cultures
                    </option>
                    <option value="0162Z">Activités de soutien à la production animale
                    </option>
                    <option value="0163Z">Traitement primaire des récoltes
                    </option>
                    <option value="0164Z">Traitement des semences
                    </option>
                    <option value="0170Z">Chasse, piégeage et services annexes
                    </option>
                    <option value="0210Z">Sylviculture et autres activités forestières
                    </option>
                    <option value="0220Z">Exploitation forestière
                    </option>
                    <option value="0230Z">Récolte de produits forestiers non ligneux poussant à l'état sauvage
                    </option>
                    <option value="0240Z">Services de soutien à l'exploitation forestière
                    </option>
                    <option value="0311Z">Pêche en mer
                    </option>
                    <option value="0312Z">Pêche en eau douce
                    </option>
                    <option value="0321Z">Aquaculture en mer
                    </option>
                    <option value="0322Z">Aquaculture en eau douce
                    </option>
                    <option value="0510Z">Extraction de houille
                    </option>
                    <option value="0520Z">Extraction de lignite
                    </option>
                    <option value="0610Z">Extraction de pétrole brut
                    </option>
                    <option value="0620Z">Extraction de gaz naturel
                    </option>
                    <option value="0710Z">Extraction de minerais de fer
                    </option>
                    <option value="0721Z">Extraction de minerais d'uranium et de thorium
                    </option>
                    <option value="0729Z">Extraction d'autres minerais de métaux non ferreux
                    </option>
                    <option value="0811Z">Extraction de pierres ornementales et de construction, de calcaire industriel, de gypse, de craie et d'ardoise
                    </option>
                    <option value="0812Z">Exploitation de gravières et sablières, extraction d'argiles et de kaolin
                    </option>
                    <option value="0891Z">Extraction des minéraux chimiques et d'engrais minéraux
                    </option>
                    <option value="0892Z">Extraction de tourbe
                    </option>
                    <option value="0893Z">Production de sel
                    </option>
                    <option value="0899Z">Autres activités extractives n.c.a.
                    </option>
                    <option value="0910Z">Activités de soutien à l'extraction d'hydrocarbures
                    </option>
                    <option value="0990Z">Activités de soutien aux autres industries extractives
                    </option>
                    <option value="1011Z">Transformation et conservation de la viande de boucherie
                    </option>
                    <option value="1012Z">Transformation et conservation de la viande de volaille
                    </option>
                    <option value="1013A">Préparation industrielle de produits à base de viande
                    </option>
                    <option value="1013B">Charcuterie
                    </option>
                    <option value="1020Z">Transformation et conservation de poisson, de crustacés et de mollusques
                    </option>
                    <option value="1031Z">Transformation et conservation de pommes de terre
                    </option>
                    <option value="1032Z">Préparation de jus de fruits et légumes
                    </option>
                    <option value="1039A">Autre transformation et conservation de légumes
                    </option>
                    <option value="1039B">Transformation et conservation de fruits
                    </option>
                    <option value="1041B">Fabrication d'huiles et graisses raffinées
                    </option>
                    <option value="1042Z">Fabrication de margarine et graisses comestibles similaires
                    </option>
                    <option value="1051A">Fabrication de lait liquide et de produits frais
                    </option>
                    <option value="1051B">Fabrication de beurre
                    </option>
                    <option value="1051C">Fabrication de fromage
                    </option>
                    <option value="1051D">Fabrication d'autres produits laitiers
                    </option>
                    <option value="1052Z">Fabrication de glaces et sorbets
                    </option>
                    <option value="1061A">Meunerie
                    </option>
                    <option value="1061B">Autres activités du travail des grains
                    </option>
                    <option value="1062Z">Fabrication de produits amylacés
                    </option>
                    <option value="1071A">Fabrication industrielle de pain et de pâtisserie fraîche
                    </option>
                    <option value="1071B">Cuisson de produits de boulangerie
                    </option>
                    <option value="1071C">Boulangerie et boulangerie-pâtisserie
                    </option>
                    <option value="1071D">Pâtisserie
                    </option>
                    <option value="1072Z">Fabrication de biscuits, biscottes et pâtisseries de conservation
                    </option>
                    <option value="1073Z">Fabrication de pâtes alimentaires
                    </option>
                    <option value="1081Z">Fabrication de sucre
                    </option>
                    <option value="1082Z">Fabrication de cacao, chocolat et de produits de confiserie
                    </option>
                    <option value="1083Z">Transformation du thé et du café
                    </option>
                    <option value="1084Z">Fabrication de condiments et assaisonnements
                    </option>
                    <option value="1085Z">Fabrication de plats préparés
                    </option>
                    <option value="1086Z">Fabrication d'aliments homogénéisés et diététiques
                    </option>
                    <option value="1089Z">Fabrication d'autres produits alimentaires n.c.a.
                    </option>
                    <option value="1091Z">Fabrication d'aliments pour animaux de ferme
                    </option>
                    <option value="1092Z">Fabrication d'aliments pour animaux de compagnie
                    </option>
                    <option value="1101Z">Production de boissons alcooliques distillées
                    </option>
                    <option value="1102A">Fabrication de vins effervescents
                    </option>
                    <option value="1102B">Vinification
                    </option>
                    <option value="1103Z">Fabrication de cidre et de vins de fruits
                    </option>
                    <option value="1104Z">Production d'autres boissons fermentées non distillées
                    </option>
                    <option value="1105Z">Fabrication de bière
                    </option>
                    <option value="1106Z">Fabrication de malt
                    </option>
                    <option value="1107A">Industrie des eaux de table
                    </option>
                    <option value="1107B">Production de boissons rafraîchissantes
                    </option>
                    <option value="1200Z">Fabrication de produits à base de tabac
                    </option>
                    <option value="1310Z">Préparation de fibres textiles et filature
                    </option>
                    <option value="1320Z">Tissage
                    </option>
                    <option value="1330Z">Ennoblissement textile
                    </option>
                    <option value="1391Z">Fabrication d'étoffes à mailles
                    </option>
                    <option value="1392Z">Fabrication d'articles textiles, sauf habillement
                    </option>
                    <option value="1393Z">Fabrication de tapis et moquettes
                    </option>
                    <option value="1394Z">Fabrication de ficelles, cordes et filets
                    </option>
                    <option value="1395Z">Fabrication de non-tissés, sauf habillement
                    </option>
                    <option value="1396Z">Fabrication d'autres textiles techniques et industriels
                    </option>
                    <option value="1399Z">Fabrication d'autres textiles n.c.a.
                    </option>
                    <option value="1411Z">Fabrication de vêtements en cuir
                    </option>
                    <option value="1412Z">Fabrication de vêtements de travail
                    </option>
                    <option value="1413Z">Fabrication de vêtements de dessus
                    </option>
                    <option value="1414Z">Fabrication de vêtements de dessous
                    </option>
                    <option value="1419Z">Fabrication d'autres vêtements et accessoires
                    </option>
                    <option value="1420Z">Fabrication d'articles en fourrure
                    </option>
                    <option value="1431Z">Fabrication d'articles chaussants à mailles
                    </option>
                    <option value="1439Z">Fabrication d'autres articles à mailles
                    </option>
                    <option value="1511Z">Apprêt et tannage des cuirs ; préparation et teinture des fourrures
                    </option>
                    <option value="1512Z">Fabrication d'articles de voyage, de maroquinerie et de sellerie
                    </option>
                    <option value="1520Z">Fabrication de chaussures
                    </option>
                    <option value="1610A">Sciage et rabotage du bois, hors imprégnation
                    </option>
                    <option value="1610B">Imprégnation du bois
                    </option>
                    <option value="1621Z">Fabrication de placage et de panneaux de bois
                    </option>
                    <option value="1622Z">Fabrication de parquets assemblés
                    </option>
                    <option value="1623Z">Fabrication de charpentes et d'autres menuiseries
                    </option>
                    <option value="1624Z">Fabrication d'emballages en bois
                    </option>
                    <option value="1629Z">Fabrication d'objets divers en bois ; fabrication d'objets en liège, vannerie et sparterie
                    </option>
                    <option value="1711Z">Fabrication de pâte à papier
                    </option>
                    <option value="1712Z">Fabrication de papier et de carton
                    </option>
                    <option value="1721A">Fabrication de carton ondulé
                    </option>
                    <option value="1721B">Fabrication de cartonnages
                    </option>
                    <option value="1721C">Fabrication d'emballages en papier
                    </option>
                    <option value="1722Z">Fabrication d'articles en papier à usage sanitaire ou domestique
                    </option>
                    <option value="1723Z">Fabrication d'articles de papeterie
                    </option>
                    <option value="1724Z">Fabrication de papiers peints
                    </option>
                    <option value="1729Z">Fabrication d'autres articles en papier ou en carton
                    </option>
                    <option value="1811Z">Imprimerie de journaux
                    </option>
                    <option value="1812Z">Autre imprimerie (labeur)
                    </option>
                    <option value="1813Z">Activités de pré-presse
                    </option>
                    <option value="1814Z">Reliure et activités connexes
                    </option>
                    <option value="1820Z">Reproduction d'enregistrements
                    </option>
                    <option value="1910Z">Cokéfaction
                    </option>
                    <option value="1920Z">Raffinage du pétrole
                    </option>
                    <option value="2011Z">Fabrication de gaz industriels
                    </option>
                    <option value="2012Z">Fabrication de colorants et de pigments
                    </option>
                    <option value="2013A">Enrichissement et retraitement de matières nucléaires
                    </option>
                    <option value="2013B">Fabrication d'autres produits chimiques inorganiques de base n.c.a.
                    </option>
                    <option value="2014Z">Fabrication d'autres produits chimiques organiques de base
                    </option>
                    <option value="2015Z">Fabrication de produits azotés et d'engrais
                    </option>
                    <option value="2016Z">Fabrication de matières plastiques de base
                    </option>
                    <option value="2017Z">Fabrication de caoutchouc synthétique
                    </option>
                    <option value="2020Z">Fabrication de pesticides et d'autres produits agrochimiques
                    </option>
                    <option value="2030Z">Fabrication de peintures, vernis, encres et mastics
                    </option>
                    <option value="2041Z">Fabrication de savons, détergents et produits d'entretien
                    </option>
                    <option value="2042Z">Fabrication de parfums et de produits pour la toilette
                    </option>
                    <option value="2051Z">Fabrication de produits explosifs
                    </option>
                    <option value="2052Z">Fabrication de colles
                    </option>
                    <option value="2053Z">Fabrication d'huiles essentielles
                    </option>
                    <option value="2059Z">Fabrication d'autres produits chimiques n.c.a.
                    </option>
                    <option value="2060Z">Fabrication de fibres artificielles ou synthétiques
                    </option>
                    <option value="2110Z">Fabrication de produits pharmaceutiques de base
                    </option>
                    <option value="2120Z">Fabrication de préparations pharmaceutiques
                    </option>
                    <option value="2211Z">Fabrication et rechapage de pneumatiques
                    </option>
                    <option value="2219Z">Fabrication d'autres articles en caoutchouc
                    </option>
                    <option value="2221Z">Fabrication de plaques, feuilles, tubes et profilés en matières plastiques
                    </option>
                    <option value="2222Z">Fabrication d'emballages en matières plastiques
                    </option>
                    <option value="2223Z">Fabrication d'éléments en matières plastiques pour la construction
                    </option>
                    <option value="2229A">Fabrication de pièces techniques à base de matières plastiques
                    </option>
                    <option value="2229B">Fabrication de produits de consommation courante en matières plastiques
                    </option>
                    <option value="2311Z">Fabrication de verre plat
                    </option>
                    <option value="2312Z">Façonnage et transformation du verre plat
                    </option>
                    <option value="2313Z">Fabrication de verre creux
                    </option>
                    <option value="2314Z">Fabrication de fibres de verre
                    </option>
                    <option value="2319Z">Fabrication et façonnage d'autres articles en verre, y compris verre technique
                    </option>
                    <option value="2320Z">Fabrication de produits réfractaires
                    </option>
                    <option value="2331Z">Fabrication de carreaux en céramique
                    </option>
                    <option value="2332Z">Fabrication de briques, tuiles et produits de construction, en terre cuite
                    </option>
                    <option value="2341Z">Fabrication d'articles céramiques à usage domestique ou ornemental
                    </option>
                    <option value="2342Z">Fabrication d'appareils sanitaires en céramique
                    </option>
                    <option value="2343Z">Fabrication d'isolateurs et pièces isolantes en céramique
                    </option>
                    <option value="2344Z">Fabrication d'autres produits céramiques à usage technique
                    </option>
                    <option value="2349Z">Fabrication d'autres produits céramiques
                    </option>
                    <option value="2351Z">Fabrication de ciment
                    </option>
                    <option value="2352Z">Fabrication de chaux et plâtre
                    </option>
                    <option value="2361Z">Fabrication d'éléments en béton pour la construction
                    </option>
                    <option value="2362Z">Fabrication d'éléments en plâtre pour la construction
                    </option>
                    <option value="2363Z">Fabrication de béton prêt à l'emploi
                    </option>
                    <option value="2364Z">Fabrication de mortiers et bétons secs
                    </option>
                    <option value="2365Z">Fabrication d'ouvrages en fibre-ciment
                    </option>
                    <option value="2369Z">Fabrication d'autres ouvrages en béton, en ciment ou en plâtre
                    </option>
                    <option value="2370Z">Taille, façonnage et finissage de pierres
                    </option>
                    <option value="2391Z">Fabrication de produits abrasifs
                    </option>
                    <option value="2399Z">Fabrication d'autres produits minéraux non métalliques n.c.a.
                    </option>
                    <option value="2410Z">Sidérurgie
                    </option>
                    <option value="2420Z">Fabrication de tubes, tuyaux, profilés creux et accessoires correspondants en acier
                    </option>
                    <option value="2431Z">Etirage à froid de barres
                    </option>
                    <option value="2432Z">Laminage à froid de feuillards
                    </option>
                    <option value="2433Z">Profilage à froid par formage ou pliage
                    </option>
                    <option value="2434Z">Tréfilage à froid
                    </option>
                    <option value="2441Z">Production de métaux précieux
                    </option>
                    <option value="2442Z">Métallurgie de l'aluminium
                    </option>
                    <option value="2443Z">Métallurgie du plomb, du zinc ou de l'étain
                    </option>
                    <option value="2444Z">Métallurgie du cuivre
                    </option>
                    <option value="2445Z">Métallurgie des autres métaux non ferreux
                    </option>
                    <option value="2446Z">élaboration et transformation de matières nucléaires
                    </option>
                    <option value="2451Z">Fonderie de fonte
                    </option>
                    <option value="2452Z">Fonderie d'acier
                    </option>
                    <option value="2453Z">Fonderie de métaux légers
                    </option>
                    <option value="2454Z">Fonderie d'autres métaux non ferreux
                    </option>
                    <option value="2511Z">Fabrication de structures métalliques et de parties de structures
                    </option>
                    <option value="2512Z">Fabrication de portes et fenêtres en métal
                    </option>
                    <option value="2521Z">Fabrication de radiateurs et de chaudières pour le chauffage central
                    </option>
                    <option value="2529Z">Fabrication d'autres réservoirs, citernes et conteneurs métalliques
                    </option>
                    <option value="2530Z">Fabrication de générateurs de vapeur, à l'exception des chaudières pour le chauffage central
                    </option>
                    <option value="2540Z">Fabrication d'armes et de munitions
                    </option>
                    <option value="2550A">Forge, estampage, matriçage ; métallurgie des poudres
                    </option>
                    <option value="2550B">Découpage, emboutissage
                    </option>
                    <option value="2561Z">Traitement et revêtement des métaux
                    </option>
                    <option value="2562A">Décolletage
                    </option>
                    <option value="2562B">Mécanique industrielle
                    </option>
                    <option value="2571Z">Fabrication de coutellerie
                    </option>
                    <option value="2572Z">Fabrication de serrures et de ferrures
                    </option>
                    <option value="2573A">Fabrication de moules et modèles
                    </option>
                    <option value="2573B">Fabrication d'autres outillages
                    </option>
                    <option value="2591Z">Fabrication de fûts et emballages métalliques similaires
                    </option>
                    <option value="2592Z">Fabrication d'emballages métalliques légers
                    </option>
                    <option value="2593Z">Fabrication d'articles en fils métalliques, de chaînes et de ressorts
                    </option>
                    <option value="2594Z">Fabrication de vis et de boulons
                    </option>
                    <option value="2599A">Fabrication d'articles métalliques ménagers
                    </option>
                    <option value="2599B">Fabrication d'autres articles métalliques
                    </option>
                    <option value="2611Z">Fabrication de composants électroniques
                    </option>
                    <option value="2612Z">Fabrication de cartes électroniques assemblées
                    </option>
                    <option value="2620Z">Fabrication d'ordinateurs et d'équipements périphériques
                    </option>
                    <option value="2630Z">Fabrication d'équipements de communication
                    </option>
                    <option value="2640Z">Fabrication de produits électroniques grand public
                    </option>
                    <option value="2651A">Fabrication d'équipements d'aide à la navigation
                    </option>
                    <option value="2651B">Fabrication d'instrumentation scientifique et technique
                    </option>
                    <option value="2652Z">Horlogerie
                    </option>
                    <option value="2660Z">Fabrication d'équipements d'irradiation médicale, d'équipements électromédicaux et électrothérapeutiques
                    </option>
                    <option value="2670Z">Fabrication de matériels optique et photographique
                    </option>
                    <option value="2680Z">Fabrication de supports magnétiques et optiques
                    </option>
                    <option value="2711Z">Fabrication de moteurs, génératrices et transformateurs électriques
                    </option>
                    <option value="2712Z">Fabrication de matériel de distribution et de commande électrique
                    </option>
                    <option value="2720Z">Fabrication de piles et d'accumulateurs électriques
                    </option>
                    <option value="2731Z">Fabrication de câbles de fibres optiques
                    </option>
                    <option value="2732Z">Fabrication d'autres fils et câbles électroniques ou électriques
                    </option>
                    <option value="2733Z">Fabrication de matériel d'installation électrique
                    </option>
                    <option value="2740Z">Fabrication d'appareils d'éclairage électrique
                    </option>
                    <option value="2751Z">Fabrication d'appareils électroménagers
                    </option>
                    <option value="2752Z">Fabrication d'appareils ménagers non électriques
                    </option>
                    <option value="2790Z">Fabrication d'autres matériels électriques
                    </option>
                    <option value="2811Z">Fabrication de moteurs et turbines, à l'exception des moteurs d'avions et de véhicules
                    </option>
                    <option value="2812Z">Fabrication d'équipements hydrauliques et pneumatiques
                    </option>
                    <option value="2813Z">Fabrication d'autres pompes et compresseurs
                    </option>
                    <option value="2814Z">Fabrication d'autres articles de robinetterie
                    </option>
                    <option value="2815Z">Fabrication d'engrenages et d'organes mécaniques de transmission
                    </option>
                    <option value="2821Z">Fabrication de fours et brûleurs
                    </option>
                    <option value="2822Z">Fabrication de matériel de levage et de manutention
                    </option>
                    <option value="2823Z">Fabrication de machines et d'équipements de bureau (à l'exception des ordinateurs et équipements périphériques)
                    </option>
                    <option value="2824Z">Fabrication d'outillage portatif à moteur incorporé
                    </option>
                    <option value="2825Z">Fabrication d'équipements aérauliques et frigorifiques industriels
                    </option>
                    <option value="2829A">Fabrication d'équipements d'emballage, de conditionnement et de pesage
                    </option>
                    <option value="2829B">Fabrication d'autres machines d'usage général
                    </option>
                    <option value="2830Z">Fabrication de machines agricoles et forestières
                    </option>
                    <option value="2841Z">Fabrication de machines-outils pour le travail des métaux
                    </option>
                    <option value="2849Z">Fabrication d'autres machines-outils
                    </option>
                    <option value="2891Z">Fabrication de machines pour la métallurgie
                    </option>
                    <option value="2892Z">Fabrication de machines pour l'extraction ou la construction
                    </option>
                    <option value="2893Z">Fabrication de machines pour l'industrie agro-alimentaire
                    </option>
                    <option value="2894Z">Fabrication de machines pour les industries textiles
                    </option>
                    <option value="2895Z">Fabrication de machines pour les industries du papier et du carton
                    </option>
                    <option value="2896Z">Fabrication de machines pour le travail du caoutchouc ou des plastiques
                    </option>
                    <option value="2899A">Fabrication de machines d'imprimerie
                    </option>
                    <option value="2899B">Fabrication d'autres machines spécialisées
                    </option>
                    <option value="2910Z">Construction de véhicules automobiles
                    </option>
                    <option value="2920Z">Fabrication de carrosseries et remorques
                    </option>
                    <option value="2931Z">Fabrication d'équipements électriques et électroniques automobiles
                    </option>
                    <option value="2932Z">Fabrication d'autres équipements automobiles
                    </option>
                    <option value="3011Z">Construction de navires et de structures flottantes
                    </option>
                    <option value="3012Z">Construction de bateaux de plaisance
                    </option>
                    <option value="3020Z">Construction de locomotives et d'autre matériel ferroviaire roulant
                    </option>
                    <option value="3030Z">Construction aéronautique et spatiale
                    </option>
                    <option value="3040Z">Construction de véhicules militaires de combat
                    </option>
                    <option value="3091Z">Fabrication de motocycles
                    </option>
                    <option value="3092Z">Fabrication de bicyclettes et de véhicules pour invalides
                    </option>
                    <option value="3099Z">Fabrication d'autres équipements de transport n.c.a.
                    </option>
                    <option value="3101Z">Fabrication de meubles de bureau et de magasin
                    </option>
                    <option value="3102Z">Fabrication de meubles de cuisine
                    </option>
                    <option value="3103Z">Fabrication de matelas
                    </option>
                    <option value="3109A">Fabrication de sièges d'ameublement d'intérieur
                    </option>
                    <option value="3109B">Fabrication d'autres meubles et industries connexes de l'ameublement
                    </option>
                    <option value="3211Z">Frappe de monnaie
                    </option>
                    <option value="3212Z">Fabrication d'articles de joaillerie et bijouterie
                    </option>
                    <option value="3213Z">Fabrication d'articles de bijouterie fantaisie et articles similaires
                    </option>
                    <option value="3220Z">Fabrication d'instruments de musique
                    </option>
                    <option value="3230Z">Fabrication d'articles de sport
                    </option>
                    <option value="3240Z">Fabrication de jeux et jouets
                    </option>
                    <option value="3250A">Fabrication de matériel médico-chirurgical et dentaire
                    </option>
                    <option value="3250B">Fabrication de lunettes
                    </option>
                    <option value="3291Z">Fabrication d'articles de brosserie
                    </option>
                    <option value="3299Z">Autres activités manufacturières n.c.a.
                    </option>
                    <option value="3311Z">Réparation d'ouvrages en métaux
                    </option>
                    <option value="3312Z">Réparation de machines et équipements mécaniques
                    </option>
                    <option value="3313Z">Réparation de matériels électroniques et optiques
                    </option>
                    <option value="3314Z">Réparation d'équipements électriques
                    </option>
                    <option value="3315Z">Réparation et maintenance navale
                    </option>
                    <option value="3316Z">Réparation et maintenance d'aéronefs et d'engins spatiaux
                    </option>
                    <option value="3317Z">Réparation et maintenance d'autres équipements de transport
                    </option>
                    <option value="3319Z">Réparation d'autres équipements
                    </option>
                    <option value="3320A">Installation de structures métalliques, chaudronnées et de tuyauterie
                    </option>
                    <option value="3320B">Installation de machines et équipements mécaniques
                    </option>
                    <option value="3320C">Conception d'ensemble et assemblage sur site industriel d'équipements de contrôle des processus industriels
                    </option>
                    <option value="3320D">Installation d'équipements électriques, de matériels électroniques et optiques ou d'autres matériels
                    </option>
                    <option value="3511Z">Production d'électricité
                    </option>
                    <option value="3512Z">Transport d'électricité
                    </option>
                    <option value="3513Z">Distribution d'électricité
                    </option>
                    <option value="3514Z">Commerce d'électricité
                    </option>
                    <option value="3521Z">Production de combustibles gazeux
                    </option>
                    <option value="3522Z">Distribution de combustibles gazeux par conduites
                    </option>
                    <option value="3523Z">Commerce de combustibles gazeux par conduites
                    </option>
                    <option value="3530Z">Production et distribution de vapeur et d'air conditionné
                    </option>
                    <option value="3600Z">Captage, traitement et distribution d'eau
                    </option>
                    <option value="3700Z">Collecte et traitement des eaux usées
                    </option>
                    <option value="3811Z">Collecte des déchets non dangereux
                    </option>
                    <option value="3812Z">Collecte des déchets dangereux
                    </option>
                    <option value="3821Z">Traitement et élimination des déchets non dangereux
                    </option>
                    <option value="3822Z">Traitement et élimination des déchets dangereux
                    </option>
                    <option value="3831Z">Démantèlement d'épaves
                    </option>
                    <option value="3832Z">Récupération de déchets triés
                    </option>
                    <option value="3900Z">Dépollution et autres services de gestion des déchets
                    </option>
                    <option value="4110A">Promotion immobilière de logements
                    </option>
                    <option value="4110B">Promotion immobilière de bureaux
                    </option>
                    <option value="4110C">Promotion immobilière d'autres bâtiments
                    </option>
                    <option value="4110D">Supports juridiques de programmes
                    </option>
                    <option value="4120A">Construction de maisons individuelles
                    </option>
                    <option value="4120B">Construction d'autres bâtiments
                    </option>
                    <option value="4211Z">Construction de routes et autoroutes
                    </option>
                    <option value="4212Z">Construction de voies ferrées de surface et souterraines
                    </option>
                    <option value="4213A">Construction d'ouvrages d'art
                    </option>
                    <option value="4213B">Construction et entretien de tunnels
                    </option>
                    <option value="4221Z">Construction de réseaux pour fluides
                    </option>
                    <option value="4222Z">Construction de réseaux électriques et de télécommunications
                    </option>
                    <option value="4291Z">Construction d'ouvrages maritimes et fluviaux
                    </option>
                    <option value="4299Z">Construction d'autres ouvrages de génie civil n.c.a
                    </option>
                    <option value="4311Z">Travaux de démolition
                    </option>
                    <option value="4312A">Travaux de terrassement courants et travaux préparatoires
                    </option>
                    <option value="4312B">Travaux de terrassement spécialisés ou de grande masse
                    </option>
                    <option value="4313Z">Forages et sondages
                    </option>
                    <option value="4321A">Travaux d'installation électrique dans tous locaux
                    </option>
                    <option value="4321B">Travaux d'installation électrique sur la voie publique
                    </option>
                    <option value="4322A">Travaux d'installation d'eau et de gaz en tous locaux
                    </option>
                    <option value="4322B">Travaux d'installation d'équipements thermiques et de climatisation
                    </option>
                    <option value="4329A">Travaux d'isolation
                    </option>
                    <option value="4329B">Autres travaux d'installation n.c.a.
                    </option>
                    <option value="4331Z">Travaux de plâtrerie
                    </option>
                    <option value="4332A">Travaux de menuiserie bois et pvc
                    </option>
                    <option value="4332B">Travaux de menuiserie métallique et serrurerie
                    </option>
                    <option value="4332C">Agencement de lieux de vente
                    </option>
                    <option value="4333Z">Travaux de revêtement des sols et des murs
                    </option>
                    <option value="4334Z">Travaux de peinture et vitrerie
                    </option>
                    <option value="4339Z">Autres travaux de finition
                    </option>
                    <option value="4391A">Travaux de charpente
                    </option>
                    <option value="4391B">Travaux de couverture par éléments
                    </option>
                    <option value="4399A">Travaux d'étanchéification
                    </option>
                    <option value="4399B">Travaux de montage de structures métalliques
                    </option>
                    <option value="4399C">Travaux de maçonnerie générale et gros œuvre de bâtiment
                    </option>
                    <option value="4399D">Autres travaux spécialisés de construction
                    </option>
                    <option value="4399E">Location avec opérateur de matériel de construction
                    </option>
                    <option value="4511Z">Commerce de voitures et de véhicules automobiles légers
                    </option>
                    <option value="4519Z">Commerce d'autres véhicules automobiles
                    </option>
                    <option value="4520A">Entretien et réparation de véhicules automobiles légers
                    </option>
                    <option value="4520B">Entretien et réparation d'autres véhicules automobiles
                    </option>
                    <option value="4531Z">Commerce de gros d'équipements automobiles
                    </option>
                    <option value="4532Z">Commerce de détail d'équipements automobiles
                    </option>
                    <option value="4540Z">Commerce et réparation de motocycles
                    </option>
                    <option value="4611Z">Intermédiaires du commerce en matières premières agricoles, animaux vivants, matières premières textiles et
                    </option>
                    <option value="4612A">Centrales d'achat de carburant
                    </option>
                    <option value="4612B">Autres intermédiaires du commerce en combustibles, métaux, minéraux et produits chimiques
                    </option>
                    <option value="4613Z">Intermédiaires du commerce en bois et matériaux de construction
                    </option>
                    <option value="4614Z">Intermédiaires du commerce en machines, équipements industriels, navires et avions
                    </option>
                    <option value="4615Z">Intermédiaires du commerce en meubles, articles de ménage et quincaillerie
                    </option>
                    <option value="4616Z">Intermédiaires du commerce en textiles, habillement, fourrures, chaussures et articles en cuir
                    </option>
                    <option value="4617A">Centrales d'achat alimentaires
                    </option>
                    <option value="4617B">Autres intermédiaires du commerce en denrées, boissons et tabac
                    </option>
                    <option value="4618Z">Intermédiaires spécialisés dans le commerce d'autres produits spécifiques
                    </option>
                    <option value="4619A">Centrales d'achat non alimentaires
                    </option>
                    <option value="4619B">Autres intermédiaires du commerce en produits divers
                    </option>
                    <option value="4621Z">Commerce de gros de céréales, de tabac non manufacturé, de semences et d'aliments pour le bétail
                    </option>
                    <option value="4622Z">Commerce de gros de fleurs et plantes
                    </option>
                    <option value="4623Z">Commerce de gros d'animaux vivants
                    </option>
                    <option value="4624Z">Commerce de gros de cuirs et peaux
                    </option>
                    <option value="4631Z">Commerce de gros de fruits et légumes
                    </option>
                    <option value="4632A">Commerce de gros de viandes de boucherie
                    </option>
                    <option value="4632B">Commerce de gros de produits à base de viande
                    </option>
                    <option value="4632C">Commerce de gros de volailles et gibier
                    </option>
                    <option value="4633Z">Commerce de gros de produits laitiers, œufs, huiles et matières grasses comestibles
                    </option>
                    <option value="4634Z">Commerce de gros de boissons
                    </option>
                    <option value="4635Z">Commerce de gros de produits à base de tabac
                    </option>
                    <option value="4636Z">Commerce de gros de sucre, chocolat et confiserie
                    </option>
                    <option value="4637Z">Commerce de gros de café, thé, cacao et épices
                    </option>
                    <option value="4638A">Commerce de gros de poissons, crustacés et mollusques
                    </option>
                    <option value="4638B">Commerce de gros alimentaire spécialisé divers
                    </option>
                    <option value="4639A">Commerce de gros de produits surgelés
                    </option>
                    <option value="4639B">Commerce de gros alimentaire non spécialisé
                    </option>
                    <option value="4641Z">Commerce de gros de textiles
                    </option>
                    <option value="4642Z">Commerce de gros d'habillement et de chaussures
                    </option>
                    <option value="4643Z">Commerce de gros d'appareils électroménagers
                    </option>
                    <option value="4644Z">Commerce de gros de vaisselle, verrerie et produits d'entretien
                    </option>
                    <option value="4645Z">Commerce de gros de parfumerie et de produits de beauté
                    </option>
                    <option value="4646Z">Commerce de gros de produits pharmaceutiques
                    </option>
                    <option value="4647Z">Commerce de gros de meubles, de tapis et d'appareils d'éclairage
                    </option>
                    <option value="4648Z">Commerce de gros d'articles d'horlogerie et de bijouterie
                    </option>
                    <option value="4649Z">Commerce de gros d'autres biens domestiques
                    </option>
                    <option value="4651Z">Commerce de gros d'ordinateurs, d'équipements informatiques périphériques et de logiciels
                    </option>
                    <option value="4652Z">Commerce de gros de composants et d'équipements électroniques et de télécommunication
                    </option>
                    <option value="4661Z">Commerce de gros de matériel agricole
                    </option>
                    <option value="4662Z">Commerce de gros de machines-outils
                    </option>
                    <option value="4663Z">Commerce de gros de machines pour l'extraction, la construction et le génie civil
                    </option>
                    <option value="4664Z">Commerce de gros de machines pour l'industrie textile et l'habillement
                    </option>
                    <option value="4665Z">Commerce de gros de mobilier de bureau
                    </option>
                    <option value="4666Z">Commerce de gros d'autres machines et équipements de bureau
                    </option>
                    <option value="4669A">Commerce de gros de matériel électrique
                    </option>
                    <option value="4669B">Commerce de gros de fournitures et équipements industriels divers
                    </option>
                    <option value="4669C">Commerce de gros de fournitures et équipements divers pour le commerce et les services
                    </option>
                    <option value="4671Z">Commerce de gros de combustibles et de produits annexes
                    </option>
                    <option value="4672Z">Commerce de gros de minerais et métaux
                    </option>
                    <option value="4673A">Commerce de gros de bois et de matériaux de construction
                    </option>
                    <option value="4673B">Commerce de gros d'appareils sanitaires et de produits de décoration
                    </option>
                    <option value="4674A">Commerce de gros de quincaillerie
                    </option>
                    <option value="4674B">Commerce de gros de fournitures pour la plomberie et le chauffage
                    </option>
                    <option value="4675Z">Commerce de gros de produits chimiques
                    </option>
                    <option value="4676Z">Commerce de gros d'autres produits intermédiaires
                    </option>
                    <option value="4677Z">Commerce de gros de déchets et débris
                    </option>
                    <option value="4690Z">Commerce de gros non spécialisé
                    </option>
                    <option value="4711A">Commerce de détail de produits surgelés
                    </option>
                    <option value="4711B">Commerce d'alimentation générale
                    </option>
                    <option value="4711C">Supérettes
                    </option>
                    <option value="4711D">Supermarchés
                    </option>
                    <option value="4711E">Magasins multi-commerces
                    </option>
                    <option value="4711F">Hypermarchés
                    </option>
                    <option value="4719A">Grands magasins
                    </option>
                    <option value="4719B">Autres commerces de détail en magasin non spécialisé
                    </option>
                    <option value="4721Z">Commerce de détail de fruits et légumes en magasin spécialisé
                    </option>
                    <option value="4722Z">Commerce de détail de viandes et de produits à base de viande en magasin spécialisé
                    </option>
                    <option value="4723Z">Commerce de détail de poissons, crustacés et mollusques en magasin spécialisé
                    </option>
                    <option value="4724Z">Commerce de détail de pain, pâtisserie et confiserie en magasin spécialisé
                    </option>
                    <option value="4725Z">Commerce de détail de boissons en magasin spécialisé
                    </option>
                    <option value="4726Z">Commerce de détail de produits à base de tabac en magasin spécialisé
                    </option>
                    <option value="4729Z">Autres commerces de détail alimentaires en magasin spécialisé
                    </option>
                    <option value="4730Z">Commerce de détail de carburants en magasin spécialisé
                    </option>
                    <option value="4741Z">Commerce de détail d'ordinateurs, d'unités périphériques et de logiciels en magasin spécialisé
                    </option>
                    <option value="4742Z">Commerce de détail de matériels de télécommunication en magasin spécialisé
                    </option>
                    <option value="4743Z">Commerce de détail de matériels audio et vidéo en magasin spécialisé
                    </option>
                    <option value="4751Z">Commerce de détail de textiles en magasin spécialisé
                    </option>
                    <option value="4752A">Commerce de détail de quincaillerie, peintures et verres en petites surfaces (moins de 400 m²)
                    </option>
                    <option value="4752B">Commerce de détail de quincaillerie, peintures et verres en grandes surfaces (400 m² et plus)
                    </option>
                    <option value="4753Z">Commerce de détail de tapis, moquettes et revêtements de murs et de sols en magasin spécialisé
                    </option>
                    <option value="4754Z">Commerce de détail d'appareils électroménagers en magasin spécialisé
                    </option>
                    <option value="4759A">Commerce de détail de meubles
                    </option>
                    <option value="4759B">Commerce de détail d'autres équipements du foyer
                    </option>
                    <option value="4761Z">Commerce de détail de livres en magasin spécialisé
                    </option>
                    <option value="4762Z">Commerce de détail de journaux et papeterie en magasin spécialisé
                    </option>
                    <option value="4763Z">Commerce de détail d'enregistrements musicaux et vidéo en magasin spécialisé
                    </option>
                    <option value="4764Z">Commerce de détail d'articles de sport en magasin spécialisé
                    </option>
                    <option value="4765Z">Commerce de détail de jeux et jouets en magasin spécialisé
                    </option>
                    <option value="4771Z">Commerce de détail d'habillement en magasin spécialisé
                    </option>
                    <option value="4772A">Commerce de détail de la chaussure
                    </option>
                    <option value="4772B">Commerce de détail de maroquinerie et d'articles de voyage
                    </option>
                    <option value="4773Z">Commerce de détail de produits pharmaceutiques en magasin spécialisé
                    </option>
                    <option value="4774Z">Commerce de détail d'articles médicaux et orthopédiques en magasin spécialisé
                    </option>
                    <option value="4775Z">Commerce de détail de parfumerie et de produits de beauté en magasin spécialisé
                    </option>
                    <option value="4776Z">Commerce de détail de fleurs, plantes, graines, engrais, animaux de compagnie et aliments pour ces animaux
                    </option>
                    <option value="4777Z">Commerce de détail d'articles d'horlogerie et de bijouterie en magasin spécialisé
                    </option>
                    <option value="4778A">Commerces de détail d'optique
                    </option>
                    <option value="4778B">Commerces de détail de charbons et combustibles
                    </option>
                    <option value="4778C">Autres commerces de détail spécialisés divers
                    </option>
                    <option value="4779Z">Commerce de détail de biens d'occasion en magasin
                    </option>
                    <option value="4781Z">Commerce de détail alimentaire sur éventaires et marchés
                    </option>
                    <option value="4782Z">Commerce de détail de textiles, d'habillement et de chaussures sur éventaires et marchés
                    </option>
                    <option value="4789Z">Autres commerces de détail sur éventaires et marchés
                    </option>
                    <option value="4791A">Vente à distance sur catalogue général
                    </option>
                    <option value="4791B">Vente à distance sur catalogue spécialisé
                    </option>
                    <option value="4799A">Vente à domicile
                    </option>
                    <option value="4799B">Vente par automates et autres commerces de détail hors magasin, éventaires ou marchés n.c.a.
                    </option>
                    <option value="4910Z">Transport ferroviaire interurbain de voyageurs
                    </option>
                    <option value="4920Z">Transports ferroviaires de fret
                    </option>
                    <option value="4931Z">Transports urbains et suburbains de voyageurs
                    </option>
                    <option value="4932Z">Transports de voyageurs par taxis
                    </option>
                    <option value="4939A">Transports routiers réguliers de voyageurs
                    </option>
                    <option value="4939B">Autres transports routiers de voyageurs
                    </option>
                    <option value="4939C">Téléphériques et remontées mécaniques
                    </option>
                    <option value="4941A">Transports routiers de fret interurbains
                    </option>
                    <option value="4941B">Transports routiers de fret de proximité
                    </option>
                    <option value="4941C">Location de camions avec chauffeur
                    </option>
                    <option value="4942Z">Services de déménagement
                    </option>
                    <option value="4950Z">Transports par conduites
                    </option>
                    <option value="5010Z">Transports maritimes et côtiers de passagers
                    </option>
                    <option value="5020Z">Transports maritimes et côtiers de fret
                    </option>
                    <option value="5030Z">Transports fluviaux de passagers
                    </option>
                    <option value="5040Z">Transports fluviaux de fret
                    </option>
                    <option value="5110Z">Transports aériens de passagers
                    </option>
                    <option value="5121Z">Transports aériens de fret
                    </option>
                    <option value="5122Z">Transports spatiaux
                    </option>
                    <option value="5210A">Entreposage et stockage frigorifique
                    </option>
                    <option value="5210B">Entreposage et stockage non frigorifique
                    </option>
                    <option value="5221Z">Services auxiliaires des transports terrestres
                    </option>
                    <option value="5222Z">Services auxiliaires des transports par eau
                    </option>
                    <option value="5223Z">Services auxiliaires des transports aériens
                    </option>
                    <option value="5224A">Manutention portuaire
                    </option>
                    <option value="5224B">Manutention non portuaire
                    </option>
                    <option value="5229A">Messagerie, fret express
                    </option>
                    <option value="5229B">Affrètement et organisation des transports
                    </option>
                    <option value="5310Z">Activités de poste dans le cadre d'une obligation de service universel
                    </option>
                    <option value="5320Z">Autres activités de poste et de courrier
                    </option>
                    <option value="5510Z">Hôtels et hébergement similaire
                    </option>
                    <option value="5520Z">Hébergement touristique et autre hébergement de courte durée
                    </option>
                    <option value="5530Z">Terrains de camping et parcs pour caravanes ou véhicules de loisirs
                    </option>
                    <option value="5590Z">Autres hébergements
                    </option>
                    <option value="5610A">Restauration traditionnelle
                    </option>
                    <option value="5610B">Cafétérias et autres libres-services
                    </option>
                    <option value="5610C">Restauration de type rapide
                    </option>
                    <option value="5621Z">Services des traiteurs
                    </option>
                    <option value="5629A">Restauration collective sous contrat
                    </option>
                    <option value="5629B">Autres services de restauration n.c.a.
                    </option>
                    <option value="5630Z">Débits de boissons
                    </option>
                    <option value="5811Z">Édition de livres
                    </option>
                    <option value="5812Z">Édition de répertoires et de fichiers d'adresses
                    </option>
                    <option value="5813Z">Édition de journaux
                    </option>
                    <option value="5814Z">Édition de revues et périodiques
                    </option>
                    <option value="5819Z">Autres activités d'édition
                    </option>
                    <option value="5821Z">Édition de jeux électroniques
                    </option>
                    <option value="5829A">Édition de logiciels système et de réseau
                    </option>
                    <option value="5829B">Edition de logiciels outils de développement et de langages
                    </option>
                    <option value="5829C">Edition de logiciels applicatifs
                    </option>
                    <option value="5911A">Production de films et de programmes pour la télévision
                    </option>
                    <option value="5911B">Production de films institutionnels et publicitaires
                    </option>
                    <option value="5911C">Production de films pour le cinéma
                    </option>
                    <option value="5912Z">Post-production de films cinématographiques, de vidéo et de programmes de télévision
                    </option>
                    <option value="5913A">Distribution de films cinématographiques
                    </option>
                    <option value="5913B">Edition et distribution vidéo
                    </option>
                    <option value="5914Z">Projection de films cinématographiques
                    </option>
                    <option value="5920Z">Enregistrement sonore et édition musicale
                    </option>
                    <option value="6010Z">Édition et diffusion de programmes radio
                    </option>
                    <option value="6020A">Edition de chaînes généralistes
                    </option>
                    <option value="6020B">Edition de chaînes thématiques
                    </option>
                    <option value="6110Z">Télécommunications filaires
                    </option>
                    <option value="6120Z">Télécommunications sans fil
                    </option>
                    <option value="6130Z">Télécommunications par satellite
                    </option>
                    <option value="6190Z">Autres activités de télécommunication
                    </option>
                    <option value="6201Z">Programmation informatique
                    </option>
                    <option value="6202A">Conseil en systèmes et logiciels informatiques
                    </option>
                    <option value="6202B">Tierce maintenance de systèmes et d'applications informatiques
                    </option>
                    <option value="6203Z">Gestion d'installations informatiques
                    </option>
                    <option value="6209Z">Autres activités informatiques
                    </option>
                    <option value="6311Z">Traitement de données, hébergement et activités connexes
                    </option>
                    <option value="6312Z">Portails internet
                    </option>
                    <option value="6391Z">Activités des agences de presse
                    </option>
                    <option value="6399Z">Autres services d'information n.c.a.
                    </option>
                    <option value="6411Z">Activités de banque centrale
                    </option>
                    <option value="6419Z">Autres intermédiations monétaires
                    </option>
                    <option value="6420Z">Activités des sociétés holding
                    </option>
                    <option value="6430Z">Fonds de placement et entités financières similaires
                    </option>
                    <option value="6491Z">Crédit-bail
                    </option>
                    <option value="6492Z">Autre distribution de crédit
                    </option>
                    <option value="6499Z">Autres activités des services financiers, hors assurance et caisses de retraite, n.c.a.
                    </option>
                    <option value="6511Z">Assurance vie
                    </option>
                    <option value="6512Z">Autres assurances
                    </option>
                    <option value="6520Z">Réassurance
                    </option>
                    <option value="6530Z">Caisses de retraite
                    </option>
                    <option value="6611Z">Administration de marchés financiers
                    </option>
                    <option value="6612Z">Courtage de valeurs mobilières et de marchandises
                    </option>
                    <option value="6619A">Supports juridiques de gestion de patrimoine mobilier
                    </option>
                    <option value="6619B">Autres activités auxiliaires de services financiers, hors assurance et caisses de retraite, n.c.a.
                    </option>
                    <option value="6621Z">évaluation des risques et dommages
                    </option>
                    <option value="6622Z">Activités des agents et courtiers d'assurances
                    </option>
                    <option value="6629Z">Autres activités auxiliaires d'assurance et de caisses de retraite
                    </option>
                    <option value="6630Z">Gestion de fonds
                    </option>
                    <option value="6810Z">Activités des marchands de biens immobiliers
                    </option>
                    <option value="6820A">Location de logements
                    </option>
                    <option value="6820B">Location de terrains et d'autres biens immobiliers
                    </option>
                    <option value="6831Z">Agences immobilières
                    </option>
                    <option value="6832A">Administration d'immeubles et autres biens immobiliers
                    </option>
                    <option value="6832B">Supports juridiques de gestion de patrimoine immobilier
                    </option>
                    <option value="6910Z">Activités juridiques
                    </option>
                    <option value="6920Z">Activités comptables
                    </option>
                    <option value="7010Z">Activités des sièges sociaux
                    </option>
                    <option value="7021Z">Conseil en relations publiques et communication
                    </option>
                    <option value="7022Z">Conseil pour les affaires et autres conseils de gestion
                    </option>
                    <option value="7111Z">Activités d'architecture
                    </option>
                    <option value="7112A">Activité des géomètres
                    </option>
                    <option value="7112B">Ingénierie, études techniques
                    </option>
                    <option value="7120A">Contrôle technique automobile
                    </option>
                    <option value="7120B">Analyses, essais et inspections techniques
                    </option>
                    <option value="7211Z">Recherche-développement en biotechnologie
                    </option>
                    <option value="7219Z">Recherche-développement en autres sciences physiques et naturelles
                    </option>
                    <option value="7220Z">Recherche-développement en sciences humaines et sociales
                    </option>
                    <option value="7311Z">Activités des agences de publicité
                    </option>
                    <option value="7312Z">Régie publicitaire de médias
                    </option>
                    <option value="7320Z">études de marché et sondages
                    </option>
                    <option value="7410Z">Activités spécialisées de design
                    </option>
                    <option value="7420Z">Activités photographiques
                    </option>
                    <option value="7430Z">Traduction et interprétation
                    </option>
                    <option value="7490A">Activité des économistes de la construction
                    </option>
                    <option value="7490B">Activités spécialisées, scientifiques et techniques diverses
                    </option>
                    <option value="7500Z">Activités vétérinaires
                    </option>
                    <option value="7711A">Location de courte durée de voitures et de véhicules automobiles légers
                    </option>
                    <option value="7711B">Location de longue durée de voitures et de véhicules automobiles légers
                    </option>
                    <option value="7712Z">Location et location-bail de camions
                    </option>
                    <option value="7721Z">Location et location-bail d'articles de loisirs et de sport
                    </option>
                    <option value="7722Z">Location de vidéocassettes et disques vidéo
                    </option>
                    <option value="7729Z">Location et location-bail d'autres biens personnels et domestiques
                    </option>
                    <option value="7731Z">Location et location-bail de machines et équipements agricoles
                    </option>
                    <option value="7732Z">Location et location-bail de machines et équipements pour la construction
                    </option>
                    <option value="7733Z">Location et location-bail de machines de bureau et de matériel informatique
                    </option>
                    <option value="7734Z">Location et location-bail de matériels de transport par eau
                    </option>
                    <option value="7735Z">Location et location-bail de matériels de transport aérien
                    </option>
                    <option value="7739Z">Location et location-bail d'autres machines, équipements et biens matériels n.c.a.
                    </option>
                    <option value="7740Z">Location-bail de propriété intellectuelle et de produits similaires, à l'exception des œuvres soumises à copyright
                    </option>
                    <option value="7810Z">Activités des agences de placement de main-d'œuvre
                    </option>
                    <option value="7820Z">Activités des agences de travail temporaire
                    </option>
                    <option value="7830Z">Autre mise à disposition de ressources humaines
                    </option>
                    <option value="7911Z">Activités des agences de voyage
                    </option>
                    <option value="7912Z">Activités des voyagistes
                    </option>
                    <option value="7990Z">Autres services de réservation et activités connexes
                    </option>
                    <option value="8010Z">Activités de sécurité privée
                    </option>
                    <option value="8020Z">Activités liées aux systèmes de sécurité
                    </option>
                    <option value="8030Z">Activités d'enquête
                    </option>
                    <option value="8110Z">Activités combinées de soutien lié aux bâtiments
                    </option>
                    <option value="8121Z">Nettoyage courant des bâtiments
                    </option>
                    <option value="8122Z">Autres activités de nettoyage des bâtiments et nettoyage industriel
                    </option>
                    <option value="8129A">Désinfection, désinsectisation, dératisation
                    </option>
                    <option value="8129B">Autres activités de nettoyage n.c.a.
                    </option>
                    <option value="8130Z">Services d'aménagement paysager
                    </option>
                    <option value="8211Z">Services administratifs combinés de bureau
                    </option>
                    <option value="8219Z">Photocopie, préparation de documents et autres activités spécialisées de soutien de bureau
                    </option>
                    <option value="8220Z">Activités de centres d'appels
                    </option>
                    <option value="8230Z">Organisation de foires, salons professionnels et congrès
                    </option>
                    <option value="8291Z">Activités des agences de recouvrement de factures et des sociétés d'information financière sur la clientèle
                    </option>
                    <option value="8292Z">Activités de conditionnement
                    </option>
                    <option value="8299Z">Autres activités de soutien aux entreprises n.c.a.
                    </option>
                    <option value="8411Z">Administration publique générale
                    </option>
                    <option value="8412Z">Administration publique (tutelle) de la santé, de la formation, de la culture et des services sociaux, autre que sécurité sociale
                    </option>
                    <option value="8413Z">Administration publique (tutelle) des activités économiques
                    </option>
                    <option value="8421Z">Affaires étrangères
                    </option>
                    <option value="8422Z">Défense
                    </option>
                    <option value="8423Z">Justice
                    </option>
                    <option value="8424Z">Activités d'ordre public et de sécurité
                    </option>
                    <option value="8425Z">Services du feu et de secours
                    </option>
                    <option value="8430A">Activités générales de sécurité sociale
                    </option>
                    <option value="8430B">Gestion des retraites complémentaires
                    </option>
                    <option value="8430C">Distribution sociale de revenus
                    </option>
                    <option value="8510Z">Enseignement pré-primaire
                    </option>
                    <option value="8520Z">Enseignement primaire
                    </option>
                    <option value="8531Z">Enseignement secondaire général
                    </option>
                    <option value="8532Z">Enseignement secondaire technique ou professionnel
                    </option>
                    <option value="8541Z">Enseignement post-secondaire non supérieur
                    </option>
                    <option value="8542Z">Enseignement supérieur
                    </option>
                    <option value="8551Z">Enseignement de disciplines sportives et d'activités de loisirs
                    </option>
                    <option value="8552Z">Enseignement culturel
                    </option>
                    <option value="8553Z">Enseignement de la conduite
                    </option>
                    <option value="8559A">Formation continue d'adultes
                    </option>
                    <option value="8559B">Autres enseignements
                    </option>
                    <option value="8560Z">Activités de soutien à l'enseignement
                    </option>
                    <option value="8610Z">Activités hospitalières
                    </option>
                    <option value="8621Z">Activité des médecins généralistes
                    </option>
                    <option value="8622A">Activités de radiodiagnostic et de radiothérapie
                    </option>
                    <option value="8622B">Activités chirurgicales
                    </option>
                    <option value="8622C">Autres activités des médecins spécialistes
                    </option>
                    <option value="8623Z">Pratique dentaire
                    </option>
                    <option value="8690A">Ambulances
                    </option>
                    <option value="8690B">Laboratoires d'analyses médicales
                    </option>
                    <option value="8690C">Centres de collecte et banques d'organes
                    </option>
                    <option value="8690D">Activités des infirmiers et des sages-femmes
                    </option>
                    <option value="8690E">Activités des professionnels de la rééducation, de l'appareillage et des pédicures-podologues
                    </option>
                    <option value="8690F">Activités de santé humaine non classées ailleurs
                    </option>
                    <option value="8710A">Hébergement médicalisé pour personnes âgées
                    </option>
                    <option value="8710B">Hébergement médicalisé pour enfants handicapés
                    </option>
                    <option value="8710C">Hébergement médicalisé pour adultes handicapés et autre hébergement médicalisé
                    </option>
                    <option value="8720A">Hébergement social pour handicapés mentaux et malades mentaux
                    </option>
                    <option value="8720B">Hébergement social pour toxicomanes
                    </option>
                    <option value="8730A">Hébergement social pour personnes âgées
                    </option>
                    <option value="8730B">Hébergement social pour handicapés physiques
                    </option>
                    <option value="8790A">Hébergement social pour enfants en difficultés
                    </option>
                    <option value="8790B">Hébergement social pour adultes et familles en difficultés et autre hébergement social
                    </option>
                    <option value="8810A">Aide à domicile
                    </option>
                    <option value="8810B">Accueil ou accompagnement sans hébergement d'adultes handicapés ou de personnes âgées
                    </option>
                    <option value="8810C">Aide par le travail
                    </option>
                    <option value="8891A">Accueil de jeunes enfants
                    </option>
                    <option value="8891B">Accueil ou accompagnement sans hébergement d'enfants handicapés
                    </option>
                    <option value="8899A">Autre accueil ou accompagnement sans hébergement d'enfants et d'adolescents
                    </option>
                    <option value="8899B">Action sociale sans hébergement n.c.a.
                    </option>
                    <option value="9001Z">Arts du spectacle vivant
                    </option>
                    <option value="9002Z">Activités de soutien au spectacle vivant
                    </option>
                    <option value="9003A">Création artistique relevant des arts plastiques
                    </option>
                    <option value="9003B">Autre création artistique
                    </option>
                    <option value="9004Z">Gestion de salles de spectacles
                    </option>
                    <option value="9101Z">Gestion des bibliothèques et des archives
                    </option>
                    <option value="9102Z">Gestion des musées
                    </option>
                    <option value="9103Z">Gestion des sites et monuments historiques et des attractions touristiques similaires
                    </option>
                    <option value="9104Z">Gestion des jardins botaniques et zoologiques et des réserves naturelles
                    </option>
                    <option value="9200Z">Organisation de jeux de hasard et d'argent
                    </option>
                    <option value="9311Z">Gestion d'installations sportives
                    </option>
                    <option value="9312Z">Activités de clubs de sports
                    </option>
                    <option value="9313Z">Activités des centres de culture physique
                    </option>
                    <option value="9319Z">Autres activités liées au sport
                    </option>
                    <option value="9321Z">Activités des parcs d'attractions et parcs à thèmes
                    </option>
                    <option value="9329Z">Autres activités récréatives et de loisirs
                    </option>
                    <option value="9411Z">Activités des organisations patronales et consulaires
                    </option>
                    <option value="9412Z">Activités des organisations professionnelles
                    </option>
                    <option value="9420Z">Activités des syndicats de salariés
                    </option>
                    <option value="9491Z">Activités des organisations religieuses
                    </option>
                    <option value="9492Z">Activités des organisations politiques
                    </option>
                    <option value="9499Z">Autres organisations fonctionnant par adhésion volontaire
                    </option>
                    <option value="9511Z">Réparation d'ordinateurs et d'équipements périphériques
                    </option>
                    <option value="9512Z">Réparation d'équipements de communication
                    </option>
                    <option value="9521Z">Réparation de produits électroniques grand public
                    </option>
                    <option value="9522Z">Réparation d'appareils électroménagers et d'équipements pour la maison et le jardin
                    </option>
                    <option value="9523Z">Réparation de chaussures et d'articles en cuir
                    </option>
                    <option value="9524Z">Réparation de meubles et d'équipements du foyer
                    </option>
                    <option value="9525Z">Réparation d'articles d'horlogerie et de bijouterie
                    </option>
                    <option value="9529Z">Réparation d'autres biens personnels et domestiques
                    </option>
                    <option value="9601A">Blanchisserie-teinturerie de gros
                    </option>
                    <option value="9601B">Blanchisserie-teinturerie de détail
                    </option>
                    <option value="9602A">Coiffure
                    </option>
                    <option value="9602B">Soins de beauté
                    </option>
                    <option value="9603Z">Services funéraires
                    </option>
                    <option value="9604Z">Entretien corporel
                    </option>
                    <option value="9609Z">Autres services personnels n.c.a.
                    </option>
                    <option value="9700Z">Activités des ménages en tant qu'employeurs de personnel domestique
                    </option>
                    <option value="9810Z">Activités indifférenciées des ménages en tant que producteurs de biens pour usage propre
                    </option>
                    <option value="9820Z">Activités indifférenciées des ménages en tant que producteurs de services pour usage propre
                    </option>
                    <option value="9900Z">Activités des organisations et organismes extraterritoriaux</option>

                </datalist>
            </div>
            
            <br/>
            <button type="submit" class="btn btn-success btn-lg" style="background-color: #101047">Add Company</button>
        </form>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </section>

    <br />
   <footer class="text-center text-lg-start border border-white mt-sm-5 pt-4" style="background-color: #5582C8">
<!-- Grid container -->
<div class="container p-4">
  <!--Grid row-->
  <div class="row">
    <!--Grid column-->
    <div class="col-lg-2 col-md-5 mb-4 mb-lg-0">
      <h5 class="text-uppercase mb-4" style="color: #ffff">OUR COMPANY</h5>

      <ul class="list-unstyled mb-4">
        <li>
          <a href="index.php" class="text-white" style="color: #ffff">About Pandore</a>
        </li>
        <li>
          <a href="index.php" class="text-white" style="color: #ffff">About Us</a>
        </li>
        <li>
          <a href="index.php" class="text-white" style="color: #ffff">Reviews</a>
        </li>
      </ul>
    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
      <h5 class="text-uppercase mb-4" style="color: #ffff">Profile</h5>

      <ul class="list-unstyled">
        <li>
          <a href="profile.php" class="text-white">My profile</a>
        </li>
        <li>
          <a href="modify_profile.php" class="text-white">Edit my profile</a>
        </li>
      </ul>
    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
      <h5 class="text-uppercase mb-4" style="color: #ffff">Companies</h5>

      <ul class="list-unstyled">
        <li>
          <a href="#!" class="text-white">Join a company</a>
        </li>
        <li>
          <a href="#!" class="text-white">Registered companies</a>
        </li>
      </ul>
    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
      <h5 class="text-uppercase mb-4" style="color: #ffff">Sign up to our newsletter</h5>

      <div class="form-outline form-white mb-4">
        <input type="email" id="form5Example2" class="form-control" />
        <label class="form-label" for="form5Example2" style="color: #ffff">Email address</label>
      </div>

      <button type="submit" class="btn btn-outline-white btn-block" style="color: #ffff">Subscribe</button>
    </div>
    <!--Grid column-->
  </div>
  <!--Grid row-->
</div>
<!-- Grid container -->

<!-- Copyright -->
<div class="text-sm-center border-top border-white" style="color: #ffff">
Copyright &copy; <?php echo date("Y"); ?><br /><small>Pandore Productions</small>
</div>
<!-- Copyright -->
</footer> 
</body>

</html>