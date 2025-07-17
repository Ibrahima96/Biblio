<?php
require_once  'Model.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    //echo "Connexion réussie !";
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
