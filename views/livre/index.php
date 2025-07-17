<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Import Google Fonts normalement -->
    <link
        href="https://fonts.googleapis.com/css2?family=Lobster&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

</head>

<body class="bg-[url('assets/bureau.jpg')] bg-cover bg-center w-full min-h-[360px] relative">
    <header>
        <div class="flex items-center justify-between p-10 ">
            <a href="create.php" class="inline-flex bg-blue-400/20
           rounded-full font-thin px-8 text-white text-sm shadow-md">Ajoute</a>
        </div>
        <div class="backdrop-blur-sm bg-white/5 p-8 rounded-lg max-w-4xl mx-auto absolute right-5 left-0 top-20 w-full">
            <p class="text-white text-center font-extrabold text-xl  uppercase">Bibliothéque 📚📙📘📗</p>
        </div>
    </header>

    <div class="mt-[10%]">
        <ul class="flex flex-col sm:flex-row flex-wrap gap-4 items-center justify-center text-white">
            <li class="max-w-xs mx-auto bg-gray-900/5 rounded px-4 py-8 shadow-lg mb-4 backdrop-blur-xl">
                <p>Lorem ipsum dolor sit amet consectetur adi. Aliquam, impedit.</p>
                <div class="flex justify-between items-center mt-8 font-medium">
                    <a href="edit.php?id="
                        class="bg-green-500/45 rounded-full inline-flex py-1 px-8 shadow-md text-white text-sm">Modifier</a>

                    <a href="delete.php?id="
                        class="bg-red-500/35 rounded-full inline-flex py-1 px-8 shadow-md text-white text-sm">Effacher</a>

                </div>
            </li>

        </ul>
    </div>

</body>

</html>