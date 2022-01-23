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

    <!-- CSS Sheets -->
    <link rel="stylesheet" href="css/home.css" />
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
    <div>
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
    <div id="content" name="content">
        <?php if ($data['resultAudit'] == 1) { ?>
            <div class="jumbotronResult h-25 p-4 text-center bg-image" style="background-color: green;">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-white">
                        <h1 id="title" class="mb-3">Healthy Situation</h1>
                        <h4 class="mb-3"><small>To find out more about your audit, subscribe to the Premium Plus version below</small></h4>
                    </div>
                </div>
            </div>
        <?php } elseif ($data['resultAudit'] == 2) { ?>
            <div class="jumbotronResult h-25 p-4 text-center bg-image" style="background-color: orange;">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-white">
                        <h1 id="title" class="mb-3">Acceptable Situation</h1>
                        <h4 class="mb-3"><small>To find out more about your audit, subscribe to the Premium Plus version below</small></h4>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="jumbotronResult h-25 p-4 text-center bg-image" style="background-color: darkred;">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-white">
                        <h1 id="title" class="mb-3">Dangerous Situation</h1>
                        <h4 class="mb-3"><small>To find out more about your audit, subscribe to the Premium Plus version below</small></h4>
                    </div>
                </div>
            </div>
        <?php } ?>


<br>
        <div id="backtest">
           <table class="table">
                <thead style="color: #101047">
                    <tr>
                    <th scope="col">Categories</th>
                    <th scope="col">Appreciation</th>
                    <th scope="col">Comments</th>
        </tr>
        </thead>
        <tbody >
            <tr>
            <th scope="row" style="color: #101047">Ration de Gearing</th>
            <td><?php if ($data['ratioGearing'] < 1 && $data['ratioGearing'] >= 0) { ?>
                    <span style="color: green;">Good!</span>
                <?php } elseif ($data['ratioGearing'] >= 1 && $data['ratioGearing'] < 2) { ?>
                    <span style="color: orange;">Medium!</span> 
                <?php } else { ?>
                    <span style="color: darkred;">Issue!</span> 
                <?php } ?>
            </td>

            <td style="color: black"><<?php if ($data['ratioGearing'] >= 1 && $data['ratioGearing'] < 2) { ?> 
                Les fonds propres sont trop faibles par rapport à la dette.<br> Il est conseillé d'augmenter les fonds propres et d'augmenter le capital ou de stopper la remonté de dividendes.
                <?php } else { ?>
                    Il y a trop de dette par rapport au fond propre. Il est nécessaire d'augmenter le capital ou de renégocier sa dette.
                <?php } ?>
            </td>
            </tr>

            <tr>
            <th scope="row" style="color: #101047">Rentabilité d'Exploitation</th>
            <td><?php if ($data['rentabiliteExploitation'] >= 0.2) { ?>
                    <span style="color: green;">Good!</span>
                <?php } elseif ($data['rentabiliteExploitation'] >= 0 && $data['rentabiliteExploitation'] < 0.2) { ?>
                    <span style="color: orange;">Medium!</span> 
                <?php } else { ?>
                    <span style="color: darkred;">Issue!</span>
                <?php } ?>
            </td>

            <td style="color: black"><?php if ($data['rentabiliteExploitation'] >= 0 && $data['rentabiliteExploitation'] < 0.2) { ?>
            Les marges sont un peu faibles.<br> Il est conseillé de revoir le coût des matières premières et les coûts salariaux.
            <?php } else { ?>
            Non rentable. <br> Vous devez revoir les marges et le business model. <br> Il faut également revoir le coût des matières premières et les coûts salariaux.
            <?php } ?>
            </td>
            </tr>


            <tr>
            <th scope="row" style="color: #101047">Rentabilité Globale</th>
            <td><?php if ($data['rentabiliteGlobale'] > 0.1) { ?>
                    <span style="color: green;">Good!</span>
                <?php } elseif ($data['rentabiliteGlobale'] >= 0 && $data['rentabiliteGlobale'] <= 0.1) { ?>
                    <span style="color: orange;">Medium!</span> 
                <?php } else { ?>
                    <span style="color: darkred;">Issue!</span>
                <?php } ?>
                </td>

                <td style="color: black">
                <?php if ($data['rentabiliteGlobale'] >= 0 && $data['rentabiliteGlobale'] <= 0.1) { ?>
                Des coûts de financiers et exceptionnel trop important par rapport au chiffre d'affaires produit. <br> Il est conseillé d'augmenter la rentabilité d'exploitation et de reduire les frais financiers et exceptionnel.
                <?php } else { ?>
                 Non rentable. <br> Des coûts de financiers et exceptionnel trop important par rapport au chiffre d'affaires produit. <br> Il faut impérativement augmenter la rentabilité d'exploitation et reduire les frais financiers et exceptionnel.
                <?php } ?>
                </td>
                </tr>

                <tr>
                <th scope="row" style="color: #101047">Ratio Equity</th>
                <td>
                <?php if ($data['ratioEquity'] >= 0.45) { ?>
                    <span style="color: green;">Good!</span>
                <?php } elseif ($data['ratioEquity'] >= 0.3 && $data['ratioEquity'] < 0.45) { ?>
                    <span style="color: orange;">Medium!</span> 
                <?php } else { ?>
                    <span style="color: darkred;">Issue!</span> 
                <?php } ?>
                </td>
                <td style="color: black">
                <?php if ($data['ratioEquity'] >= 0.3 && $data['ratioEquity'] < 0.45) { ?>
                    Le fond propre est trop faible par rapport au bilan total. Il est conseillé d'augmenter les fonds propres --> augmentation de capital ou stopper la remonté de dividendes
                <?php } else { ?>
                    Le fond propre est trop faible par rapport au bilan total. Il faut impérativement augmenter les fonds propres --> augmentation de capital ou stopper la remonté de dividendes.
                <?php } ?>
                </td>
                </tr>
                

                <tr>
                <th scope="row" style="color: #101047">Ratio Levier</th>
                <td><?php if ($data['ratioLevier'] >= 0.1) { ?>
                    <span style="color: green;">Good!</span>
                <?php } elseif ($data['ratioLevier'] >= 0 && $data['ratioLevier'] < 0.1) { ?>
                    <span style="color: orange;">Medium!</span> 
                <?php } else { ?>
                    <span style="color: darkred;">Issue!</span> 
                <?php } ?>
                </td>
                <td style="color: black">
                
                <?php if ($data['ratioLevier'] >= 0 && $data['ratioLevier'] < 0.1) { ?>
                   La dette contracté a généré de la valeur, mais cela reste un peu juste.
                <?php } else { ?>
                La dette contracté ne génére de la valeur. C'est un mauvais investissement. Il faut repenser l'investissement pour rentabiliser la dette.
                <?php } ?>
                </td>
                </tr>

                <tr>
                <th scope="row" style="color: #101047">Trésorerie</th>
                <td>
                <?php if ($data['tresorerie'] > 0) { ?>
                    <span style="color: green;">Good!</span>
                <?php } elseif ($data['tresorerie'] > -1 && $data['tresorerie'] <= 0) { ?>
                    <span style="color: orange;">Medium!</span>
                <?php } else { ?>
                    <span style="color: darkred;">Issue!</span> 
                <?php } ?>
                </td>
                <td style="color: black" >
                <?php if ($data['tresorerie'] > -1 && $data['tresorerie'] <= 0) { ?>
                  La trésorerie est positive ou neutre, ce qui est convenable pour attaquer l'excercice suivant.
                <?php } else { ?>
                 La trésorerie est négative, ce qui n'est pas rassurant pour l'exercice suivant.
                <?php } ?>
                </td>
                </tr>

                </tbody>
                </thead>
                </table>
                </div>

                <br>
        <div class="wrapper">
            <a role="button" class="btn btn-dark" style="background-color: #101047" href="premium_plus.php?id=<?php echo $_GET['id']; ?>">Premium<sup>+</sup></a>
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