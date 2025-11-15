<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'ShopSmart IA')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-green-900 via-teal-800 to-blue-900 min-h-screen text-white">
    
    <!-- NAVBAR -->
    <nav class="bg-gray-900/80 backdrop-blur-sm shadow-lg sticky top-0 z-50 border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="bg-green-600 rounded-lg p-2 mr-3">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                            </svg>
                        </div>
                        <a href="{{ route('home') }}" class="text-white text-2xl font-bold">
                            ShopSmart <span class="text-green-400">IA</span>
                        </a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-4 items-center">
                        <a href="{{ route('products.public.index') }}" class="text-gray-300 hover:text-white hover:bg-gray-800 px-3 py-2 rounded-md text-sm font-medium transition">
                            Productos
                        </a>
                        <a href="{{ route('categories.public.index') }}" class="text-gray-300 hover:text-white hover:bg-gray-800 px-3 py-2 rounded-md text-sm font-medium transition">
                            Categorías
                        </a>
                    </div>
                </div>

                <!-- Búsqueda -->
                <div class="hidden md:flex flex-1 items-center justify-center px-4 lg:px-8">
                    <div class="w-full max-w-lg">
                        <form class="flex" action="{{ route('products.public.index') }}" method="GET">
                            <input 
                                class="form-input bg-gray-800 text-white block w-full rounded-l-lg border-0 py-2 px-4 focus:ring-2 focus:ring-green-500 focus:outline-none placeholder-gray-400" 
                                type="search" 
                                name="search"
                                placeholder="Busca productos con IA...">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 rounded-r-lg transition">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Iconos de usuario -->
                <div class="flex items-center space-x-4">
                    <button class="text-gray-300 hover:text-white transition relative">
                        <span class="sr-only">Carrito</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">0</span>
                    </button>
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">
                            Iniciar Sesión
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-900/80 backdrop-blur-sm mt-16 py-8 border-t border-gray-700">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="flex justify-center space-x-6 mb-4">
                <a href="#" class="text-gray-400 hover:text-white transition">Términos</a>
                <a href="#" class="text-gray-400 hover:text-white transition">Privacidad</a>
                <a href="#" class="text-gray-400 hover:text-white transition">Contacto</a>
            </div>
            <p class="text-gray-400">&copy; {{ date('Y') }} ShopSmart IA. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>
