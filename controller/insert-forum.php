<?php
include_once "config.php";

$id = $_POST['id'];
$unique_id = $_POST['unique_id'];
$category = $_POST['category'];
$post = $_POST['post'];


if ($category == "Parent_category") {
    $select_query = mysqli_query($conn, "Select forum.category from `forum` WHERE forum.id = '".$id."'");
    if(mysqli_num_rows($select_query) > 0){
        $result = mysqli_fetch_assoc($select_query);
        $category = $result['category'];
    }
}

if($category != "" && $post != ""){
    $sql = $conn->query("INSERT INTO forum (parent_topic_id, unique_id, category, post)
        VALUES ('".$id."', '".$unique_id."',  '".$category."', '".$post."')");

    echo json_encode(array("statusCode"=>200));
}
else{
    echo json_encode(array("statusCode"=>201));
}

$conn = null;

?>