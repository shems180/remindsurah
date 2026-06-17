<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, GET');

$fichier = 'images-publiques.json';

// Si l'admin envoie des données (POST), on les enregistre
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $donnees JSON = file_get_contents('php://input');
    if (!empty($donneesJSON)) {
        file_put_contents($fichier, $donneesJSON);
        echo json_encode(["status" => "success"]);
        exit;
    }
    http_response_code(400);
    echo json_encode(["error" => "Données vides"]);
    exit;
}

// Si le public charge la page (GET), on renvoie le fichier d'images
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (file_exists($fichier)) {
        echo file_get_contents($fichier);
    } else {
        echo json_encode(new stdClass()); // Renvoie un objet vide {} si aucun fichier
    }
    exit;
}
?>