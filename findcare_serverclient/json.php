<?php


require_once('db.php');

$query = "SELECT * FROM comments ORDER BY date DESC";
$result=mysqli_query($link,$query);

$output = array();

foreach ($result as $row) {
 array_push($output,$row);


}

$json=json_encode($output);

header("Content-Type: application/json");
echo $json;
?>
