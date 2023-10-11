<?php
require_once("pho.php");

$data = json_decode(file_get_contents("php://input"), true); // permet de récupérer les données envoyé par le front-end
$user_id = htmlentities($data["user_id"]); // on récupére l'id de l'utilisateur connecté.
$sql = "DELETE from task WHERE task_id = :task_id"; // ça permet de supprimer la tâche de la base de données en frontion de l'id de la tâche à supprimer.

$stmt = $pdo->prepare($sql);
$stmt->execute([
    "task_id" => $data["task_id"],
]);

echo json_encode(["success" => "task deleted"]);
