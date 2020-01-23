<?php
include_once "dbh.inc.php";
session_start();
$query = "SELECT * FROM users WHERE user_id != '".$_SESSION['userId']."'";
$result = mysqli_query($conn, $query);


$output = '
<table id = "USERS">
    <tr>
        <th>Username</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

';

foreach($result as $row) {
    $status = "";

    $current_timestamp = strtotime(date("Y-m-d H:i:s") . ' - 5 second + 1 hour');
    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
    $user_last_activity = fetch_user_last_activity($row['user_id'], $conn);
    if($user_last_activity > $current_timestamp) {
        $status = "<span class = 'online'>Online</span>";
    } else {
        $status = "<span class = 'offline'>Offline</span>";
    }
    $output .= '
 
        <tr>
            <td>'.$row["user_username"].' '.count_unseen_message($row['user_id'], $_SESSION['userId'], $conn).'</td>
            <td>'.$status.'</td>
            
            <td><button class="btn btn-info btn-xs start_chat" type="button"  data-touserid="'.$row['user_id'].'" data-tousername="'.$row['user_username'].'">Start Chat</button></td>
            
        </tr>
  
    ';
}
$output .= '</table>';
echo $output;



