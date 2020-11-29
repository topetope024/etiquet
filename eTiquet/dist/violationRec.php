<?php
session_start();
if(!isset($_SESSION['user'])){
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    header("location: login.php");

}
include 'db_connection.php';

$conn = OpenCon();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>LTO - Drivers' List</title>
        <link href="css/styles.css" rel="stylesheet" />
       
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Start Bootstrap</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="applicationForm.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Application Form
                            </a>
                            <a class="nav-link" href="driverTable.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Drivers' List
                            </a>
                            <a class="nav-link" href="payQueue.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Payment Queue
                            </a>
                            <a class="nav-link" href="violationRec.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Violation Records Queue
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Drivers' List</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Drivers' List</li>
                        </ol>
                        <form method ="POST" action = "#">
                            <!--start table-->
                            <div class="container-fluid" style="background-color: rgb(235, 235, 235);">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Violation ID</th>
                                        <th scope="col">Plate Number</th>
                                        <th scope="col">License Number</th>
                                        <th scope="col">Registered Owner</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "select * from driverviolations where status = 1";
                                    $result = mysqli_query($conn,$sql);
                                    $rows = array();
                                    $ctr = 0;
                                    while($r = mysqli_fetch_assoc($result)){
                                        $rows[] = $r;
                                    
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $rows[$ctr]["violationID"];?></th>
                                        <td><?php echo $rows[$ctr]["plateNumber"] ;?></td>
                                        <td><?php echo $rows[$ctr]["licenseNumber"];?></td>
                                        <td><?php echo $rows[$ctr]["registeredOwner"];?></td>
                                        <td><button type="button" class='btn btn-primary w-100'>Actions<i class='icon-eye float-left' ></i></buttton></td>
                                    </tr>
                                    <?php
                                    $ctr++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </div>
                            <!--end table-->
                            
                            <div class="form-group mt-4 mb-0"> <input type="submit" class="btn btn-primary" name="submit"></div>
                        </form>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        
    </body>
</html>
