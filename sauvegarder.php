<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, GET');

// Augmente la limite de mémoire pour accepter de nombreuses images d'un coup
ini_set('memory_limit', '256M');

$fichier = 'images-publiques.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $donneesJSON = file_get_contents('php://input');
    
    if (!empty($donneesJSON)) {
        // Sauvegarde les données dans le fichier JSON
        $succes = file_put_contents($fichier, $donneesJSON);
        
        if ($succes !== false) {
            echo json_encode(["status" => "success"]);
            exit;
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Impossible d'ecrire dans le fichier. Verifiez les permissions du dossier."]);
            exit;
        }
    }
    http_response_code(400);
    echo json_encode(["error" => "Donnees vides"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (file_exists($fichier)) {
        echo file_get_contents($fichier);
    } else {
        echo json_encode(new stdClass());
    }
    exit;
}
?>