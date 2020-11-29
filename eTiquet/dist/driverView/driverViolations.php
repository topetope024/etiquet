<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Driver Interface</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">Start Bootstrap</a>
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

                        <a class="nav-link" href="driverDocuments.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            DOCUMENTS
                        </a>

                        <a class="nav-link" href="driverViolations.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            VIOLATIONS
                        </a>

                        <a class="nav-link" href="driverLTOinfo.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            LTO INFORMATION
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


                    <?php
                        
                    include '../db_connection.php';
                    $conn = OpenCon();
                        
                    
                    
                    $licenseNumber = "DR-0001";//user entered license number
                    
                    
                    $driverviolationsTable = array();
                    $sql = "SELECT violationNumber,plateNumber,fileNumber,makeAndType,engineNumber,chassisNumber,registeredOwner,registeredOwnerAddress,(SELECT description FROM violationlist where violationID = violationID) AS violationDescription, (SELECT offenseLevel FROM violationlist where violationID = violationID) AS LevelOffense,(SELECT fine FROM violationlist where violationID = violationID) AS violationFine,apprehensionPlace,issuedDate,dueDate,(SELECT lastName FROM officers where officerNumber = officerNumber) AS officerLastname,(SELECT firstName FROM officers where officerNumber = officerNumber) AS officerFirstName,(SELECT middleName FROM officers where officerNumber = officerNumber) AS officerMiddleName,(SELECT contactNumber FROM officers where officerNumber = officerNumber) AS officerContactNumber, confiscatedItem, driverSignature, note, status FROM driverviolations where licenseNumber = '$licenseNumber'";
                    $result = mysqli_query($conn,$sql) or die(mysql_error());
            
                        if($result){
    
                            while($row = mysqli_fetch_assoc($result)){
                                
                                //eu nani ang pasunod sunod na data na yaon sa violation ticket
                                echo $row['violationNumber']."<br>";
                                echo $row['plateNumber']."<br>";
                                echo $row['fileNumber']."<br>";
                                echo $row['makeAndType']."<br>";
                                echo $row['engineNumber']."<br>";
                                echo $row['chassisNumber']."<br>";
                                echo $row['registeredOwner']."<br>";
                                echo $row['registeredOwnerAddress']."<br>";
                                echo $row['violationDescription']."<br>";
                                echo $row['LevelOffense']."<br>";
                                echo $row['violationFine']."<br>";
                                echo $row['apprehensionPlace']."<br>";
                                echo $row['issuedDate']."<br>";
                                echo $row['dueDate']."<br>";
                                echo $row['officerLastname']."<br>";
                                echo $row['officerFirstName']."<br>";
                                echo $row['officerMiddleName']."<br>";
                                echo $row['officerContactNumber']."<br>";
                                echo $row['confiscatedItem']."<br>";
                                //echo $row['driverSignature']."<br>";
                                echo $row['note']."<br>";
                                echo $row['status']."<br>";
       
                            }
 
                        }
      
                    ?>



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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>



</body>

</html>