<?php
session_start();
if(!isset($_SESSION['user'])) {
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    header("location: ../login.php");
}
if(strpos($_SESSION['user'], 'E01') !== false){
    header("location: ../driverView/index.php");
}
elseif(strpos($_SESSION['user'], 'S01') !== false){
    header("location: ../officeView/index.php");
}

include ('../db_connection.php');

$conn = OpenCon();


if(isset($_GET['LN'])) {
    $LicenseNumber = $_GET['LN'];
    echo "<script>console.log(".$LicenseNumber.");</script>";
    $resultDoc = $conn->query("SELECT * FROM `tbl_documents` WHERE licenseNumber= '$LicenseNumber'")or die($conn->error);
    $resultDriver = $conn->query("SELECT * FROM `tbl_drivers` WHERE licenseNumber='$LicenseNumber'")or die($conn->error);
}else header("location: index.php");
if(mysqli_num_rows($resultDoc) == 1) $rowDoc = $resultDoc->fetch_array();
if(mysqli_num_rows($resultDriver) == 1) $rowDri = $resultDriver->fetch_array();


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Scanner</title>
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
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Scanner
                            </a>
                            <a class="nav-link" href="driverInfo.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Driver's Info
                            </a>
                            <a class="nav-link" href="record.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Records
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
                <div class="container-fluid" style="background-color: white;">
                    <h3><?php echo $rowDri['lastName'].'\'s';?> license Information</h3>
                    <div class ="form-row">  
                        <div class="container-fluid" style="background-color: rgb(235, 235, 235);">
                            <div class = "col-md-10">
                                <div class="form-group form-row">
                                    <div class="col-md-12">
                                        <label class="large"><b>License Type: </b><?php echo $rowDoc['licenseType']." Drivers License"; ?></label><br>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="large"><b>Name:</b> <?php echo ucfirst($rowDri['lastName']) .", ". ucfirst($rowDri['firstName']).", ". ucfirst($rowDri['middleName']) ; ?></label><br>
                                    </div>    
                                    <div class="col-md-2">
                                        <label class="large"><b>Nationality: </b><?php echo $rowDri['nationality']; ?></label><br>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="large"><b>Gender: </b><?php echo $rowDri['gender']; ?></label><br>
                                    </div> 
                                    <div class="col-md-3">
                                        <label class="large"><b>Date of Birth: </b><?php echo $rowDri['birthDate']; ?></label><br>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="large"><b>Weight: </b><?php echo $rowDri['weight']; ?>kg</label><br>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="large"><b>Height:</b> <?php echo $rowDri['height']; ?>cm</label><br>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="large"><b>Address: </b><?php echo $rowDri['address']; ?></label><br>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="large"><b>License No. : </b><?php echo $rowDri['licenseNumber']; ?></label><br>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="large"><b>Expiration Date:</b> <?php echo $rowDoc['licenseExpiration']; ?></label><br>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="large"><b>Blood Type:</b><?php echo $rowDri['bloodType']; ?></label><br>
                                    </div>
                                    <div class="col-md-2">     
                                        <label class="large"><b>Eyes Color: </b><?php echo $rowDri['eyesColor']; ?></label><br>
                                    </div>
                                    <div class="col-md-6">                  
                                        <label class="large"><b>Restrictions: </b><?php echo $rowDoc['restrictions']; ?></label><br>
                                    </div>
                                    <div class="col-md-6">  
                                        <label class="large"><b>Conditions:</b> <?php echo $rowDoc['driverCondition']; ?></label><br>
                                    </div>
                                    
                                </div>
                            </div>
                        </div><br><br><br> 
                        
                        <div class="container-fluid" style="background-color: rgb(235, 235, 235);">    
                            <div class = "col-md-12">
                                <div class="form-group">
                                    <table class="table" id="dataTable" width="100%" cellspacing="0"><br><br>
                                        <h3>Record of Violations</h3>
                                        <thead class="thead">
                                            <tr>
                                                <th scope="col">Violation ID</th>
                                                <th scope="col">Issued Date</th>
                                                <th scope="col">Status/Remarks</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "select * from tbl_driverviolation where licenseNumber = '$LicenseNumber';";
                                            $result = mysqli_query($conn,$sql);
                                            $rows = array();
                                            $ctr = 0;
                                            while($r = mysqli_fetch_assoc($result)){
                                                $rows[] = $r;
                                            
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $rows[$ctr]["violationNumber"];?></th>
                                                <td><?php echo $rows[$ctr]["issuedDate"];?></td>
                                                <td><?php echo $rows[$ctr]["remarks"];?></td>
                                                <td>
                                                <button id='viewDriver' value='' type='button' onClick='' class='btn btn-primary w-100'>View<i class='icon-eye float-left'></i></button><br>
                                                </td>
                                            </tr>
                                            <?php
                                            $ctr++;
                                            }
                                            ?>
                                        </tbody>
                                     </table>
                                    </div>
                                </div>                         
                            </div>   
                        </div> 
                        <!--buttons-->
                        <div class = "form-group">
                            <div class = "col-md-12">
                                <a href= "index.php"><button class="btn btn-success" type="button" >Done</button></a>
                               <!-- Large modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg">Add Violations</button>

                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form method = "post" action = "../SaveRecords/saveViolation.php" >
                                                <div class="container-fluid" style="background-color: rgb(235, 235, 235);"> 
                                                    <h3>Operator's Permit</h3>
                                                    <div class="container-fluid" style="background-color: white;">
                                                        <div class="form-row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="small mb-1" for=" "><b>Place of apprehension</b></label>
                                                                    <input  class="form-control  " id="txtP_Apprehension" name="txtP_Apprehension" type="text"  />
                                                                    <input  class="form-control  " id=" " name="txtlicense" type="text" hidden  value = <?php echo '\''.$LicenseNumber.'\'';  ?> />

                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="small mb-1" for=" "><b>Confiscated item/s</b></label>
                                                                    <input  class="form-control " id="txtC_items" name="txtC_items" type="text" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="small mb-1" for=" "><b>While driving motor vehicle described as follows:</b></label>      
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="small mb-1" for=" "><b>Plate number</b></label>
                                                                    <input  class="form-control " id="txtP_number" name="txtP_number" type="text" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="small mb-1" for=" "><b>File number</b></label>
                                                                    <input  class="form-control " id="txtF_number" name="txtF_number" type="text" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="small mb-1" for=" "><b>Engine number</b></label>
                                                                    <input  class="form-control " id="txtE_number" name="txtE_number" type="text" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="small mb-1" for=" "><b>Chassis number</b></label>
                                                                    <input  class="form-control " id="txtC_number" name="txtC_number" type="text" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="small mb-1" for=" "><b>Registered owner</b></label>
                                                                    <input  class="form-control " id="txtR_owner" name="txtR_owner" type="text" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                    </div>


                                                    <div class="container-fluid" style="background-color: white;">
                                                    <h3>List of Violations</h3>
                                                        <div class="form-row">
                                                            <div class="col-md-6">
                                                                <b>I. LTO Violations fee relative to Licensing </b>
                                                                <div class="form-check"><br>
                                                                    <label  class="small mb-1" > <input type="checkbox" id= "violation1_1" name="violation1[]" value = "LV1-001-01"> Driving without license in the Philippines</label> <br>
                                                                    <label  class="small mb-1" > <input type="checkbox" id= "violation1_2" name="violation1[]" value = "LV1-002-01"> LTO penalty for not wearing seatbelt in the Philippines</label> <br>
                                                                    <label  class="small mb-1" > <input type="checkbox" id= "violation1_3" name="violation1[]" value = "LV1-003-01"> Driving under the impact of alcohol/dangerous drugs</label> <br>
                                                                    <label  class="small mb-1" > <input type="checkbox" id= "violation1_4" name="violation1[]" value = "LV1-004-01"> Careless driving</label> <br>
                                                                    <label  class="small mb-1" > <input type="checkbox" id= "violation1_5" name="violation1[]" value = "LV1-005-01"> Other LTO violations and penalties for breaking traffic rules</label> <br>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <b>II. LTO Fines and Penalties connected with car registration/renewal </b>
                                                                <div class="form-check"><br>
                                                                    <label  class="small mb-1" > <input type="checkbox" id= "violation2_1" name="violation2[]" value = "LV2-001-01"> Driving without valid vehicle registration</label> <br>
                                                                    <label  class="small mb-1" > <input type="checkbox" id= "violation2_2" name="violation2[]" value = "LV2-002-01"> Driving an illegally modified car </label> <br>
                                                                    <label  class="small mb-1" > <input type="checkbox" id= "violation2_3" name="violation2[]" value = "LV2-003-01"> Running a right hand car</label> <br>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <b>III. LTO Fines and Penalties cin connection with vehicles accessories, equipment, parts</b>
                                                                <div class="form-check"><br>
                                                                    <label  class="small mb-1" > <input type="checkbox" id= "violation3_1" name="violation3[]" value = "LV3-001-01"> Driving a car without proper/authorized devices, equipment, accessories or car part</label> <br>
                                                                    <label  class="small mb-1" > <input type="checkbox" id= "violation3_2" name="violation3[]" value = "LV3-003-02"> Operating a car  with an improper attachment/unauthorized of motor vehicle license plate </label> <br>
                                                                    <label  class="small mb-1" > <input type="checkbox" id= "violation3_3" name="violation3[]" value = "LV3-003-03"> Smoke Belching</label> <br>
                                                                    <label  class="small mb-1" > <input type="checkbox" id= "violation3_3" name="violation3[]" value = "LV4-001-01"> Other related LTO violations</label> <br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                    </div>

                                                    <div class="form-group mt-4 mb-0"> <input type="submit" class="btn btn-primary" name="submitViolation" style="width:100%"></div>
                                                 
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>    
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
        </script>
    </body>
</html>
