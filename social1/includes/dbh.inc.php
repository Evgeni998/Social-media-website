<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "loginsystem";


$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function fetch_user_last_activity($user_id, $conn)
{
    $sql = "SELECT * FROM login_details WHERE user_id = '$user_id' ORDER BY last_activity DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    foreach ($result as $row) {
        return $row['last_activity'];
    }
}

function fetch_user_chat_history($from_user_id, $to_user_id, $conn) {
    $sql = "
    SELECT * FROM chat_message
    WHERE (from_user_id = '".$from_user_id."'
    AND to_user_id = '".$to_user_id."')
    OR (from_user_id = '".$to_user_id."'
    AND to_user_id = '".$from_user_id."')
    ORDER BY timestamp ASC
    ";
    $result = mysqli_query($conn, $sql);
    $output =  '<ul>';
    foreach($result as $row) {
        $user_name = '';
        if($row['from_user_id'] == $from_user_id) {
            $user_name = '<b>You</b>';
        } else {
            $user_name = '<b class = "text-danger">'.get_user_name($row['from_user_id'], $conn).'</b>';
        }
        $output .=
            '<li style = "border-bottom: 1px dotted #ccc">
            <p>'.$user_name.' - '.$row["chat_message"].'
                <div style = "text-align:right">
                    - <small><em>'.$row["timestamp"].'</em></small>
                </div>
            </p>
        </li>
        ';
    }
    $output.= '</ul>';
    $sql =  "UPDATE chat_message SET status = '0' WHERE from_user_id = '".$to_user_id."' AND to_user_id = '".$from_user_id."' AND status = '1'";
    mysqli_query($conn, $sql);
    return $output;
}

function get_user_name($user_id, $conn) {
    $sql = "SELECT user_username from users WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    foreach($result as $row) {
        return $row['user_username'];
    }
}

function count_unseen_message($from_user_id, $to_user_id, $conn) {
    $sql = "SELECT * FROM chat_message WHERE from_user_id = $from_user_id AND to_user_id = $to_user_id and status = '1'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    $output = '';
    if($count > 0) {
        $output = '<span style="background-color: #3aee20; padding:4px 6px; border-radius:10px;">' .$count.'</span>';
    }
    return $output;
}
