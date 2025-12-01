<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue - MyTodo</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-pink-50 flex items-center justify-center min-h-screen">

<div class="text-center max-w-xl bg-white p-10 rounded-3xl shadow-lg border border-pink-200">

    <h1 class="text-5xl font-extrabold text-pink-600 mb-6">
        🌸 MyTodo
    </h1>

    <p class="text-gray-600 text-lg mb-8 leading-relaxed">
        Bienvenue dans votre espace de <span class="font-semibold text-pink-500">gestion des tâches</span> !  
        Organisez votre journée, suivez vos progrès, et restez motivé avec une interface simple et élégante.
    </p>

    <div class="flex flex-col gap-4">

        <a href="/login"
           class="w-full bg-pink-500 text-white py-3 rounded-xl text-lg font-semibold hover:bg-pink-600 transition">
            🔐 Se connecter
        </a>

        <a href="/register"
           class="w-full border border-pink-400 text-pink-600 py-3 rounded-xl text-lg font-semibold hover:bg-pink-100 transition">
            ✨ Créer un compte
        </a>

    </div>

</div>

</body>
</html>
