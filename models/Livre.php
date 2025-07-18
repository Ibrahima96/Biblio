<?php
// Fichier : models/Livre.php

/**
 * Classe Livre.
 * Gère les opérations CRUD pour la table 'livres'.
 * Hérite de la classe Model pour bénéficier des fonctionnalités de base de données.
 */
class Livre extends Model {
    // Définit le nom de la table associée à ce modèle.
    protected $table_name = 'livres';

    // Propriétés publiques qui correspondent aux colonnes de la table 'livres'.
    // Elles sont utilisées pour lier les données des formulaires et de la base de données.
    public $id;
    public $titre;
    public $auteur;
    public $id_categorie;

    /**
     * Crée un nouveau livre dans la base de données.
     * @return bool Vrai si l'insertion est réussie, faux sinon.
     */
    public function create() {
        // Requête SQL pour insérer un nouveau livre.
        // Utilise des placeholders nommés (:titre, :auteur, :id_categorie) pour la sécurité (prévention des injections SQL).
        $query = "INSERT INTO " . $this->table_name . " (titre, auteur, id_categorie) VALUES (:titre, :auteur, :id_categorie)";
        $stmt = $this->conn->prepare($query); // Prépare la requête

        // Nettoie les données pour éviter les injections XSS (Cross-Site Scripting)
        // et supprime les balises HTML.
        $this->titre = htmlspecialchars(strip_tags($this->titre));
        $this->auteur = htmlspecialchars(strip_tags($this->auteur));
        // Gère le cas où id_categorie pourrait être vide (si la catégorie est optionnelle ou non sélectionnée)
        $this->id_categorie = empty($this->id_categorie) ? null : htmlspecialchars(strip_tags($this->id_categorie));

        // Lie les valeurs des propriétés aux placeholders de la requête préparée.
        $stmt->bindParam(":titre", $this->titre);
        $stmt->bindParam(":auteur", $this->auteur);
        $stmt->bindParam(":id_categorie", $this->id_categorie);

        // Exécute la requête et retourne le résultat.
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Met à jour un livre existant dans la base de données.
     * @return bool Vrai si la mise à jour est réussie, faux sinon.
     */
    public function update() {
        // Requête SQL pour mettre à jour un livre par son ID.
        $query = "UPDATE " . $this->table_name . " SET titre = :titre, auteur = :auteur, id_categorie = :id_categorie WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Nettoie les données
        $this->titre = htmlspecialchars(strip_tags($this->titre));
        $this->auteur = htmlspecialchars(strip_tags($this->auteur));
        $this->id_categorie = empty($this->id_categorie) ? null : htmlspecialchars(strip_tags($this->id_categorie));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Lie les valeurs
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':auteur', $this->auteur);
        $stmt->bindParam(':id_categorie', $this->id_categorie);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Supprime un livre de la base de données par son ID.
     * @param int $id L'ID du livre à supprimer.
     * @return bool Vrai si la suppression est réussie, faux sinon.
     */
    public function delete($id) {
        // Requête SQL pour supprimer un livre.
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $id = htmlspecialchars(strip_tags($id)); // Nettoie l'ID
        $stmt->bindParam(1, $id); // Lie l'ID au placeholder

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Récupère tous les livres avec les noms de leurs catégories associées.
     * Utilise une jointure LEFT JOIN pour inclure les livres sans catégorie.
     * @return array Un tableau associatif de livres avec les noms de catégorie.
     */
    public function getLivresWithCategories() {
        $query = "SELECT l.id, l.titre, l.auteur, c.nom as categorie_nom 
                  FROM " . $this->table_name . " l 
                  LEFT JOIN categories c ON l.id_categorie = c.id 
                  ORDER BY l.titre ASC"; // Ordonne par titre
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
