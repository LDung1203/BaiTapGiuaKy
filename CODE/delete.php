<?php
require_once('connect.php');
global $conn;
$hmid=$_GET['hid'];
require_once("index.php");
$delete_sql="DELETE FROM table_students WHERE id='$hmid'";
mysqli_query($conn,$delete_sql);
header("location:display.php");