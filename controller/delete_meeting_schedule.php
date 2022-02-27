<?php

//delete.php

if(isset($_POST["id"]))
{
    $connect = new PDO('mysql:host=localhost;dbname=icp_assignment', 'root', '');
    $query = "DELETE from meeting WHERE id=:id";

    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':id' => $_POST['id']
        )
    );
}

?>
