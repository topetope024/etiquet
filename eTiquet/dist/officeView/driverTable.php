<?php
session_start();
if(!isset($_SESSION['user'])){
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    header("location: ../login.php");

}
if(strpos($_SESSION['user'], 'E01') !== false){
    header("location: ../driverView/index.php");
}
elseif(strpos($_SESSION['user'], 'O01') !== false){
    header("location: ../officerView/index.php");
}
include '../db_connection.php';

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
        <title>eTiquet - Drivers' List</title>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
       
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">eTiquet</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
           <!-- Navbar Search-->
           <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                     
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                      
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../logout.php">Logout</a>
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
                                Violation Records
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php
                        echo $_SESSION['user'];
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Drivers' List</h1>
                       
                        <form method ="POST" action = "#">
                            <!--start table-->
                            <div class="container-fluid table-responsive" style="background-color: rgb(235, 235, 235);">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">License Number</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">License Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "select tbl_documents.licenseNumber,tbl_documents.status,tbl_drivers.lastName,tbl_drivers.firstName,tbl_drivers.middleName,tbl_drivers.address from tbl_drivers INNER JOIN tbl_documents ON tbl_drivers.licenseNumber = tbl_documents.licenseNumber";
                                        $result = mysqli_query($conn,$sql);
                                        $rows = array();
                                        $ctr = 0;
                                        while($r = mysqli_fetch_assoc($result)){
                                            $rows[] = $r;
                                        
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $rows[$ctr]["licenseNumber"];?></th>
                                            <td><?php echo $rows[$ctr]["lastName"] .", ". $rows[$ctr]["firstName"].", ". $rows[$ctr]["middleName"];?></td>
                                            <td><?php echo $rows[$ctr]["address"];?></td>
                                            <td><?php echo $rows[$ctr]["status"];?></td>
                                            <td>
                                            <div class="btn-group">
                                                <button type="button" class='btn btn-primary'  data-toggle='dropdown'><i class="fas fa-bars"></i></button>
                                                <div class='dropdown-menu'>
                                                    <button id='viewDriver' value='' type='button' onClick='' class='btn btn-primary w-100'>View<i class='icon-eye float-left'></i></button><br>
                                                    <button id='viewDriver' value='' type='button' onClick='' class='btn btn-success w-100'>Edit<i class='icon-eye float-left'></i></button><br>
                                                    <button id='viewDriver' value='' type='button' onClick='' class='btn btn-danger w-100'>Violations<i class='icon-eye float-left'></i></button><br>
                                            </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $ctr++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!--end table-->
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
        <script src="../js/scripts.js"></script>
        
    </body>
</html>
