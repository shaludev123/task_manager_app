<?php
require 'config.php';
$data = json_decode(file_get_contents("php://input"), true);
if(!$data) $data = $_POST;

$id = isset($data["id"]) ? intval($data['id']) : (isset($_GET['id']) ? intval($_GET['id']) : 0);

if($id <= 0){
    http_response_code(400);
    echo json_encode(["message" => "Invalid id"]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);

if($stmt->execute()){
    echo json_encode(["message" => "User deleted."]);
}else{
    http_response_code(500);
    echo json_encode(["message" => "Faied to delete", "error" => $conn->error]);
}

$stmt->close();
$conn->close();
?>