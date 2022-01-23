<?php
session_start();
header('content-type: text/html; charset=utf-8');
if (!isset($_SESSION['lastName'])) {
    header("Location: deconnexion.php");
    exit();
}

$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, "pfe_pandore");

if (!isset($_GET['id'])) {
    header("Location: home.php");
    exit();
}

if ($db_found) {
    $sql = "SELECT audit.*, c.companyName FROM `audit` JOIN company AS c ON audit.siret=c.siret WHERE id={$_GET['id']}";
    $result = mysqli_query($db_handle, $sql);
    if (mysqli_num_rows($result) == 0) {
        header("Location: home.php");
        exit();
    } else {
        $data = mysqli_fetch_assoc($result);
    }
} else {
    echo "<strong>Database not found</strong>";
}
mysqli_close($db_handle);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pandore</title>

      <!--CSS -->
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

        <div>
        <div class="list_av_companies p-4 m-4" style="border: solid 2px #101047;">
            <h2 style="color: #101047"><?php echo $data['companyName']. "'s"." ". "General Information"; ?></h2>
            <table class="table">
        <tbody>
            <tr>
            <th scope="row" style="color : #5582C8">N° SIRET:</th>
            <td> <?php echo $data['siret']; ?> </td>
        </tr>
        <tr>
        <th scope="row" style="color : #101047">AUDIT N°:</th>
            <td> <?php echo $data['id']; ?> </td>
        </tr>
        <tr>

            <th scope="row" style="color : #5582C8">PRODUCED BY:</th>
            <td> <?php echo $data['userEmail']; ?> </td>
        </tr>
        <tr>

            <th scope="row" style="color : #101047">COMPLETION DATE:</th>
            <td> <?php echo $data['dateRealization']; ?> </td>
        </tr>
        </tbody>
        </table>
    </div>
        

        <br />
        <details style="text-align:center;">
            <summary style="color: #101047"><strong>Audit Recap</strong></summary>
            <div id="tablesRecap" class="d-flex flex-row mx-5 my-2" style="color: #101047">
                <table class="table table-striped table-hover table-bordered" style="color: #101047" >
                    <thead>
                        <tr>
                            <th>Labels</th>
                            <th>Values (k €)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Dette Nette</strong></td>
                            <td><?php echo $data['detteNette']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Chiffre d'Affaires</strong></td>
                            <td><?php echo $data['chiffreAffaire']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Résultat Net</strong></td>
                            <td><?php echo $data['resultatNet']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Fonds Propres</strong></td>
                            <td><?php echo $data['fondsPropres']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>BFR</strong></td>
                            <td><?php echo $data['bfr']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Variation BFR</strong></td>
                            <td><?php echo $data['variationBFR']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>FR</strong></td>
                            <td><?php echo $data['fr']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>EBE</strong></td>
                            <td><?php echo $data['ebe']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Capital Social</strong></td>
                            <td><?php echo $data['capitalSocial']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Coûts de la Dette</strong></td>
                            <td><?php echo $data['coutDette']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Dette à Court-Terme</strong></td>
                            <td><?php echo $data['detteCT']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Dette à Long-Terme</strong></td>
                            <td><?php echo $data['detteLT']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Trésorerie</strong></td>
                            <td><?php echo $data['tresorerie']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>CAF</strong></td>
                            <td><?php echo $data['caf']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Bilan Total</strong></td>
                            <td><?php echo $data['bilanTotal']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Labels</th>
                            <th>Values</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="vertical-align: middle;"><strong>Ratio de Gearing</strong></td>
                            <td style="vertical-align: middle;"><?php echo $data['ratioGearing']; ?></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle;"><strong>Rentabilité d'Exploitation</strong></td>
                            <td style="vertical-align: middle;"><?php echo $data['rentabiliteExploitation']; ?></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle;"><strong>Rentabilité Globale</strong></td>
                            <td style="vertical-align: middle;"><?php echo $data['rentabiliteGlobale']; ?></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle;"><strong>Ratio Equity</strong></td>
                            <td style="vertical-align: middle;"><?php echo $data['ratioEquity']; ?></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle;"><strong>Ratio Levier</strong></td>
                            <td style="vertical-align: middle;"><?php echo $data['ratioLevier']; ?></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle;"><strong>ICR</strong></td>
                            <td style="vertical-align: middle;"><?php echo $data['icr']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </details>
        <hr />
        <?php if ($data['resultAudit'] == 1) { ?>
            <div class="jumbotronResult h-25 p-4 text-center bg-image" style="background-color: green;">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-white">
                        <h1 id="title" class="mb-3">Healthy Situation</h1>
                        <h4 class="mb-3"><small>To find out more about your audit, subscribe to the Premium or Premium Plus version below</small></h4>
                    </div>
                </div>
            </div>
        <?php } elseif ($data['resultAudit'] == 2) { ?>
            <div class="jumbotronResult h-25 p-4 text-center bg-image" style="background-color: orange;">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-white">
                        <h1 id="title" class="mb-3">Acceptable Situation</h1>
                        <h4 class="mb-3"><small>To find out more about your audit, subscribe to the Premium or Premium Plus version below</small></h4>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="jumbotronResult h-25 p-4 text-center bg-image" style="background-color: darkred;">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-white">
                        <h1 id="title" class="mb-3">Critique Situation</h1>
                        <h4 class="mb-3"><small>To find out more about your audit, subscribe to the Premium or Premium Plus version below</small></h4>
                    </div>
                </div>
            </div>
        <?php } ?>

        <br>
        <div class="wrapper">
            <a role="button"  class="btn btn-dark" style="background-color: #101047" href="premium.php?id=<?php echo $_GET['id']; ?>">Premium</a>
            <a role="button" class="btn btn-dark" style="background-color: #101047" href="premium_plus.php?id=<?php echo $_GET['id']; ?>">Premium<sup>+</sup></a>
        </div>

    </div>
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






<!-- <div>
            <div>
                <h2><?php echo $data['companyName']; ?></h2>
            </div>
            <div>N° SIRET: <?php echo $data['siret']; ?></div>
            <div>Audit N°: <?php echo $data['id']; ?></div>
            <div>Produced by: <?php echo $data['userEmail']; ?></div>
            <div>Completion Date: <?php echo $data['dateRealization']; ?></div>

            <hr />

            <div>Dette Nette: <?php echo $data['detteNette']; ?>k €</div>
            <div>Chiffre d'Affaires: <?php echo $data['chiffreAffaire']; ?>k €</div>
            <div>Résultat Net: <?php echo $data['resultatNet']; ?>k €</div>
            <div>Fonds Propres: <?php echo $data['fondsPropres']; ?>k €</div>
            <div>BFR: <?php echo $data['bfr']; ?></div>
            <div>Variation BFR: <?php echo $data['variationBFR']; ?>k €</div>
            <div>FR: <?php echo $data['fr']; ?>k €</div>
            <div>EBE: <?php echo $data['ebe']; ?>k €</div>
            <div>Capital Social: <?php echo $data['capitalSocial']; ?>k €</div>
            <div>Couts de la Dette: <?php echo $data['coutDette']; ?>k €</div>
            <div>Dette à Court-Terme: <?php echo $data['detteCT']; ?>k €</div>
            <div>Dette à Long-Terme: <?php echo $data['detteLT']; ?>k €</div>
            <div>Trésorerie: <?php echo $data['tresorerie']; ?>k €</div>
            <div>CAF: <?php echo $data['caf']; ?>k €</div>
            <div>Bilan Total: <?php echo $data['bilanTotal']; ?>k €</div>

            <hr />

            <div>Ratio de Gearing: <?php echo $data['ratioGearing']; ?></div>
            <div>Rentabilité d'Exploitation: <?php echo $data['rentabiliteExploitation']; ?></div>
            <div>Rentabilité Globale: <?php echo $data['rentabiliteGlobale']; ?></div>
            <div>Ratio Equity: <?php echo $data['ratioEquity']; ?></div>
            <div>Ratio Levier: <?php echo $data['ratioLevier']; ?></div>
            <div>ICR: <?php echo $data['icr']; ?></div>

            <hr />

            <div>Result: <?php echo $data['resultAudit']; ?></div>
        </div> -->