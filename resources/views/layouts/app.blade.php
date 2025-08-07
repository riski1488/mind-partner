<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mind Partner - Layanan Kesehatan Mental')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .sidebar {
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
        }
        
        .nav-link {
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-left: 4px solid #fff;
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .mood-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }
        
        .mood-very-happy { background-color: #10b981; }
        .mood-happy { background-color: #34d399; }
        .mood-neutral { background-color: #fbbf24; }
        .mood-sad { background-color: #f59e0b; }
        .mood-very-sad { background-color: #ef4444; }
        .mood-anxious { background-color: #8b5cf6; }
        .mood-stressed { background-color: #f97316; }
        
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-brain text-2xl text-purple-600 mr-2"></i>
                        <span class="text-xl font-bold text-gray-900">Mind Partner</span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-purple-600 transition-colors focus:outline-none">
                                <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=7C3AED&background=EBF4FF' }}" alt="{{ auth()->user()->name }}">
                                <span class="hidden md:block">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-sm"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user mr-2"></i>Profil
                                </a>
                                <hr class="my-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-purple-600 transition-colors">
                            <i class="fas fa-sign-in-alt mr-1"></i>Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                            <i class="fas fa-user-plus mr-1"></i>Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        @auth
            <!-- Sidebar -->
            <div class="sidebar w-64 min-h-screen hidden md:block flex flex-col justify-between">
                <div class="p-6">
                    <div class="text-white text-center mb-8">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-brain text-2xl"></i>
                        </div>
                        <h3 class="font-semibold">Mind Partner</h3>
                        <p class="text-sm opacity-75">Kesehatan Mental</p>
                    </div>
                    
                    <nav class="space-y-2">
                        <a href="{{ route('dashboard') }}" class="nav-link flex items-center px-4 py-3 text-white rounded-lg {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            <span>Dashboard</span>
                        </a>
                        
                        <a href="{{ route('assessments.index') }}" class="nav-link flex items-center px-4 py-3 text-white rounded-lg {{ request()->routeIs('assessments.*') ? 'active' : '' }}">
                            <i class="fas fa-clipboard-list mr-3"></i>
                            <span>Assessment</span>
                        </a>
                        
                        <a href="{{ route('journals.index') }}" class="nav-link flex items-center px-4 py-3 text-white rounded-lg {{ request()->routeIs('journals.*') ? 'active' : '' }}">
                            <i class="fas fa-book mr-3"></i>
                            <span>Jurnal</span>
                        </a>
                        
                        @if(auth()->user()->isAdmin())
                            <div class="pt-4 border-t border-white border-opacity-20">
                                <p class="text-xs text-white opacity-75 px-4 mb-2">ADMIN</p>
                                <a href="{{ route('admin.dashboard') }}" class="nav-link flex items-center px-4 py-3 text-white rounded-lg {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                                    <i class="fas fa-cog mr-3"></i>
                                    <span>Admin Panel</span>
                                </a>
                            </div>
                        @endif
                    </nav>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        @endauth

        <!-- Main Content -->
        <div class="flex-1">
            <main class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 animate-fade-in">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 animate-fade-in">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 animate-fade-in">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-brain text-2xl text-purple-400 mr-2"></i>
                        <span class="text-xl font-bold">Mind Partner</span>
                    </div>
                    <p class="text-gray-300">
                        Platform kesehatan mental yang membantu Anda memahami dan mengelola kesehatan mental dengan lebih baik.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Layanan</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><i class="fas fa-clipboard-list mr-2"></i>Assessment Mental</li>
                        <li><i class="fas fa-book mr-2"></i>Jurnal Harian</li>
                        <li><i class="fas fa-chart-line mr-2"></i>Tracking Mood</li>
                        <li><i class="fas fa-users mr-2"></i>Konsultasi</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li><i class="fas fa-envelope mr-2"></i>admin@mindpartner.com</li>
                        <li><i class="fas fa-phone mr-2"></i>+62 123 456 789</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i>Batu Merah, Kota Ambon</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; {{ date('Y') }} Mind Partner. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <script>
        // Dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.querySelector('[data-dropdown]');
            const dropdownMenu = document.querySelector('[data-dropdown-menu]');
            
            if (dropdownButton && dropdownMenu) {
                dropdownButton.addEventListener('click', function() {
                    dropdownMenu.classList.toggle('hidden');
                });
                
                document.addEventListener('click', function(event) {
                    if (!dropdownButton.contains(event.target)) {
                        dropdownMenu.classList.add('hidden');
                    }
                });
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html> 