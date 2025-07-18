<?php
// Fichier : autoloader.php

/**
 * Enregistre une fonction d'autochargement de classes.
 * Cette fonction est appelée automatiquement par PHP lorsqu'une classe est utilisée pour la première fois
 * et que son fichier n'a pas encore été inclus.
 */
spl_autoload_register(function ($class_name) {
    // Liste des répertoires où nos classes sont stockées.
    // L'ordre peut avoir une importance si des classes de noms similaires existent dans différents dossiers.
    $directories = [
        'core/',         // Pour les classes de base comme Model et Controller
        'models/',       // Pour les classes de modèles spécifiques (Livre, Categorie)
        'controllers/',  // Pour les classes de contrôleurs (LivreController, CategorieController)
    ];

    // Parcourt chaque répertoire défini
    foreach ($directories as $directory) {
        // Construit le chemin complet du fichier attendu pour la classe.
        // __DIR__ représente le répertoire du fichier autoloader.php lui-même.
        $file = __DIR__ . '/' . $directory . $class_name . '.php';

        // Vérifie si le fichier de la classe existe à ce chemin
        if (file_exists($file)) {
            require_once $file; // Si le fichier existe, l'inclut
            return; // Arrête la boucle et la fonction une fois que la classe est trouvée et chargée
        }
    }
    // Si la classe n'est pas trouvée après avoir parcouru tous les répertoires,
    // vous pouvez décommenter la ligne ci-dessous pour le débogage.
    // echo "Erreur: La classe '" . $class_name . "' n'a pas pu être trouvée. Chemin recherché: " . $file;
    // die(); // Arrête le script pour montrer l'erreur clairement
});
