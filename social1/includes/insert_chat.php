<?php
require "dbh.inc.php";

session_start();

$data = array(
    ':to_user_id'   => $_POST['to_user_id'],
    ':from_user_id' => $_SESSION['userId'],
    ':chat_message' => $_POST['chat_message'],
    ':status'       => '1',
);
$toUserId = $data[':to_user_id'];
$fromUserId = $data[':from_user_id'];
$chatMessage = $data[':chat_message'];
$status = $data[':status'];

$sql = "
INSERT INTO chat_message(to_user_id, from_user_id, chat_message, status) VALUES ('".$toUserId."', '".$fromUserId."', '".$chatMessage."', '".$status."');
";

if(mysqli_query($conn, $sql)) {
    echo fetch_user_chat_history($_SESSION['userId'], $_POST['to_user_id'], $conn);
}else echo "Didn't connect to the database";



