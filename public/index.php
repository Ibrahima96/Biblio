<?php
// Fichier : bibliotheque/public/index.php

// --- PARAMÈTRES DE DÉBOGAGE : À ACTIVER POUR VOIR LES ERREURS PHP ---
// Ces lignes doivent être commentées ou supprimées en environnement de production.
ini_set('display_errors', 1);        // Affiche les erreurs PHP à l'écran
ini_set('display_startup_errors', 1); // Affiche les erreurs survenues au démarrage de PHP
error_reporting(E_ALL);               // Rapporte tous les types d'erreurs PHP
// --- FIN DES PARAMÈTRES DE DÉBOGAGE ---

// Inclut l'autoloader qui va charger automatiquement nos classes (Model, Controller, Livre, etc.)
// Le chemin est '../autoloader.php' car index.php est dans 'public/' et autoloader.php est à la racine du projet.
require_once '../autoloader.php';
// Inclut le fichier de configuration de la base de données.
require_once '../config/database.php';

// 1. Récupération du contrôleur et de l'action demandés dans l'URL.
// On utilise l'opérateur de coalescence null (??) pour définir des valeurs par défaut.
// Si '?controller=' n'est pas spécifié dans l'URL, 'livre' est utilisé par défaut.
// La fonction `ucfirst()` met la première lettre en majuscule (ex: 'livre' -> 'LivreController').
$controllerName = ucfirst(($_GET['controller'] ?? 'livre')) . 'Controller';
// Si '?action=' n'est pas spécifié, 'index' est utilisé par défaut.
$actionName = $_GET['action'] ?? 'index';

// 2. Exécution du contrôleur et de l'action.

// Vérifie si la classe du contrôleur existe (l'autoloader l'aura chargée si le fichier existe).
if (class_exists($controllerName)) {
    // Crée une nouvelle instance du contrôleur (ex: new LivreController()).
    $controller = new $controllerName();

    // Vérifie si la méthode (l'action) demandée existe dans le contrôleur.
    if (method_exists($controller, $actionName)) {
        // Appelle la méthode (l'action) du contrôleur.
        // Exemple: si $controllerName est 'LivreController' et $actionName est 'index',
        // cela exécute $controller->index().
        $controller->$actionName();
    } else {
        // Si l'action n'existe pas, affiche une erreur 404 stylisée avec Tailwind.
        echo "<body class='bg-gray-100 flex items-center justify-center min-h-screen'><div class='text-center p-8 bg-white shadow-lg rounded-lg'><h1 class='text-5xl font-bold text-red-600 mb-4'>Erreur 404</h1><p class='text-xl text-gray-700'>L'action '<strong>" . htmlspecialchars($actionName) . "</strong>' n'a pas été trouvée pour le contrôleur '<strong>" . htmlspecialchars($controllerName) . "</strong>'.</p><a href='/bibliotheque/public/index.php' class='mt-6 inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-200'>Retour à l'accueil</a></div></body>";
    }
} else {
    // Si le contrôleur n'existe pas, affiche une erreur 404 stylisée.
    echo "<body class='bg-gray-100 flex items-center justify-center min-h-screen'><div class='text-center p-8 bg-white shadow-lg rounded-lg'><h1 class='text-5xl font-bold text-red-600 mb-4'>Erreur 404</h1><p class='text-xl text-gray-700'>Le contrôleur '<strong>" . htmlspecialchars($controllerName) . "</strong>' est introuvable.</p><a href='/bibliotheque/public/index.php' class='mt-6 inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-200'>Retour à l'accueil</a></div></body>";
}
