<?php
require "config.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if($id <= 0){
    http_response_code(400);
    echo json_encode(["message" => "Invalid id"]);
    exit;
}

$stmt = $conn->prepare("SELECT id, name, phone, address, created_at FROM users WHERE id = ?");
$stmt->bind_param("i",$id);
$stmt->execute();
$res = $stmt->get_result();

if($res->num_rows === 0){
    http_response_code(404);
    echo json_encode(["message" => "User not found"]);
    exit;
}

$user = $res->fetch_assoc();
echo json_encode($user);

$stmt->close();
$conn->close();
?>
