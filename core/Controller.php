<?php
// Fichier : core/Controller.php

/**
 * Classe abstraite Controller.
 * C'est la classe de base pour tous les contrôleurs de l'application.
 * Elle fournit des méthodes utilitaires pour l'affichage des vues et les redirections.
 */
abstract class Controller {

    /**
     * Rend une vue en incluant le fichier de vue et en passant des données.
     * @param string $viewPath Le chemin de la vue (ex: 'livre/index').
     * @param array $data Un tableau associatif de données à passer à la vue.
     */
    protected function render($viewPath, $data = []) {
        // La fonction `extract()` prend un tableau associatif et crée des variables
        // avec les clés du tableau comme noms de variables.
        // Exemple: si $data = ['livres' => $listeLivres], alors $livres sera disponible dans la vue.
        extract($data);

        // Construit le chemin complet vers le fichier de vue.
        // __DIR__ est le répertoire actuel (core/), on remonte d'un niveau (../) pour atteindre la racine du projet,
        // puis on descend dans le dossier 'views/'.
        $viewFile = __DIR__ . '/../views/' . $viewPath . '.php';

        // Vérifie si le fichier de vue existe avant de l'inclure
        if (file_exists($viewFile)) {
            require_once $viewFile; // Inclut le fichier de vue
        } else {
            // Affiche un message d'erreur si la vue est introuvable.
            // Utilisez htmlspecialchars pour éviter les failles XSS si $viewPath contient des données utilisateur.
            echo "Erreur : La vue '" . htmlspecialchars($viewPath) . "' n'existe pas.";
        }
    }

    /**
     * Redirige l'utilisateur vers une autre URL.
     * @param string $url L'URL vers laquelle rediriger.
     */
    protected function redirect($url) {
        // Envoie une en-tête HTTP de redirection au navigateur.
        header("Location: " . $url);
        // Termine l'exécution du script pour s'assurer que la redirection est effectuée
        // et qu'aucun autre code PHP n'est exécuté après l'en-tête de redirection.
        exit();
    }
}
