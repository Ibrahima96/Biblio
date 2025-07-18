<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Ajouter un Livre</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<section class="flex min-h-screen w-full items-center justify-center">
    <div class="w-1/2 p-8">
        <!-- L'action du formulaire pointe vers le contrôleur et l'action 'create' via public/index.php -->
        <!-- C'est public/index.php qui va recevoir cette requête POST -->
        <form action="?controller=livre&action=create" method="post">
            <div class="max-w-2xl mx-auto px-4 space-y-4">
                <!-- Lien de retour à la liste des livres -->
                <!-- Le lien pointe aussi vers public/index.php -->
                <a href="?controller=livre&action=index" class="mb-3 underline block font-thin text-xl text-blue-600 hover:text-blue-800 transition duration-200">Retour à la liste des livres</a>
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Ajouter un Nouveau Livre</h2>
                
                <!-- Champ de sélection de la catégorie -->
                <div>
                    <!-- Le 'name' doit être 'id_categorie' pour correspondre à Livre::$id_categorie -->
                    <label for="id_categorie" class="sr-only">Genre de livre (catégorie)</label>
                    <select id="id_categorie" name="id_categorie"
                            class="w-full rounded border border-gray-300 p-3 text-base focus:outline focus:outline-blue-500 shadow placeholder-gray-400 bg-white">
                        <option value="">Sélectionner un genre (drama, action, romance...)</option>
                        <?php
                        // $categories est un tableau PHP qui est passé à cette vue par le LivreController.
                        // La vue n'a pas besoin de savoir comment $categories a été obtenu, juste qu'il est là.
                        if (!empty($categories)) {
                            foreach ($categories as $categorie) {
                                echo '<option value="' . htmlspecialchars($categorie['id']) . '">' . htmlspecialchars($categorie['nom']) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <!-- Champ pour le titre du livre -->
                <div>
                    <!-- Le 'name' doit être 'titre' pour correspondre à Livre::$titre -->
                    <label for="titre" class="sr-only">Titre du livre</label>
                    <input type="text" id="titre"
                           class="w-full rounded border border-gray-300 p-3 text-base focus:outline focus:outline-blue-500 shadow placeholder-gray-400"
                           placeholder="Titre du livre" name="titre" required>
                </div>
                <!-- Champ pour l'auteur du livre -->
                <div>
                    <!-- Le 'name' doit être 'auteur' pour correspondre à Livre::$auteur -->
                    <label for="auteur" class="sr-only">Auteur du livre</label>
                    <input type="text" id="auteur"
                           class="w-full rounded border border-gray-300 p-3 text-base focus:outline focus:outline-blue-500 shadow placeholder-gray-400"
                           placeholder="Auteur du livre" name="auteur">
                </div>
                <!-- Bouton de soumission du formulaire -->
                <button type="submit"
                        class="inline-flex rounded bg-blue-500 px-8 py-3 text-gray-100 font-semibold text-lg hover:bg-blue-600 cursor-pointer shadow-lg transition duration-200">
                    Ajouter le Livre
                </button>
            </div>
        </form>
    </div>
    <!-- Conteneur de l'image latérale -->
    <div class="w-1/2">
        <!-- Le chemin de l'image est relatif au dossier 'public/' car c'est le point d'entrée -->
        <img src="../assets/mondiale_livre.jpg" alt="Image de bibliothèque mondiale" class="object-cover w-full h-screen">
    </div>
</section>
</body>
</html>
