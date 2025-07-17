<?php
require_once './config/database.php';
class Categorie
{

    public $conn;

    public function __construct($connexion)
    {
        $this->conn = $connexion;
    }
    public function all()
    {
        $requete = $this->conn->prepare("SELECT * FROM categories");
        return $requete->fetchAll();
    }

    public function findId($id)
    {
        $requete = $this->conn->prepare("SELECT * FROM categories WHERE id = ?");

        $requete->execute([$id]);


        return $res = $requete->fetch();

    }
    public function create($nom)
    {
        $requete = $this->conn->prepare("INSERT INTO categories (nom) VALUES (?) ");

        return $requete->execute([$nom]);


    }
    public function update($id, $nom)
    {
        $requete = $this->conn->prepare(" UPDATE categories SET nom = ?  WHERE id = ?");

        return $requete->execute([

            $id,

            $nom

        ]);


    }


    public function delete($id)
    {
        $requete = $this->conn->prepare("DELETE FROM categories WHERE id = ?");

        return $requete->execute([$id]);

    }

}