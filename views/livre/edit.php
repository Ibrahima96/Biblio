

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header class="bg-[url('assets/livre.jpg')] bg-cover bg-center w-full min-h-[360px] relative mb-8"></header>

    <form action="" methode ="POST">
        <div class="max-w-2xl mx-auto px-4 mt-50 space-y-2 ">
            <a href="index.php" class="mb-3 underline block font-thin text-xl">Retour</a>
            <div>
                <input type="text"
                    class="w-full rounded border border-gray-300 p-2 text-sm focus:outline focus:outline-gray-500 shadow placeholder-sm"
                     name="category">
            </div>
            <div>
                <input type="text"
                    class="w-full rounded border border-gray-300 p-2 text-sm focus:outline focus:outline-gray-500 shadow placeholder-sm"
                    name="titre_du_livre" >
            </div>
            <div>
                <input type="text"
                    class="w-full rounded border border-gray-300 p-2 text-sm focus:outline focus:outline-gray-500 shadow placeholder-sm"
                    name="auteur_du_livre">
            </div>
           
            <button
                class="inline-flex items-center justify-center rounded bg-yellow-400 hover:bg-yellow-500 px-6 py-2 text-white shadow-sm hover:shadow-md transition duration-200">
                Modifier
            </button>
        </div>
    </form>
</body>

</html>