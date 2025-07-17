<?php
require_once './config/database.php'; // doit définir $conn = new PDO(...);

class Livre
{
    private $conn;

    // Constructeur pour injecter la connexion à la base
    public function __construct($connexion)
    {
        $this->conn = $connexion;
    }

    public function all()
    {
        $requete = $this->conn->prepare("SELECT * FROM livres");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findId($id)
    {
        $requete = $this->conn->prepare("SELECT * FROM livres WHERE id = ?");
        $requete->execute([$id]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function create($titre_du_livre, $auteur_livre)
    {
        $requete = $this->conn->prepare("INSERT INTO livres (titre, auteur) VALUES (?, ?)");
        return $requete->execute([$titre_du_livre, $auteur_livre]);
    }

    public function update($id, $titre_du_livre, $auteur_livre)
    {
        $requete = $this->conn->prepare("UPDATE livres SET titre = ?, auteur = ? WHERE id = ?");
        return $requete->execute([$titre_du_livre, $auteur_livre, $id]);
    }

    public function delete($id)
    {
        $requete = $this->conn->prepare("DELETE FROM livres WHERE id = ?");
        return $requete->execute([$id]);
    }
}
