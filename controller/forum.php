<?php
session_start();
include_once "config.php";

$data = array();
$sql = "SELECT forum.id, forum.parent_topic_id, forum.unique_id, forum.category, forum.post, forum.date, student.name from forum 
INNER JOIN student ON forum.unique_id = student.unique_id ORDER BY forum.id DESC";

$result = $conn->query($sql);

while($row = $result->fetch_array()){
    array_push($data, $row);
    array_push($data);
}

$decodedData = json_encode($data);

echo $decodedData;

$conn = null;
exit();



