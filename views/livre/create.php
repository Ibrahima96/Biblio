
<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <section class="flex min-h-auto w-full capitalize items-center justify-center">
        <div class="w-1/2">
            <form action="" method="POST">
                <div class="max-w-2xl mx-auto px-4 mt-50 space-y-2 capitalize">
                    <a href="index.php" class="mb-3 underline block font-thin text-xl">Retour</a>
                    <div>
                        <input type="text"
                            class="w-full rounded border border-gray-300 p-2 text-sm focus:outline focus:outline-gray-500 shadow placeholder-sm"
                            placeholder="genre de livre (drama,action,romance...)" name="category">
                    </div>
                    <div>
                        <input type="text"
                            class="w-full rounded border border-gray-300 p-2 text-sm focus:outline focus:outline-gray-500 shadow placeholder-sm"
                            placeholder="titre du livre" name="titre_du_livre">
                    </div>
                    <div>
                        <input type="text"
                            class="w-full rounded border border-gray-300 p-2 text-sm focus:outline focus:outline-gray-500 shadow placeholder-sm"
                            placeholder="Auteur du livre" name="auteur_du_livre">
                    </div>


                    <button
                        class="inline-flex rounded bg-blue-500 px-8 hover:bg-blue-600 py-2 text-gray-100 cursor-pointer">
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
        <div class="w-1/2">
            <img src="assets/mondiale_livre.jpg" alt="" class="object-cover w-full h-[775px]">
        </div>
    </section>
</body>

</html>