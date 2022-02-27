<?php

//insert.php

$connect = new PDO('mysql:host=localhost;dbname=icp_assignment', 'root', '');

if(isset($_POST["title"]))
{
    $query = "
 INSERT INTO meeting (title,student_unique_id, start_event, end_event) VALUES (:title, :studentid, :start_event, :end_event)";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':title'  => $_POST['title'],
            ':studentid'  => $_POST['studentid'],
            ':start_event' => $_POST['start'],
            ':end_event' => $_POST['end']
        )
    );
}


?>
