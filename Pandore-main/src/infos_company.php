<?php
session_start();
header('content-type: text/html; charset=utf-8');
if (!isset($_SESSION['lastName'])) {
    header("Location: deconnexion.php");
    exit();
}

$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, "pfe_pandore");

if (!isset($_GET['siret'])) {
    header("Location: home.php");
    exit();
}
if ($db_found) {
    $sql = "SELECT companyName, siret FROM company WHERE siret='{$_GET['siret']}'";
    $result = mysqli_query($db_handle, $sql);
    if (mysqli_num_rows($result) == 0) {
        header("Location: home.php");
        exit();
    } else {
        $companyName = mysqli_fetch_assoc($result)['companyName'];
    }
} else {
    echo "<strong>Database not found</strong>";
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

        <div class="jumbotron h-25 p-4 text-center bg-image" style="background-color: #101047">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-white">
                    <h1 class="mb-3"><?php echo $companyName; ?></h1>
                    <h4 class="mb-3"><small>Siret N° <?php echo $_GET['siret']; ?></small></h4>
                    <a class="btn btn-outline-light btn-lg" href="audit.php?siret=<?php echo $_GET['siret']; ?>" role="button" style="background-color: #5582C8">Create a new Audit</a>
                </div>
            </div>
        </div>
    </header>
    <br/>
    <div id="content" name="content">
        <?php if (isset($_GET['vld'])) { ?>
            <div class="alert alert-dismissible alert-success">
                <?php echo $_GET['vld']; ?>
            </div>
        <?php }
        if (isset($_GET['error'])) { ?>
            <div class="alert alert-dismissible alert-danger">
                <?php echo $_GET['error']; ?>
            </div>
        <?php } ?>

        <!-- <button class="btn btn-dark btn-lg" onClick="window.location.href='audit.php?siret=<?php echo $_GET['siret']; ?>'">Create a new Audit</button> -->
        <?php
        if ($db_found) {
            $sql = "SELECT audit.id, audit.dateRealization, audit.userEmail, audit.siret, c.companyName FROM audit JOIN company AS c ON audit.siret=c.siret WHERE audit.siret='{$_GET['siret']}'";
            $result = mysqli_query($db_handle, $sql);
            if (mysqli_num_rows($result) == 0) {
        ?>
                <h1 class="noAudit p-5 d-flex justify-content-center"><i>There is no audit here...</i></h1>
                <?php
            } else {
                while ($data = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="list_audits p-4 m-4" onClick="window.location.href='infos_audit.php?id=<?php echo $data['id']; ?>';">
                        <h5>Audit N°<?php echo $data['id']; ?></h5>
                        <div>Completion Date: <?php echo $data['dateRealization']; ?></div>
                        <div>Produced by: <?php echo $data['userEmail']; ?></div>
                    </div>
        <?php
                }
            }
        } else {
            echo "<strong>Database not found</strong>";
        }
        mysqli_close($db_handle);
        ?>
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