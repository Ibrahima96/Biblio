<?php
// Fichier : controllers/CategorieController.php

/**
 * Classe CategorieController.
 * Gère les actions liées aux catégories (affichage, ajout, modification, suppression).
 * Hérite de la classe Controller.
 */
class CategorieController extends Controller {
    private $categorieModel; // Instance du modèle Categorie

    /**
     * Constructeur du contrôleur.
     * Initialise le modèle Categorie.
     */
    public function __construct() {
        $this->categorieModel = new Categorie();
    }

    /**
     * Affiche la liste de toutes les catégories.
     */
    public function index() {
        $categories = $this->categorieModel->getAll(); // Récupère toutes les catégories
        $this->render('categorie/index', ['categories' => $categories]); // Rend la vue 'categorie/index'
    }

    /**
     * Gère l'ajout d'une nouvelle catégorie.
     * Affiche le formulaire (GET) ou traite la soumission (POST).
     */
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Si le formulaire a été soumis
            $this->categorieModel->nom = $_POST['nom'] ?? ''; // Récupère le nom de la catégorie

            if ($this->categorieModel->create()) {
                // Si la création est réussie, redirige
                $this->redirect('/bibliotheque/public/index.php?controller=categorie&action=index');
            } else {
                echo "Erreur lors de l'ajout de la catégorie.";
            }
        }
        // Affiche le formulaire d'ajout de catégorie
        $this->render('categorie/create');
    }

    /**
     * Gère la modification d'une catégorie existante.
     * Affiche le formulaire pré-rempli (GET) ou traite la soumission (POST).
     */
    public function edit() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $categorie = $this->categorieModel->getById($id); // Récupère la catégorie par son ID

            if (!$categorie) {
                echo "Catégorie non trouvée.";
                return;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Si le formulaire a été soumis
                $this->categorieModel->id = $id; // Assigne l'ID
                $this->categorieModel->nom = $_POST['nom'] ?? '';

                if ($this->categorieModel->update()) {
                    // Si la modification est réussie, redirige
                    $this->redirect('/bibliotheque/public/index.php?controller=categorie&action=index');
                } else {
                    echo "Erreur lors de la modification de la catégorie.";
                }
            }
            // Affiche le formulaire de modification avec les données de la catégorie
            $this->render('categorie/edit', ['categorie' => $categorie]);
        } else {
            // Si aucun ID n'est fourni, redirige
            $this->redirect('/bibliotheque/public/index.php?controller=categorie&action=index');
        }
    }

    /**
     * Gère la suppression d'une catégorie.
     */
    public function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($this->categorieModel->delete($id)) {
                // Si la suppression est réussie, redirige
                $this->redirect('/bibliotheque/public/index.php?controller=categorie&action=index');
            } else {
                echo "Erreur lors de la suppression de la catégorie.";
            }
        } else {
            // Si aucun ID n'est fourni, redirige
            $this->redirect('/bibliotheque/public/index.php?controller=categorie&action=index');
        }
    }
}
