<?php
include "./connection.php";
session_start();
$logged = $_SESSION['loggedin'];
if ($logged != true) {
    header("Location:pages-login.php");
}


$idRole = $_SESSION['idRole'];
$solde = $_SESSION['solde'];
$name = $_SESSION['name'];
$prenom = $_SESSION['prenom'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/sebn_logo2.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="assets/img/sebn_logo2.png" alt="">
                <span class="d-none d-lg-block">SEBN,TN2</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->



        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 4 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Lorem Ipsum</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Atque rerum nesciunt</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>1 hr. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Sit rerum fuga</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>2 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Dicta reprehenderit</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a><!-- End Messages Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have 3 new messages
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Maria Hudson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Anna Nelson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>6 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>David Muldon</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>8 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Show all messages</a>
                        </li>

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/img/profile.jfif" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            <?php echo strtoupper(substr($name, 0, 1)) . "." . $prenom; ?>
                        </span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>
                                <?php echo $prenom . " " . $name; ?>
                            </h6>
                            <span>
                                <?php echo $idRole; ?>
                            </span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a id="signOutLink" class="dropdown-item d-flex align-items-center" href="">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                        <script>
                            document.getElementById('signOutLink').addEventListener('click', function (event) {
                                event.preventDefault(); // Prevent the default behavior of the link
                                var xhr = new XMLHttpRequest();
                                xhr.open('GET', 'pages-login.php', true);
                                xhr.onload = function () {
                                    if (xhr.status === 200) {
                                        // Optionally, you can perform additional actions on success
                                        alert('You have been signed out successfully.');
                                        // Redirect the user to another page, if needed
                                        window.location.href = 'pages-login.php';
                                    } else {
                                        // Handle errors
                                        alert('Error: ' + xhr.statusText);
                                    }
                                };
                                xhr.onerror = function () {
                                    // Handle network errors
                                    alert('Network Error');
                                };
                                xhr.send();

                            });
                        </script>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="index.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="form_conge.php">
                            <i class="bi bi-circle"></i><span>Formulaire de congé</span>
                        </a>
                    </li>
                    <li>
                        <a href="form_permission.php">
                            <i class="bi bi-circle"></i><span>Formulaire de permission de sortie</span>
                        </a>
                    </li>
                    <li>
                        <a href="form_horaire.php">
                            <i class="bi bi-circle"></i><span>Formulaire de changement de regime hoaraire</span>
                        </a>
                    </li>
                    <li>
                        <a href="form_badgeage.php">
                            <i class="bi bi-circle"></i><span>Formulaire de manque de badgeage</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Vos demandes</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="affi_conge.php">
                            <i class="bi bi-circle"></i><span>Demande de Congé</span>
                        </a>
                    </li>
                    <li>
                        <a href="affi_permission.php">
                            <i class="bi bi-circle"></i><span>Permission de sortie</span>
                        </a>
                    </li>
                    <li>
                        <a href="affi_horaire.php">
                            <i class="bi bi-circle"></i><span>Changement de regime horaire</span>
                        </a>
                    </li>
                    <li>
                        <a href="affi_badgeage.php">
                            <i class="bi bi-circle"></i><span>Manque de badgeage</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link " href="sup.php">
                    <i class="bi bi-archive"></i>
                    <span>Liste des demandes</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="assurance.php">
                    <i class="bi bi-shield-fill"></i>
                    <span>Assurance</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-heading">Pages</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="users-profile.html">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-contact.html">
                    <i class="bi bi-envelope"></i>
                    <span>Contact</span>
                </a>
            </li><!-- End Contact Page Nav -->




        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->


        <section class="section">
            <div class="row">
                <div class="col-lg-14">

                    <div class="card">
                        <div class="card-body">
                            <?php
                            $id = $_SESSION['id'];
                            //type de la demande
                            $type = 'conge';
                            $sql = "SELECT idConge, username, typeConge, dateSortie, dateReprise, statut FROM demandeconge WHERE destination = ?";
                            $stmt = $mysqli->prepare($sql);
                            $stmt->bind_param("s", $id);
                            $stmt->execute();
                            $res = $stmt->get_result();
                            $test = false;

                            if ($res->num_rows != 0) {
                                while ($row = $res->fetch_array()) {
                                    if ($row['statut'] != "approuvée" && $row['statut'] != "refusé") {
                                        $test = true;
                                    }
                                }
                                if ($test == true) {
                                    ?>
                                    <h3>Demande de congé</h3>
                                    <table class='table'>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Type de congé</th>
                                            <th>Date de sortie</th>
                                            <th>Date de reprise</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                        <?php
                                        $sql = "SELECT idConge, username, typeConge, dateSortie, dateReprise, statut FROM demandeconge WHERE destination = ?";
                                        $stmt = $mysqli->prepare($sql);
                                        $stmt->bind_param("s", $id);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        while ($row = $res->fetch_array()) {
                                            if ($row['statut'] != "approuvée" && $row['statut'] != "refusé") {


                                                $sql2 = "SELECT nom, prenom FROM userinfo WHERE id = ?";
                                                $stmt2 = $mysqli->prepare($sql2);
                                                $stmt2->bind_param("s", $row['username']);
                                                $stmt2->execute();
                                                $res2 = $stmt2->get_result();
                                                $row2 = $res2->fetch_array(); ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row2[0] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row2[1] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['typeConge'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['dateSortie'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['dateReprise'] ?>
                                                    </td>
                                                    <td id="status-<?php echo $row['idConge']; ?>">
                                                        <?php echo $row['statut'] ?>
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-primary accept_c"
                                                            data-id="<?php echo $row['idConge']; ?>"
                                                            data-idUser="<?php echo $row['username']; ?>">Approuver</button>
                                                        <button class="btn btn-danger refuse_c" data-id="<?php echo $row['idConge']; ?>"
                                                            data-idUser="<?php echo $row['username']; ?>">Refuser</button>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } ?>
                                    </table>
                                <?php }


                            } ?>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    document.querySelectorAll('.accept_c').forEach(function (button) {
                                        button.addEventListener('click', function () {

                                            var id = this.getAttribute('data-id');
                                            var idUser = this.getAttribute('data-idUser');
                                            var type = '<?php echo $type; ?>';
                                            submitForm(type, id, 'approuvée', idUser);
                                            location.reload();
                                        });
                                    });

                                    document.querySelectorAll('.refuse_c').forEach(function (button) {
                                        button.addEventListener('click', function () {
                                            var id = this.getAttribute('data-id');
                                            var idUser = this.getAttribute('data-idUser');
                                            var type = '<?php echo $type; ?>';
                                            submitForm(type, id, 'refusé', idUser);
                                            location.reload();
                                        });
                                    });

                                    function submitForm(type, id, val, idUser) {
                                        var xhr = new XMLHttpRequest();
                                        var url = "sup_update.php";
                                        var data = {
                                            type: type,
                                            id: id,
                                            val: val,
                                            idUser: idUser
                                        };
                                        var params = JSON.stringify(data);

                                        xhr.open("POST", url, true);
                                        xhr.setRequestHeader("Content-type", "application/json");
                                        xhr.onreadystatechange = function () {
                                            if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                                                console.log(xhr.responseText);
                                                // You can handle any response here, like updating the UI to reflect the approval or rejection
                                            }
                                        };
                                        xhr.send(params);
                                    }
                                });
                            </script>

                            <!--permission de sortie-->

                            <?php
                            //type de la demande
                            $type = 'permission de sortie';
                            $sql = "SELECT username, idPermission, regimeHoraire, du, au, statut  FROM permissionsortie WHERE destination = ?";
                            $stmt = $mysqli->prepare($sql);
                            $stmt->bind_param("s", $id);
                            $stmt->execute();
                            $res = $stmt->get_result();
                            $test = false;

                            if ($res->num_rows != 0) {
                                while ($row = $res->fetch_array()) {
                                    if ($row['statut'] != "approuvée" && $row['statut'] != "refusé") {
                                        $test = true;
                                    }
                                }
                                if ($test == true) {
                                    ?>
                                    <h3>Permission de sortie : </h3>
                                    <table class='table'>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Type de congé</th>
                                            <th>Date de sortie</th>
                                            <th>Date de reprise</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                        <?php
                                        $sql = "SELECT username, idPermission, regimeHoraire, du, au, statut  FROM permissionsortie WHERE destination = ?";
                                        $stmt = $mysqli->prepare($sql);
                                        $stmt->bind_param("s", $id);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        while ($row = $res->fetch_array()) {
                                            if ($row['statut'] != "approuvée" && $row['statut'] != "refusé") {
                                                $sql2 = "SELECT nom, prenom FROM userinfo WHERE id = ?";
                                                $stmt2 = $mysqli->prepare($sql2);
                                                $stmt2->bind_param("s", $row['username']);
                                                $stmt2->execute();
                                                $res2 = $stmt2->get_result();
                                                $row2 = $res2->fetch_array(); ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row2[0] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row2[1] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['regimeHoraire'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['du'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['au'] ?>
                                                    </td>
                                                    <td id="status-<?php echo $row['idPermission']; ?>">
                                                        <?php echo $row['statut'] ?>
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-primary accept_p"
                                                            data-id="<?php echo $row['idPermission']; ?>">Approuver</button>
                                                        <button class="btn btn-danger refuse_p"
                                                            data-id="<?php echo $row['idPermission']; ?>">Refuser</button>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } ?>
                                    </table>
                                <?php }
                            }


                            ?>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    document.querySelectorAll('.accept_p').forEach(function (button) {
                                        button.addEventListener('click', function () {

                                            var id = this.getAttribute('data-id');
                                            var idUser = this.getAttribute('data-idUser');
                                            var type = '<?php echo $type; ?>';
                                            submitForm(type, id, 'approuvée', idUser);
                                            location.reload();
                                        });
                                    });

                                    document.querySelectorAll('.refuse_p').forEach(function (button) {
                                        button.addEventListener('click', function () {
                                            var id = this.getAttribute('data-id');
                                            var idUser = this.getAttribute('data-idUser');
                                            var type = '<?php echo $type; ?>';
                                            submitForm(type, id, 'refusé', idUser);
                                            location.reload();
                                        });
                                    });

                                    function submitForm(type, id, val, idUser) {
                                        var xhr = new XMLHttpRequest();
                                        var url = "sup_update.php";
                                        var data = {
                                            type: type,
                                            id: id,
                                            val: val,
                                            idUser: idUser
                                        };
                                        var params = JSON.stringify(data);

                                        xhr.open("POST", url, true);
                                        xhr.setRequestHeader("Content-type", "application/json");
                                        xhr.onreadystatechange = function () {
                                            if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                                                console.log(xhr.responseText);
                                                // You can handle any response here, like updating the UI to reflect the approval or rejection
                                            }
                                        };
                                        xhr.send(params);
                                    }
                                });
                            </script>

                            <!--regime horaire-->

                            <?php
                            //type de la demande
                            $type = 'regime horaire';
                            $sql = "SELECT username, id ,date, time, statut FROM changerregimehoraire WHERE destination = ?";
                            $stmt = $mysqli->prepare($sql);
                            $stmt->bind_param("s", $id);
                            $stmt->execute();
                            $res = $stmt->get_result();
                            $test = false;

                            if ($res->num_rows != 0) {
                                while ($row = $res->fetch_array()) {
                                    if ($row['statut'] != "approuvée" && $row['statut'] != "refusé") {
                                        $test = true;
                                    }
                                }
                                if ($test == true) {
                                    ?>
                                    <h3>Changement de regime horaire : </h3>
                                    <table class='table'>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Date</th>
                                            <th>temps</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                        <?php
                                        $sql = "SELECT username, id ,date, time, statut FROM changerregimehoraire WHERE destination = ?";
                                        $stmt = $mysqli->prepare($sql);
                                        $stmt->bind_param("s", $id);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        while ($row = $res->fetch_array()) {
                                            if ($row['statut'] != "approuvée" && $row['statut'] != "refusé") {
                                                $sql2 = "SELECT nom, prenom FROM userinfo WHERE id = ?";
                                                $stmt2 = $mysqli->prepare($sql2);
                                                $stmt2->bind_param("s", $row['username']);
                                                $stmt2->execute();
                                                $res2 = $stmt2->get_result();
                                                $row2 = $res2->fetch_array(); ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row2[0] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row2[1] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['date'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['time'] ?>
                                                    </td>
                                                    <td id="status-<?php echo $row['id']; ?>">
                                                        <?php echo $row['statut'] ?>
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-primary accept_r"
                                                            data-id="<?php echo $row['id']; ?>">Approuver</button>
                                                        <button class="btn btn-danger refuse_r"
                                                            data-id="<?php echo $row['id']; ?>">Refuser</button>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } ?>
                                    </table>
                                <?php }
                            }


                            ?>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    document.querySelectorAll('.accept_r').forEach(function (button) {
                                        button.addEventListener('click', function () {

                                            var id = this.getAttribute('data-id');
                                            var idUser = this.getAttribute('data-idUser');
                                            var type = '<?php echo $type; ?>';
                                            submitForm(type, id, 'approuvée', idUser);
                                            location.reload();
                                        });
                                    });

                                    document.querySelectorAll('.refuse_r').forEach(function (button) {
                                        button.addEventListener('click', function () {
                                            var id = this.getAttribute('data-id');
                                            var idUser = this.getAttribute('data-idUser');
                                            var type = '<?php echo $type; ?>';
                                            submitForm(type, id, 'refusé', idUser);
                                            location.reload();
                                        });
                                    });

                                    function submitForm(type, id, val, idUser) {
                                        var xhr = new XMLHttpRequest();
                                        var url = "sup_update.php";
                                        var data = {
                                            type: type,
                                            id: id,
                                            val: val,
                                            idUser: idUser
                                        };
                                        var params = JSON.stringify(data);

                                        xhr.open("POST", url, true);
                                        xhr.setRequestHeader("Content-type", "application/json");
                                        xhr.onreadystatechange = function () {
                                            if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                                                console.log(xhr.responseText);
                                                // You can handle any response here, like updating the UI to reflect the approval or rejection
                                            }
                                        };
                                        xhr.send(params);
                                    }
                                });
                            </script>

                            <!--manque de badgeage-->

                            <?php
                            //type de la demande
                            $type = 'manque de badgeage';
                            $sql = "SELECT username, idBadgeage ,date, entree, sortie, statut FROM badgeage WHERE destination = ?";
                            $stmt = $mysqli->prepare($sql);
                            $stmt->bind_param("s", $id);
                            $stmt->execute();
                            $res = $stmt->get_result();
                            $test = false;

                            if ($res->num_rows != 0) {
                                while ($row = $res->fetch_array()) {
                                    if ($row['statut'] != "approuvée" && $row['statut'] != "refusé") {
                                        $test = true;
                                    }
                                }
                                if ($test == true) {
                                    ?>
                                    <h3>Manque de badgeage : </h3>
                                    <table class='table'>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Type de congé</th>
                                            <th>Date de sortie</th>
                                            <th>Date de reprise</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                        <?php
                                        $sql = "SELECT username, idBadgeage ,date, entree, sortie, statut FROM badgeage WHERE destination = ?";
                                        $stmt = $mysqli->prepare($sql);
                                        $stmt->bind_param("s", $id);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        while ($row = $res->fetch_array()) {
                                            if ($row['statut'] != "approuvée" && $row['statut'] != "refusé") {
                                                $sql2 = "SELECT nom, prenom FROM userinfo WHERE id = ?";
                                                $stmt2 = $mysqli->prepare($sql2);
                                                $stmt2->bind_param("s", $row['username']);
                                                $stmt2->execute();
                                                $res2 = $stmt2->get_result();
                                                $row2 = $res2->fetch_array(); ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row2[0] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row2[1] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['date'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['entree'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['sortie'] ?>
                                                    </td>
                                                    <td id="status-<?php echo $row['idBadgeage']; ?>">
                                                        <?php echo $row['statut'] ?>
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-primary accept_b"
                                                            data-id="<?php echo $row['idBadgeage']; ?>">Approuver</button>
                                                        <button class="btn btn-danger refuse_b"
                                                            data-id="<?php echo $row['idBadgeage']; ?>">Refuser</button>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } ?>
                                    </table>
                                <?php }
                            }


                            ?>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    document.querySelectorAll('.accept_b').forEach(function (button) {
                                        button.addEventListener('click', function () {

                                            var id = this.getAttribute('data-id');
                                            var idUser = this.getAttribute('data-idUser');
                                            var type = '<?php echo $type; ?>';
                                            submitForm(type, id, 'approuvée', idUser);
                                            location.reload();
                                        });
                                    });

                                    document.querySelectorAll('.refuse_b').forEach(function (button) {
                                        button.addEventListener('click', function () {
                                            var id = this.getAttribute('data-id');
                                            var idUser = this.getAttribute('data-idUser');
                                            var type = '<?php echo $type; ?>';
                                            submitForm(type, id, 'refusé', idUser);
                                            location.reload();
                                        });
                                    });

                                    function submitForm(type, id, val, idUser) {
                                        var xhr = new XMLHttpRequest();
                                        var url = "sup_update.php";
                                        var data = {
                                            type: type,
                                            id: id,
                                            val: val,
                                            idUser: idUser
                                        };
                                        var params = JSON.stringify(data);

                                        xhr.open("POST", url, true);
                                        xhr.setRequestHeader("Content-type", "application/json");
                                        xhr.onreadystatechange = function () {
                                            if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                                                console.log(xhr.responseText);
                                                // You can handle any response here, like updating the UI to reflect the approval or rejection
                                            }
                                        };
                                        xhr.send(params);
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>


            </div>
        </section>





    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>