<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Démo Paycard - @yield('title', 'Accueil')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    
    <header class="bg-white shadow mb-6">
        <div class="container mx-auto px-4 py-4">
            <h1 class="text-2xl font-bold text-gray-800">Démo Paycard</h1>
        </div>
    </header>

    <!-- Contenu Principal -->
    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

</body>
</html>