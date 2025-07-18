<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Liste des Livres</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Import Google Fonts normalement -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        /* Définition des familles de polices pour Tailwind */
        .font-lobster {
            font-family: 'Lobster', cursive;
        }
        .font-jost {
            font-family: 'Jost', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 font-jost">
<!-- En-tête avec image de fond et navigation -->
<!-- Le chemin de l'image est relatif au dossier 'public/' car c'est le point d'entrée -->
<header class="bg-[url('../assets/bureau.jpg')] bg-cover bg-center w-full min-h-[360px] relative">
    <!-- Overlay sombre pour améliorer la lisibilité du texte sur l'image -->
    <div class="absolute inset-0 bg-black opacity-50"></div>
    
    <!-- Contenu de l'en-tête : liens de navigation -->
    <div class="relative z-10 flex items-center justify-between p-10">
        <!-- Lien pour ajouter un livre -->
        <!-- Le href doit pointer vers public/index.php avec les bons paramètres -->
        <a href="?controller=livre&action=create"
           class="inline-flex bg-blue-400/30 backdrop-blur-sm
           rounded-full font-bold px-8 py-3 text-white text-lg shadow-md hover:bg-blue-500/40 transition duration-200">Ajouter Livre</a>
        
        <!-- Lien pour gérer les catégories -->
        <!-- Le href doit pointer vers public/index.php avec les bons paramètres -->
        <a href="?controller=categorie&action=index"
           class="inline-flex bg-purple-400/30 backdrop-blur-sm
           rounded-full font-bold px-8 py-3 text-white text-lg shadow-md hover:bg-purple-500/40 transition duration-200">Gérer Catégories</a>
    </div>
    
    <!-- Titre principal de la bibliothèque -->
    <div class="backdrop-blur-sm bg-white/10 p-8 rounded-lg max-w-4xl mx-auto absolute inset-x-0 top-1/2 -translate-y-1/2 w-full text-center">
        <p class="text-white font-extrabold text-4xl lg:text-5xl uppercase tracking-wide font-lobster">Bibliothèque 📚📙📘📗</p>
        <p class="text-white text-lg mt-2 italic">Gérez vos livres et catégories en toute simplicité</p>
    </div>
</header>

<!-- Conteneur principal pour la liste des livres -->
<div class="container mx-auto p-6 md:p-10 bg-white shadow-2xl rounded-xl my-10 border border-gray-200">
    <h2 class="text-4xl font-extrabold text-blue-800 mb-8 text-center">Liste des Livres</h2>

    <!-- Tableau des livres -->
    <div class="overflow-x-auto shadow-xl rounded-lg border border-gray-100">
        <table class="min-w-full bg-white">
            <thead class="bg-blue-700 text-white">
                <tr>
                    <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Titre</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Auteur</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Catégorie</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (!empty($livres)): ?>
                    <?php foreach ($livres as $livre): ?>
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="py-4 px-6 text-gray-800 font-medium"><?php echo htmlspecialchars($livre['titre']); ?></td>
                            <td class="py-4 px-6 text-gray-600"><?php echo htmlspecialchars($livre['auteur']); ?></td>
                            <td class="py-4 px-6 text-gray-600"><?php echo htmlspecialchars($livre['categorie_nom'] ?? 'N/A'); ?></td>
                            <td class="py-4 px-6 flex space-x-2">
                                <!-- Lien pour modifier un livre -->
                                <!-- Le href doit pointer vers public/index.php avec l'ID du livre -->
                                <a href="?controller=livre&action=edit&id=<?php echo $livre['id']; ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-bold py-2 px-4 rounded-md transition duration-200 shadow-md">Modifier</a>
                                <!-- Lien pour supprimer un livre (avec confirmation JS) -->
                                <!-- Le href doit pointer vers public/index.php avec l'ID du livre -->
                                <a href="?controller=livre&action=delete&id=<?php echo $livre['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?');" class="bg-red-600 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded-md transition duration-200 shadow-md">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="py-6 px-6 text-center text-gray-500 italic text-lg">Aucun livre trouvé dans la bibliothèque. Ajoutez-en un !</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
