<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kerjain - Todo List</title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Configuration for More Elegant Design -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fafafa',
                            100: '#f5f5f5',
                            200: '#e5e5e5',
                            300: '#d4d4d4',
                            400: '#a3a3a3',
                            500: '#737373',
                            600: '#525252',
                            700: '#404040',
                            800: '#262626',
                            900: '#171717',
                        },
                        accent: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.03)',
                        'elegant': '0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01)',
                        'inner-elegant': 'inset 0 1px 2px 0 rgba(0, 0, 0, 0.02)',
                    },
                    borderRadius: {
                        'xl': '0.75rem',
                        '2xl': '1rem',
                        '3xl': '1.25rem',
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.3s ease-out',
                        'slide-up': 'slideUp 0.25s ease-out',
                        'slide-down': 'slideDown 0.25s ease-out',
                        'pulse-soft': 'pulseSoft 2s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(8px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        slideDown: {
                            '0%': { transform: 'translateY(-8px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        pulseSoft: {
                            '0%, 100%': { opacity: '1' },
                            '50%': { opacity: '0.8' },
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Custom Elegant Styles -->
    <style>
        body {
            font-feature-settings: "cv02", "cv03", "cv04", "cv11";
            background-color: #fafafa;
            min-height: 100vh;
        }
        
        /* Smooth transitions */
        * {
            transition: background-color 0.2s ease, border-color 0.2s ease, transform 0.2s ease, opacity 0.2s ease;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #d4d4d4;
            border-radius: 3px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #a3a3a3;
        }
        
        /* Selection color */
        ::selection {
            background-color: rgba(14, 165, 233, 0.15);
            color: #171717;
        }
        
        /* Glass morphism effect - lebih subtle */
        .glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }
        
        /* Hover lift effect - lebih subtle */
        .hover-lift:hover {
            transform: translateY(-1px);
        }
        
        /* Smooth focus outline */
        *:focus {
            outline: 2px solid rgba(14, 165, 233, 0.2);
            outline-offset: 2px;
        }
        
        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Subtle divider */
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(0,0,0,0.05), transparent);
        }
    </style>
    
    <!-- PWA meta tags -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#171717">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
</head>
<body class="font-sans text-primary-800 antialiased flex flex-col min-h-screen">
    <!-- Navigation - Lebih Minimalis -->
    <nav class="glass border-b border-primary-200/30 sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo - Lebih Simple -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3 hover-lift group">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-accent-500 to-accent-600 flex items-center justify-center shadow-soft group-hover:shadow-elegant transition-shadow">
                            <i class="bi bi-check2-square text-white text-base"></i>
                        </div>
                        <span class="text-xl font-semibold tracking-tight text-primary-900 group-hover:text-accent-600 transition-colors">
                            Kerjain
                        </span>
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden">
                    <button type="button" id="mobile-menu-button" class="w-9 h-9 rounded-lg flex items-center justify-center text-primary-600 hover:bg-primary-100 hover:text-accent-600 focus:outline-none transition-colors">
                        <i class="bi bi-three-dots-vertical text-lg"></i>
                    </button>
                </div>

                <!-- Desktop Navigation - Lebih Clean -->
                <div class="hidden lg:flex items-center space-x-0.5">
                    @auth
                        <a href="{{ route('todos.index') }}" class="px-4 py-2.5 rounded-lg text-primary-700 hover:text-accent-600 hover:bg-primary-100/50 {{ request()->routeIs('todos.index') ? 'text-accent-600 bg-accent-50/30' : '' }} transition-all font-medium flex items-center space-x-2">
                            <i class="bi bi-house text-sm"></i>
                            <span class="text-sm">Dashboard</span>
                        </a>
                        <a href="{{ route('todos.create') }}" class="px-4 py-2.5 rounded-lg text-primary-700 hover:text-accent-600 hover:bg-primary-100/50 {{ request()->routeIs('todos.create') ? 'text-accent-600 bg-accent-50/30' : '' }} transition-all font-medium flex items-center space-x-2">
                            <i class="bi bi-plus-circle text-sm"></i>
                            <span class="text-sm">New Task</span>
                        </a>
                        
                        <!-- User dropdown - Lebih Minimalis -->
                        <div class="relative ml-2" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-primary-100/50 focus:outline-none transition-colors hover-lift">
                                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center text-white text-xs font-semibold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <i class="bi bi-chevron-down text-primary-400 text-xs"></i>
                            </button>
                            
                            <div x-show="open" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-1 w-48 bg-white/90 backdrop-blur-sm rounded-xl shadow-elegant border border-primary-200/30 py-2 z-50">
                                <div class="px-3 py-2 border-b border-primary-100/50">
                                    <p class="text-sm font-medium text-primary-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-primary-500 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-3 py-2 text-primary-600 hover:bg-primary-100/50 hover:text-accent-600 flex items-center space-x-2 transition-colors text-sm">
                                        <i class="bi bi-box-arrow-right text-primary-400"></i>
                                        <span>Sign Out</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2.5 rounded-lg text-primary-700 hover:text-accent-600 hover:bg-primary-100/50 {{ request()->routeIs('login') ? 'text-accent-600 bg-accent-50/30' : '' }} transition-all font-medium text-sm">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2.5 bg-gradient-to-r from-accent-500 to-accent-600 text-white rounded-lg hover:from-accent-600 hover:to-accent-700 transition-all font-medium shadow-soft hover:shadow-elegant hover-lift text-sm">
                            Get Started
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu - Lebih Simple -->
        <div id="mobile-menu" class="lg:hidden hidden bg-white/95 backdrop-blur-sm border-t border-primary-200/30 shadow-elegant animate-slide-down">
            <div class="px-3 py-2 space-y-0.5">
                @auth
                    <a href="{{ route('todos.index') }}" class="flex items-center px-3 py-2.5 rounded-lg text-primary-700 hover:text-accent-600 hover:bg-primary-100/50 {{ request()->routeIs('todos.index') ? 'text-accent-600 bg-accent-50/30' : '' }} transition-all font-medium text-sm">
                        <i class="bi bi-house text-sm mr-3 w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('todos.create') }}" class="flex items-center px-3 py-2.5 rounded-lg text-primary-700 hover:text-accent-600 hover:bg-primary-100/50 {{ request()->routeIs('todos.create') ? 'text-accent-600 bg-accent-50/30' : '' }} transition-all font-medium text-sm">
                        <i class="bi bi-plus-circle text-sm mr-3 w-5"></i>
                        <span>New Task</span>
                    </a>
                    <div class="divider my-2"></div>
                    <div class="flex items-center px-3 py-2">
                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center text-white text-xs font-semibold mr-3">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-medium text-primary-900 text-sm">{{ Auth::user()->name }}</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left flex items-center px-3 py-2.5 rounded-lg text-primary-700 hover:text-accent-600 hover:bg-primary-100/50 transition-all font-medium text-sm">
                            <i class="bi bi-box-arrow-right text-sm mr-3 w-5"></i>
                            Sign Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="flex items-center px-3 py-2.5 rounded-lg text-primary-700 hover:text-accent-600 hover:bg-primary-100/50 {{ request()->routeIs('login') ? 'text-accent-600 bg-accent-50/30' : '' }} transition-all font-medium text-sm">
                        <i class="bi bi-box-arrow-in-right text-sm mr-3 w-5"></i>
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center px-3 py-2.5 bg-gradient-to-r from-accent-500 to-accent-600 text-white rounded-lg hover:from-accent-600 hover:to-accent-700 transition-all font-medium shadow-soft text-sm mt-1">
                        <i class="bi bi-rocket-takeoff text-sm mr-3 w-5"></i>
                        Get Started
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
            <!-- Flash Messages - Lebih Minimalis -->
            @if(session('success'))
                <div class="mb-6 p-4 glass rounded-xl border border-emerald-200/50 shadow-soft animate-fade-in">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center mr-3">
                            <i class="bi bi-check-lg text-emerald-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <div class="text-emerald-800 font-medium text-sm">{{ session('success') }}</div>
                        </div>
                        <button type="button" class="w-6 h-6 rounded-full hover:bg-emerald-50 flex items-center justify-center text-emerald-500 hover:text-emerald-700 transition-colors" onclick="this.parentElement.parentElement.remove()">
                            <i class="bi bi-x text-sm"></i>
                        </button>
                    </div>
                </div>
            @endif
            
            @if(session('error'))
                <div class="mb-6 p-4 glass rounded-xl border border-rose-200/50 shadow-soft animate-fade-in">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center mr-3">
                            <i class="bi bi-exclamation-lg text-rose-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <div class="text-rose-800 font-medium text-sm">{{ session('error') }}</div>
                        </div>
                        <button type="button" class="w-6 h-6 rounded-full hover:bg-rose-50 flex items-center justify-center text-rose-500 hover:text-rose-700 transition-colors" onclick="this.parentElement.parentElement.remove()">
                            <i class="bi bi-x text-sm"></i>
                        </button>
                    </div>
                </div>
            @endif
            
            <!-- Page Content -->
            @yield('content')
        </div>
    </main>

    <!-- Footer - Lebih Minimalis -->
    <footer class="border-t border-primary-200/30 mt-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center py-6">
                <div class="flex items-center space-x-2 mb-3">
                    <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-accent-500 to-accent-600 flex items-center justify-center">
                        <i class="bi bi-check2-square text-white text-xs"></i>
                    </div>
                    <div class="text-primary-700 font-medium text-sm">Kerjain</div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Mobile menu toggle with animation
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('animate-slide-down');
            
            // Toggle icon
            const icon = this.querySelector('i');
            if (icon.classList.contains('bi-three-dots-vertical')) {
                icon.classList.remove('bi-three-dots-vertical');
                icon.classList.add('bi-x');
            } else {
                icon.classList.remove('bi-x');
                icon.classList.add('bi-three-dots-vertical');
            }
        });

        // Close mobile menu when clicking a link
        document.querySelectorAll('#mobile-menu a, #mobile-menu button').forEach(element => {
            element.addEventListener('click', () => {
                document.getElementById('mobile-menu').classList.add('hidden');
                const menuButton = document.getElementById('mobile-menu-button');
                const icon = menuButton.querySelector('i');
                icon.classList.remove('bi-x');
                icon.classList.add('bi-three-dots-vertical');
            });
        });

        // PWA Service Worker
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('{{ asset('serviceworker.js') }}')
                    .then(function(registration) {
                        console.log('ServiceWorker registered successfully');
                    }, function(err) {
                        console.log('ServiceWorker registration failed: ', err);
                    });
            });
        }

        // Smooth scroll to top
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Add active class to current page in navigation
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('nav a');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
            
            // Add hover effect to all interactive elements
            const interactiveElements = document.querySelectorAll('a, button, [role="button"]');
            interactiveElements.forEach(el => {
                el.classList.add('transition-colors', 'duration-150');
            });
        });

        Auto-hide flash messages after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('[class*="bg-emerald-100"], [class*="bg-rose-100"]').forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
    </script>
    
    @stack('scripts')
</body>
</html>