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
  background: linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1))
}

.bg-indigo {
  background-color: #101047;
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


    <section class="h-100 h-custom gradient-custom-2">
    <div id="content" name="content">
        <?php if (isset($_GET['vld'])) { ?>
            <div class="alert alert-dismissible alert-success">
                <?php echo $_GET['vld']; ?>
            </div>
        <?php }
        if (isset($_GET['error'])) { ?>
            <div class="alert alert-dismissible alert-danger">
                <#?php echo $_GET['error']; ?>
            </div>
        <?php } ?>

  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="p-5">
        
                
                  <h3 class="fw-normal mb-5" style="color: #4835d4;">Audit Information</h3>

                  <form method="post" action="forms/form_audit.php?siret=<?php echo $_GET['siret']; ?>">
            <label for="detteNette" class="form-label">Net debt</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">k €</span>
                <input type="number" class="form-control" id="detteNette" name="detteNette" placeholder="Net debt" required>
            </div>
            <label for="chiffreAffaire" class="form-label">Turnover</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">k €</span>
                <input type="number" class="form-control" id="chiffreAffaire" name="chiffreAffaire" placeholder="Turnover" required>
            </div>
            <label for="resultatNet" class="form-label">Net Results</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">k €</span>
                <input type="number" class="form-control" id="resultatNet" name="resultatNet" placeholder="Net Results" required>
            </div>
            <label for="fondsPropres" class="form-label">Equity</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">k €</span>
                <input type="number" class="form-control" id="fondsPropres" name="fondsPropres" placeholder="Equity" required>
            </div>
            <label for="bfr" class="form-label">Working Capital</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">k €</span>
                <input type="number" class="form-control" id="bfr" name="bfr" placeholder="Working Capital" required>
            </div>
            <label for="variationBFR" class="form-label">Working Capital Variation</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">k €</span>
                <input type="number" class="form-control" id="variationBFR" name="variationBFR" placeholder="Working Capital Variation" required>
            </div>
            <label for="fr" class="form-label">Net Current Assets</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">k €</span>
                <input type="number" class="form-control" id="fr" name="fr" placeholder="Net Current Assets" required>
            </div>
        </form>
                </div>
              </div>


              <div class="col-lg-6 bg-indigo text-white">
                <div class="p-5">
                  <h3 class="fw-normal mb-5">Audit Information</h3>
                  <form method="post" action="forms/form_audit.php?siret=<?php echo $_GET['siret']; ?>">
                  <label for="ebe" class="form-label">Excédent Brut d'Exploitation (EBE)</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">k €</span>
                <input type="number" class="form-control" id="ebe" name="ebe" placeholder="Excédent Brut d'Exploitation" required>
            </div>
            <label for="capitalSocial" class="form-label">Capital Social</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">k €</span>
                <input type="number" class="form-control" id="capitalSocial" name="capitalSocial" placeholder="Capital Social" required>
            </div>

            <label for="coutDette" class="form-label">Coûts de la Dette</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">k €</span>
                <input type="number" class="form-control" id="coutDette" name="coutDette" placeholder="Coûts de la Dette" required>
            </div>
            <label for="detteCT" class="form-label">Dette à Court-Terme</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">k €</span>
                <input type="number" class="form-control" id="detteCT" name="detteCT" placeholder="Dette à Court-Terme" required>
            </div>
            <label for="detteLT" class="form-label">Dette à Long-Terme</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">k €</span>
                <input type="number" class="form-control" id="detteLT" name="detteLT" placeholder="Dette à Long-Terme" required>
            </div>

            <label for="tresorerie" class="form-label">Trésorerie</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">k €</span>
                <input type="number" class="form-control" id="tresorerie" name="tresorerie" placeholder="Trésorerie" required>
            </div>

            <label for="caf" class="form-label">Capacité d'Autofinancement (CAF)</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">k €</span>
                <input type="number" class="form-control" id="caf" name="caf" placeholder="Capacité d'Autofinancement" required>
            </div>

            <label for="bilanTotal" class="form-label">Bilan Total</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">k €</span>
                <input type="number" class="form-control" id="bilanTotal" name="bilanTotal" placeholder="Bilan Total" required>
            </div>
                      

                  <button type="submit" class="btn btn-light btn-lg" data-mdb-ripple-color="dark">Register</button>
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