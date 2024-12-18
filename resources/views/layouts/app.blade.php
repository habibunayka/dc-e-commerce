<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DC E-Commerce')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">DC E-Commerce</h1>
            <nav>
                <a href="/" class="text-gray-600 hover:text-gray-900 mx-2">Beranda</a>
                <a href="#" class="text-red-600 font-bold mx-2">Keranjang Belanja</a>
            </nav>
        </div>
    </header>

    <!-- Content -->
    <main class="container min-h-screen mx-auto px-6 py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} DC E-Commerce. All Rights Reserved.</p>
    </footer>

</body>
</html>
