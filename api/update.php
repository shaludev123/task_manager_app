<?php
require 'config.php';
$method = $_SERVER['REQUEST_METHOD'];

$data = json_decode(file_get_contents("php://input"), true);
if(!$data) $data = $_POST;

$id = isset($data['id']) ? intval($data['id']) : 0;
$name = isset($data['name']) ? trim($data['name']) : '';
$phone = isset($data['phone']) ? trim($data['phone']) : '';
$address = isset($data['address']) ? trim($data['address']) : '';

if($id <= 0 || empty($name) || empty($phone)){
    http_response_code(400);
    echo json_encode(["message" => "Invalid data. id, name, phone required."]);
    exit;
}

$stmt = $conn->prepare("UPDATE users SET name = ?, phone = ?, address = ? WHERE id = ?");
$stmt->bind_param("sssi", $name, $phone, $address, $id);

if($stmt->execute()){
    echo json_encode(["messge" => "User updated."]);
}else{
    http_response_code(500);
    echo json_encode(["message" => "Failed to update", "error" => $conn->error]);
}

$stmt->close();
$conn->close();
?>