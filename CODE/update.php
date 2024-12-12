<?php
$oid = $_POST['oid'];
$fullname = $_POST["fullname"];
$dob = $_POST["dob"];
$gender =($_POST["gender"])==="male" ? 1 : 0;
$hometown =$_POST["hometown"];
$lever =$_POST["lever"];
$group_id = $_POST["group_id"];
$id = $_POST['id'];
require_once('connect.php');
global $conn;
$update_sql = "UPDATE table_students SET id='$id',fullname='$fullname', dob='$dob', gender='$gender', 
                        lever='$lever', group_id='$group_id' WHERE id='$oid'";
mysqli_query($conn, $update_sql);
header("location:display.php");
?>
