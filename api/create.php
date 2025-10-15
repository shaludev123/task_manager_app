<?php
require 'config.php';

// accept json body
$data = json_decode(file_get_contents("php://input"), true);

// fallback to $_POST if needed
if(!$data){
    $data = $_POST;
}

$name = isset($data["name"]) ? trim($data["name"]) : "";
$phone = isset($data["phone"]) ? trim($data["phone"]) : "";
$address = isset($data["address"]) ? trim($data["address"]) : "";

if(empty($name) || empty($phone)){
    http_response_code(400);
    echo json_encode(["message" => "Name and phone are required."]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO users (name, phone, address) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $phone, $address);

if($stmt->execute()) {
    http_response_code(201);
    echo json_encode([
        "message" => "User created.",
        "id" => $stmt->insert_id
    ]);
}else{
    http_response_code(500);
    echo json_encode(["message" => "Failed to create user.", "error" => $conn->error]);

}

$stmt->close();
$conn->close();
?>