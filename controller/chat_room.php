<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = "SELECT coordinator.name, coordinator.unique_id from userlogin 
            INNER JOIN coordinator ON userlogin.unique_id = coordinator.unique_id WHERE NOT userlogin.unique_id = {$outgoing_id}
            UNION
            SELECT lecturer.name,lecturer.unique_id from userlogin 
            INNER JOIN lecturer ON userlogin.unique_id = lecturer.unique_id WHERE NOT userlogin.unique_id = {$outgoing_id}
            UNION
            SELECT student.name, student.unique_id from userlogin 
            INNER JOIN student ON userlogin.unique_id = student.unique_id WHERE NOT userlogin.unique_id = {$outgoing_id}";
    $query = mysqli_query($conn, $sql);
    $output = "";

    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            $sql2 = "SELECT * FROM message WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";

            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);
            (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
            (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
            if(isset($row2['outgoing_msg_id'])){
                ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
            }else{
                $you = "";
            }
            ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

            $output .= '<a style="text-decoration: none; color: black" href="chat_details.php?user_id='. $row['unique_id'] .'">
                    <div class="card-text">
                        <b><span>'. $row['name'].'</span></b>
                        <p>'. $you . $msg .'</p>
                    </div>
                </a>';
        }
    }

    echo $output;
?>