<?php

session_start();
if(!isset($_SESSION['user'])){
    header("location: ../login.php");
}
include '../db_connection.php';


if(isset($_POST['submitViolation'])){
    $conn = OpenCon();

    $txtlicense= $_POST['txtlicense'];
    $txtP_Apprehension = $_POST['txtP_Apprehension'];
    $txtC_items= $_POST['txtC_items'];
    $txtP_number = $_POST['txtP_number'];
    $txtF_number= $_POST['txtF_number'];
    $txtE_number =  $_POST['txtE_number'];
    $txtC_number=  $_POST['txtC_number'];
    $txtR_owner=  $_POST['txtR_owner'];

    $violation1 ="";
    $violation2 ="";
    $violation3 ="";
    //inserting data
    $date = date('d/m/Y', mktime(0, 0, 0, date('m'), date('d') + 5, date('Y')));
    $sql = "select * from tbl_driverviolation";
    $res = mysqli_query($conn,$sql);
    $x=0;
    while($list = mysqli_fetch_assoc($res))
        $x++;

    $temp_violation = 'V01-'.substr(date("Y"), 2).'-'.str_pad(($x+1), 6, '0', STR_PAD_LEFT);
    if(!empty($_POST['violation1']))
    foreach($_POST['violation1'] as $checked){
        $sql = 'INSERT INTO `tbl_driverviolation` ( `violationNumber`, `licenseNumber`, `staffID`, `violationID`, `apprehensionPlace`, `plateNumber`, `fileNumber`, `chassisNumber`, `engineNumber`, `registeredOwner`, `confiscatedItem`, `dueDate`) 
                   VALUES (\''. $temp_violation.'\',\''.$txtlicense.'\',\''.$_SESSION['user'].'\', \''.$checked.'\', \''.$txtP_Apprehension.'\', \''.$txtP_number.'\', \''.$txtF_number.'\', \''.$txtC_number.'\', \''.$txtE_number.'\', \''.$txtR_owner.'\', \''.$txtC_items.'\', \''.$date.'\')';                   
       
        $conn->query($sql);
    }

    if(!empty($_POST['violation2']))
    foreach($_POST['violation2'] as $checked){
        $sql = 'INSERT INTO `tbl_driverviolation` ( `violationNumber`, `licenseNumber`, `staffID`, `violationID`, `apprehensionPlace`, `plateNumber`, `fileNumber`, `chassisNumber`, `engineNumber`, `registeredOwner`, `confiscatedItem`, `dueDate`) 
        VALUES (\''. $temp_violation.'\',\''.$txtlicense.'\',\''.$_SESSION['user'].'\', \''.$checked.'\', \''.$txtP_Apprehension.'\', \''.$txtP_number.'\', \''.$txtF_number.'\', \''.$txtC_number.'\', \''.$txtE_number.'\', \''.$txtR_owner.'\', \''.$txtC_items.'\', \''.$date.'\')';                   
        $conn->query($sql);
    }

    if(!empty($_POST['violation3']))
    foreach($_POST['violation3'] as $checked){
        $sql = 'INSERT INTO `tbl_driverviolation` ( `violationNumber`, `licenseNumber`, `staffID`, `violationID`, `apprehensionPlace`, `plateNumber`, `fileNumber`, `chassisNumber`, `engineNumber`, `registeredOwner`, `confiscatedItem`, `dueDate`) 
        VALUES (\''. $temp_violation.'\',\''.$txtlicense.'\',\''.$_SESSION['user'].'\', \''.$checked.'\', \''.$txtP_Apprehension.'\', \''.$txtP_number.'\', \''.$txtF_number.'\', \''.$txtC_number.'\', \''.$txtE_number.'\', \''.$txtR_owner.'\', \''.$txtC_items.'\', \''.$date.'\')';                   
       
        $conn->query($sql);
    }

    header("location: ../officerView/index.php");

    CloseCon($conn);
}
?>