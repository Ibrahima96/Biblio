<?php
// Fichier : config/database.php

/**
 * Classe Database pour gérer la connexion à la base de données MySQL via PDO.
 */
class Database {
    // Propriétés de connexion à la base de données
    private $host = 'localhost'; // Hôte de la base de données (souvent 'localhost' en développement)
    private $db_name = 'biblio'; // Nom de votre base de données
    private $username = 'root';        // Nom d'utilisateur MySQL (souvent 'root' en développement)
    private $password = '';            // Mot de passe MySQL (souvent vide en développement)
    private $conn; // Variable qui contiendra l'objet de connexion PDO

    /**
     * Établit et retourne une connexion à la base de données.
     * @return PDO|null L'objet de connexion PDO si réussi, null en cas d'échec.
     */
    public function getConnection() {
        $this->conn = null; // Initialise la connexion à null

        try {
            // Crée une nouvelle instance de PDO (PHP Data Objects)
            // Le DSN (Data Source Name) spécifie le type de base de données, l'hôte et le nom de la base.
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // Configure PDO pour qu'il lance des exceptions en cas d'erreur SQL.
            // C'est très utile pour le débogage car cela rend les erreurs explicites.
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Définit l'encodage des caractères à UTF-8 pour éviter les problèmes d'accents.
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            // Capture toute exception PDO (erreur de connexion, etc.)
            echo "Erreur de connexion à la base de données : " . $exception->getMessage();
            // Arrête l'exécution du script car la base de données est essentielle.
            die();
        }
        return $this->conn; // Retourne l'objet de connexion PDO
    }
}
