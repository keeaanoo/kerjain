<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerjain - Todo List App</title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Configuration for Elegant Design -->
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
                    },
                    borderRadius: {
                        'xl': '0.75rem',
                        '2xl': '1rem',
                        '3xl': '1.25rem',
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.3s ease-out',
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(8px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-5px)' },
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        /* Smooth transitions */
        * {
            transition: all 0.2s ease;
        }
        
        /* Glass morphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }
        
        /* Hover lift effect */
        .hover-lift:hover {
            transform: translateY(-1px);
        }
        
        /* Selection color */
        ::selection {
            background-color: rgba(14, 165, 233, 0.15);
            color: #171717;
        }
        
        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
    
    <!-- PWA meta tags -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#171717">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
</head>
<body class="font-sans antialiased">
    <div class="w-full max-w-md mx-auto animate-fade-in">
        <div class="glass rounded-2xl shadow-elegant overflow-hidden border border-gray-200/30">
            <!-- Hero section -->
            <div class="p-8 text-center">
                <div class="animate-float mb-5">
                    <div class="w-16 h-16 mx-auto rounded-xl bg-gradient-to-br from-accent-500 to-accent-600 flex items-center justify-center shadow-soft">
                        <i class="bi bi-check2-square text-white text-2xl"></i>
                    </div>
                </div>
                <h1 class="text-2xl font-semibold text-gray-900 mb-2">
                    Kerjain
                </h1>
                <p class="text-gray-500 text-sm">
                    Organize your tasks
                </p>
            </div>
            
            <!-- Divider -->
            <div class="px-8">
                <div class="h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
            </div>
            
            <!-- Content section -->
            <div class="p-8">

                
                <!-- Action buttons -->
                <div class="space-y-2.5 mb-6">
                    @auth
                        <a href="{{ route('todos.index') }}" class="block w-full py-3 px-4 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white font-medium text-center hover:from-accent-600 hover:to-accent-700 shadow-soft hover:shadow-elegant hover-lift transition-all text-sm">
                            <i class="bi bi-house mr-2 text-xs"></i>Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full py-3 px-4 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white font-medium text-center hover:from-accent-600 hover:to-accent-700 shadow-soft hover:shadow-elegant hover-lift transition-all text-sm">
                            <i class="bi bi-box-arrow-in-right mr-2 text-xs"></i>Sign In
                        </a>
                        
                        <a href="{{ route('register') }}" class="block w-full py-3 px-4 rounded-lg glass border border-gray-200/50 text-gray-700 font-medium text-center hover:bg-gray-50/50 hover-lift transition-all text-sm">
                            <i class="bi bi-person-plus mr-2 text-xs"></i>Create Account
                        </a>
                    @endauth
                    
                    <!-- PWA Install Button -->
                    <button id="installBtn" class="hidden w-full py-3 px-4 rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-medium hover:from-emerald-600 hover:to-emerald-700 shadow-soft hover:shadow-elegant hover-lift transition-all text-sm">
                        <i class="bi bi-download mr-2 text-xs"></i>Install App
                    </button>
                </div>
                
            </div>
        </div>
    </div>

    <!-- PWA Install Script -->
    <script>
        let deferredPrompt;
        const installBtn = document.getElementById('installBtn');
        
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            installBtn.classList.remove('hidden');
            
            installBtn.addEventListener('click', async () => {
                installBtn.classList.add('hidden');
                deferredPrompt.prompt();
                const { outcome } = await deferredPrompt.userChoice;
                console.log(`User response to the install prompt: ${outcome}`);
                deferredPrompt = null;
            });
        });
        
        window.addEventListener('appinstalled', () => {
            installBtn.classList.add('hidden');
            deferredPrompt = null;
        });
        
        // Smooth entrance animation
        document.addEventListener('DOMContentLoaded', () => {
            const card = document.querySelector('.glass');
            card.style.opacity = '0';
            card.style.transform = 'translateY(10px)';
            
            setTimeout(() => {
                card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 50);
        });
    </script>
</body>
</html>