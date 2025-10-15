<?php
require 'config.php';

// get search keyword from get or post
$input = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $data = json_decode(file_get_contents("php://input"), true);
    $input = isset($data['query']) ? trim($data['query']) : '';
}else{
    $input = isset($_GET['query']) ? trim($_GET['query']) : '';
}

if($input === ''){
    echo json_encode(['users' => []]);
    exit;
}

// prepare statement
$like = "%" . $conn->real_escape_string($input) . "%";
$sql = "SELECT id, name, phone, address, created_at
        FROM users
        WHERE name LIKE ? or phone LIKE ?
        ORDER BY id DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $like, $like);
$stmt->execute();

$result = $stmt->get_result();
$users = [];

while($row = $result->fetch_assoc()){
    $users[] = $row;
}

echo json_encode(["users" => $users]);

$stmt->close();
$conn->close();

?>