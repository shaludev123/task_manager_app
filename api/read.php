<?php
require 'config.php';

$result = $conn->query("SELECT id, name, phone, address, created_at FROM users ORDER BY id DESC");

$users = [];
if($result){
    while($row = $result->fetch_assoc()){
        $users[] = $row;
    }
}

echo json_encode(["users" => $users]);
$conn->close();

?>

