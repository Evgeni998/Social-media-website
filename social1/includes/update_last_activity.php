<?php
include_once "dbh.inc.php";
session_start();

$sql = "UPDATE login_details set last_activity = now() WHERE login_details_id = '".$_SESSION['login_details_id']."'" ;
$result = mysqli_query($conn, $sql);