<?php
// Fichier : models/Categorie.php

/**
 * Classe Categorie.
 * Gère les opérations CRUD pour la table 'categories'.
 * Hérite de la classe Model.
 */
class Categorie extends Model {
    // Définit le nom de la table associée à ce modèle.
    protected $table_name = 'categories';

    // Propriétés publiques qui correspondent aux colonnes de la table 'categories'.
    public $id;
    public $nom;

    /**
     * Crée une nouvelle catégorie dans la base de données.
     * @return bool Vrai si l'insertion est réussie, faux sinon.
     */
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (nom) VALUES (:nom)";
        $stmt = $this->conn->prepare($query);

        $this->nom = htmlspecialchars(strip_tags($this->nom)); // Nettoie le nom

        $stmt->bindParam(":nom", $this->nom);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Met à jour une catégorie existante.
     * @return bool Vrai si la mise à jour est réussie, faux sinon.
     */
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nom = :nom WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Supprime une catégorie de la base de données.
     * @param int $id L'ID de la catégorie à supprimer.
     * @return bool Vrai si la suppression est réussie, faux sinon.
     */
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $id = htmlspecialchars(strip_tags($id));
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
