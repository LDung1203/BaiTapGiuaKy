<?php
require "connect.php";
global $conn;

$bh = mysqli_select_db($conn, "qlsv_luuducanhdung");

$id = isset($_POST["id"]) ? $_POST["id"] : null;
$fullname = isset($_POST["fullname"]) ? $_POST["fullname"] : null;
$dob = isset($_POST["dob"]) ? $_POST["dob"] : null;
$gender = (isset($_POST["gender"]) ? $_POST["gender"] : null)==="male" ? 1 : 0;
$hometown = isset($_POST["hometown"]) ? $_POST["hometown"] : null;
$lever = isset($_POST["lever"]) ? $_POST["lever"] : null;
$groupid = isset($_POST["group_id"]) ? $_POST["group_id"] : null;

if($id && $fullname && $dob && $gender && $hometown && $lever && $groupid){
$addsql = "INSERT INTO table_students(`id`, `fullname`, `dob`, `gender`, `hometown`, `lever`, `group_id`)
VALUES ('$id','$fullname','$dob','$gender','$hometown','$lever','$groupid')";
mysqli_query($conn, $addsql);
}
