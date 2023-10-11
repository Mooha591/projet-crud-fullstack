<?php

require_once('pdo.php');
// préparer la requête
// récupère les données envoyées 
$data = json_decode(file_get_contents("php://input")); // permet de récupérer les données envoyées par l'utilisateur (email et mdp) 
$user_email = trim(htmlspecialchars($data->email));
$password = trim(htmlspecialchars($data->password)); // récupère le mdp envoyé


// requête pour récupérer le mdp hashé
$result = $pdo->prepare("SELECT * FROM user WHERE email = :email");
$result->execute([ //on exécute la requête en insérant les données dans la table
    "email" => $user_email,
]);
// récupérer le résultat
$row = $result->fetch(PDO::FETCH_ASSOC);
// récupère le mdp hashé

// $email = $row['email'];
$hash = $row['password']; // récupère le mdp hashé

// vérifie si le mdp est le même que celui hashé
if (password_verify($password, $hash)) {
    http_response_code(200);
    echo json_encode(["user_id" => $row['user_id'], "first_name" => $row['first_name'], "last_name" => $row['last_name']]);
} else {
    echo "not ok";
}
