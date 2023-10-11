<?php
require_once("pdo.php");
$data = json_decode(file_get_contents("php://input"), true);
$user_id = trim(htmlspecialchars($data["user_id"]));
$sql = "DELETE from task WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    "user_id" => $data["user_id"],
]);

echo json_encode(["success" => "task deleted"]);
