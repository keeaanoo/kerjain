@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-md">
        <!-- Registration Card -->
        <div class="glass rounded-2xl shadow-elegant overflow-hidden border border-gray-200/30">
            <!-- Header -->
            <div class="p-8 text-center">
                <div class="w-16 h-16 mx-auto rounded-lg bg-gradient-to-br from-accent-500 to-accent-600 flex items-center justify-center mb-4 shadow-soft">
                    <i class="bi bi-person-plus text-white text-xl"></i>
                </div>
                <h1 class="text-xl font-semibold text-gray-900 mb-2">
                    Create Account
                </h1>
                <p class="text-gray-600 text-sm">
                    Join Kerjain to organize your tasks
                </p>
            </div>
            
            <!-- Form -->
            <div class="p-6">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name Field -->
                    <div class="mb-4">
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-gray-500/10 to-gray-600/10 flex items-center justify-center mr-2">
                                <i class="bi bi-person text-gray-600 text-xs"></i>
                            </div>
                            <label for="name" class="text-xs font-medium text-gray-700">
                                Full Name
                            </label>
                        </div>
                        <input id="name" type="text" 
                               class="w-full px-3 py-2.5 bg-white/50 border border-gray-200/50 rounded-lg focus:outline-none focus:ring-1 focus:ring-accent-500/30 focus:border-accent-500/50 transition-all text-sm @error('name') border-rose-500 focus:ring-rose-500/30 focus:border-rose-500 @enderror" 
                               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                               placeholder="John Doe">
                        @error('name')
                            <div class="mt-1.5 px-2 py-1.5 bg-rose-50 border-l-2 border-rose-500 rounded-r flex items-center">
                                <i class="bi bi-exclamation-circle text-rose-500 mr-1.5 text-xs"></i>
                                <span class="text-xs text-rose-700">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="mb-4">
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-accent-500/10 to-accent-600/10 flex items-center justify-center mr-2">
                                <i class="bi bi-envelope text-accent-600 text-xs"></i>
                            </div>
                            <label for="email" class="text-xs font-medium text-gray-700">
                                Email Address
                            </label>
                        </div>
                        <input id="email" type="email" 
                               class="w-full px-3 py-2.5 bg-white/50 border border-gray-200/50 rounded-lg focus:outline-none focus:ring-1 focus:ring-accent-500/30 focus:border-accent-500/50 transition-all text-sm @error('email') border-rose-500 focus:ring-rose-500/30 focus:border-rose-500 @enderror" 
                               name="email" value="{{ old('email') }}" required autocomplete="email"
                               placeholder="john@example.com">
                        @error('email')
                            <div class="mt-1.5 px-2 py-1.5 bg-rose-50 border-l-2 border-rose-500 rounded-r flex items-center">
                                <i class="bi bi-exclamation-circle text-rose-500 mr-1.5 text-xs"></i>
                                <span class="text-xs text-rose-700">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-4">
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-emerald-500/10 to-emerald-600/10 flex items-center justify-center mr-2">
                                <i class="bi bi-lock text-emerald-600 text-xs"></i>
                            </div>
                            <label for="password" class="text-xs font-medium text-gray-700">
                                Password
                            </label>
                        </div>
                        <input id="password" type="password" 
                               class="w-full px-3 py-2.5 bg-white/50 border border-gray-200/50 rounded-lg focus:outline-none focus:ring-1 focus:ring-accent-500/30 focus:border-accent-500/50 transition-all text-sm @error('password') border-rose-500 focus:ring-rose-500/30 focus:border-rose-500 @enderror" 
                               name="password" required autocomplete="new-password"
                               placeholder="••••••••">
                        @error('password')
                            <div class="mt-1.5 px-2 py-1.5 bg-rose-50 border-l-2 border-rose-500 rounded-r flex items-center">
                                <i class="bi bi-exclamation-circle text-rose-500 mr-1.5 text-xs"></i>
                                <span class="text-xs text-rose-700">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-6">
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-emerald-500/10 to-emerald-600/10 flex items-center justify-center mr-2">
                                <i class="bi bi-lock-fill text-emerald-600 text-xs"></i>
                            </div>
                            <label for="password-confirm" class="text-xs font-medium text-gray-700">
                                Confirm Password
                            </label>
                        </div>
                        <input id="password-confirm" type="password" 
                               class="w-full px-3 py-2.5 bg-white/50 border border-gray-200/50 rounded-lg focus:outline-none focus:ring-1 focus:ring-accent-500/30 focus:border-accent-500/50 transition-all text-sm" 
                               name="password_confirmation" required autocomplete="new-password"
                               placeholder="••••••••">
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-4">
                        <button type="submit" class="w-full py-2.5 px-4 bg-gradient-to-r from-accent-500 to-accent-600 text-white font-medium rounded-lg hover:from-accent-600 hover:to-accent-700 shadow-soft hover:shadow-elegant hover-lift transition-all text-sm flex items-center justify-center">
                            <i class="bi bi-person-plus mr-1.5 text-xs"></i>
                            Create Account
                        </button>
                    </div>
                    
                    <!-- Login Link -->
                    <div class="text-center pt-4 border-t border-gray-200/30">
                        <p class="text-gray-600 text-xs">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="text-accent-600 hover:text-accent-700 font-medium ml-1 inline-flex items-center">
                                Sign in here
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password strength indicator
        const passwordInput = document.getElementById('password');
        const requirements = {
            length: { element: null, regex: /.{8,}/ },
            letter: { element: null, regex: /[a-zA-Z]/ },
            number: { element: null, regex: /\d/ },
        };
        
        // Setup requirement indicators
        Object.keys(requirements).forEach((key, index) => {
            const requirementElements = document.querySelectorAll('.flex.items-center.text-gray-600.text-xs');
            if (requirementElements[index]) {
                requirements[key].element = requirementElements[index].querySelector('i');
            }
        });
        
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                
                Object.keys(requirements).forEach(key => {
                    if (requirements[key].element && requirements[key].regex.test(password)) {
                        requirements[key].element.classList.remove('text-gray-400');
                        requirements[key].element.classList.add('text-emerald-500');
                    } else if (requirements[key].element) {
                        requirements[key].element.classList.remove('text-emerald-500');
                        requirements[key].element.classList.add('text-gray-400');
                    }
                });
            });
        }
        
        // Form validation animation
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input');
        
        inputs.forEach(input => {
            input.addEventListener('invalid', function(e) {
                e.preventDefault();
                this.classList.add('animate-shake');
                setTimeout(() => {
                    this.classList.remove('animate-shake');
                }, 500);
            });
        });
    });
</script>
@endsection