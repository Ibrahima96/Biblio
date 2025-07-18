<?php
// Fichier : core/Model.php

/**
 * Classe abstraite Model.
 * C'est la classe de base pour tous les modèles de l'application.
 * Elle fournit des méthodes génériques pour interagir avec la base de données (CRUD).
 * Une classe abstraite ne peut pas être instanciée directement ; elle doit être héritée.
 */
abstract class Model {
    protected $conn; // L'objet de connexion PDO à la base de données
    protected $table_name; // Le nom de la table associée à ce modèle (doit être défini dans les classes enfants)

    /**
     * Constructeur de la classe Model.
     * Établit la connexion à la base de données dès qu'un objet Model (ou un de ses enfants) est créé.
     */
    public function __construct() {
        $database = new Database(); // Crée une instance de la classe Database
        $this->conn = $database->getConnection(); // Récupère la connexion PDO
    }

    /**
     * Récupère tous les enregistrements de la table associée au modèle.
     * @return array Un tableau associatif de tous les enregistrements.
     */
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name; // Requête SQL pour sélectionner toutes les colonnes
        $stmt = $this->conn->prepare($query); // Prépare la requête pour l'exécution (sécurité)
        $stmt->execute(); // Exécute la requête
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupère tous les résultats sous forme de tableau associatif
    }

    /**
     * Récupère un enregistrement spécifique par son ID.
     * @param int $id L'ID de l'enregistrement à récupérer.
     * @return array|false Un tableau associatif de l'enregistrement ou false si non trouvé.
     */
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?"; // Requête avec un placeholder
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id); // Lie la valeur de l'ID au placeholder
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Récupère un seul résultat
    }

    // --- Méthodes abstraites ---
    // Ces méthodes doivent être implémentées (définies) dans chaque classe enfant.
    // Elles sont spécifiques à chaque modèle car la logique d'insertion/mise à jour/suppression varie.

    /**
     * Méthode abstraite pour créer un nouvel enregistrement.
     * @return bool Vrai si la création est réussie, faux sinon.
     */
    abstract public function create();

    /**
     * Méthode abstraite pour mettre à jour un enregistrement existant.
     * @return bool Vrai si la mise à jour est réussie, faux sinon.
     */
    abstract public function update();

    /**
     * Méthode abstraite pour supprimer un enregistrement par son ID.
     * @param int $id L'ID de l'enregistrement à supprimer.
     * @return bool Vrai si la suppression est réussie, faux sinon.
     */
    abstract public function delete($id);
}
