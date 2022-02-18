<?php
include_once "../controller/config.php";

$sql = "SELECT * FROM userlogin";
$result = $conn ->query($sql);

$array = array();
while($row =mysqli_fetch_assoc($result))
{
    $array[] = $row;
}

$dataset = array(
    "echo" => 1,
    "totalrecords" => count($array),
    "totaldisplayrecords" => count($array),
    "data" => $array
);

echo json_encode($array);

?>