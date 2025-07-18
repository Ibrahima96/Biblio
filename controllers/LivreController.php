<?php
// Fichier : controllers/LivreController.php

/**
 * Classe LivreController.
 * Gère les actions liées aux livres (affichage, ajout, modification, suppression).
 * Hérite de la classe Controller pour utiliser les méthodes `render` et `redirect`.
 */
class LivreController extends Controller {
    private $livreModel; // Instance du modèle Livre
    private $categorieModel; // Instance du modèle Categorie (pour les listes déroulantes)

    /**
     * Constructeur du contrôleur.
     * Initialise les modèles nécessaires.
     */
    public function __construct() {
        $this->livreModel = new Livre();
        $this->categorieModel = new Categorie();
    }

    /**
     * Affiche la liste de tous les livres.
     */
    public function index() {
        $livres = $this->livreModel->getLivresWithCategories(); // Récupère les livres avec leurs catégories
        $this->render('livre/index', ['livres' => $livres]); // Rend la vue 'livre/index' en lui passant les livres
    }

    /**
     * Gère l'ajout d'un nouveau livre.
     * Affiche le formulaire d'ajout (GET) ou traite la soumission du formulaire (POST).
     */
    public function create() {
        $categories = $this->categorieModel->getAll(); // Récupère toutes les catégories pour la liste déroulante

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Si le formulaire a été soumis (méthode POST)
            $this->livreModel->titre = $_POST['titre'] ?? ''; // Récupère le titre du POST
            $this->livreModel->auteur = $_POST['auteur'] ?? ''; // Récupère l'auteur du POST
            $this->livreModel->id_categorie = $_POST['id_categorie'] ?? null; // Récupère l'ID de catégorie du POST

            if ($this->livreModel->create()) {
                // Si la création est réussie, redirige vers la liste des livres
                $this->redirect('/bibliotheque/public/index.php?controller=livre&action=index');
            } else {
                // Si la création échoue, affiche un message d'erreur
                echo "Erreur lors de l'ajout du livre.";
            }
        }
        // Affiche le formulaire d'ajout (méthode GET ou après échec de POST)
        $this->render('livre/create', ['categories' => $categories]);
    }

    /**
     * Gère la modification d'un livre existant.
     * Affiche le formulaire de modification pré-rempli (GET) ou traite la soumission (POST).
     */
    public function edit() {
        $categories = $this->categorieModel->getAll(); // Récupère toutes les catégories

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $livre = $this->livreModel->getById($id); // Récupère le livre par son ID

            if (!$livre) {
                // Si le livre n'est pas trouvé, affiche un message et arrête
                echo "Livre non trouvé.";
                return;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Si le formulaire a été soumis
                $this->livreModel->id = $id; // Assigne l'ID au modèle
                $this->livreModel->titre = $_POST['titre'] ?? '';
                $this->livreModel->auteur = $_POST['auteur'] ?? '';
                $this->livreModel->id_categorie = $_POST['id_categorie'] ?? null;

                if ($this->livreModel->update()) {
                    // Si la modification est réussie, redirige
                    $this->redirect('/bibliotheque/public/index.php?controller=livre&action=index');
                } else {
                    echo "Erreur lors de la modification du livre.";
                }
            }
            // Affiche le formulaire de modification avec les données du livre et les catégories
            $this->render('livre/edit', ['livre' => $livre, 'categories' => $categories]);
        } else {
            // Si aucun ID n'est fourni, redirige vers la liste des livres
            $this->redirect('/bibliotheque/public/index.php?controller=livre&action=index');
        }
    }

    /**
     * Gère la suppression d'un livre.
     */
    public function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($this->livreModel->delete($id)) {
                // Si la suppression est réussie, redirige
                $this->redirect('/bibliotheque/public/index.php?controller=livre&action=index');
            } else {
                echo "Erreur lors de la suppression du livre.";
            }
        } else {
            // Si aucun ID n'est fourni, redirige
            $this->redirect('/bibliotheque/public/index.php?controller=livre&action=index');
        }
    }
}
