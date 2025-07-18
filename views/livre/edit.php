<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Modifier le Livre</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<!-- En-tête avec image de fond et titre -->
<!-- Le chemin de l'image est relatif au dossier 'public/' car c'est le point d'entrée -->
<header class="bg-[url('../assets/livre.jpg')] bg-cover bg-center w-full min-h-[360px] relative mb-8 flex items-center justify-center">
    <div class="absolute inset-0 bg-black opacity-40"></div> <!-- Overlay sombre -->
    <h1 class="text-5xl font-extrabold text-white z-10 drop-shadow-lg">Modifier le Livre</h1>
</header>

<!-- Formulaire de modification du livre -->
<!-- L'action du formulaire inclut l'ID du livre à modifier -->
<form action="?controller=livre&action=edit&id=<?php echo htmlspecialchars($livre['id']); ?>" method="post">
    <div class="max-w-2xl mx-auto px-4 mt-8 space-y-4 bg-white p-8 rounded-lg shadow-xl border border-gray-200">
        <!-- Lien de retour à la liste des livres -->
        <a href="?controller=livre&action=index" class="mb-3 underline block font-thin text-xl text-blue-600 hover:text-blue-800 transition duration-200">Retour à la liste des livres</a>
        
        <!-- Champ de sélection de la catégorie -->
        <div>
            <label for="id_categorie" class="block text-lg font-medium text-gray-700 mb-1">Genre de livre:</label>
            <select id="id_categorie" name="id_categorie"
                    class="w-full rounded border border-gray-300 p-3 text-base focus:outline focus:outline-yellow-500 shadow bg-white">
                <option value="">Sélectionner un genre</option>
                <?php
                // $categories et $livre sont passés par le contrôleur
                if (!empty($categories)) {
                    foreach ($categories as $categorie) {
                        // 'selected' si l'ID de la catégorie correspond à l'id_categorie du livre
                        $selected = ($categorie['id'] == $livre['id_categorie']) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($categorie['id']) . '" ' . $selected . '>' . htmlspecialchars($categorie['nom']) . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <!-- Champ pour le titre du livre (pré-rempli avec la valeur actuelle) -->
        <div>
            <label for="titre" class="block text-lg font-medium text-gray-700 mb-1">Titre du livre:</label>
            <input type="text" id="titre"
                   class="w-full rounded border border-gray-300 p-3 text-base focus:outline focus:outline-yellow-500 shadow"
                   placeholder="Titre du livre" name="titre" value="<?php echo htmlspecialchars($livre['titre']); ?>" required>
        </div>
        <!-- Champ pour l'auteur du livre (pré-rempli) -->
        <div>
            <label for="auteur" class="block text-lg font-medium text-gray-700 mb-1">Auteur du livre:</label>
            <input type="text" id="auteur"
                   class="w-full rounded border border-gray-300 p-3 text-base focus:outline focus:outline-yellow-500 shadow"
                   placeholder="Auteur du livre" name="auteur" value="<?php echo htmlspecialchars($livre['auteur']); ?>">
        </div>
        <!-- Bouton de soumission pour modifier -->
        <button type="submit"
                class="inline-flex items-center justify-center rounded bg-yellow-500 hover:bg-yellow-600 px-8 py-3 text-white font-bold text-lg shadow-md hover:shadow-lg transition duration-200">
            Enregistrer les modifications
        </button>
    </div>
</form>
</body>
</html>
