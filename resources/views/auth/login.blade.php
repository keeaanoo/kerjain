@extends('layouts.app')

@section('content')
<!-- AUTHENTICATION: Login form for user authentication -->
<div class="min-h-screen flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-md">
        <!-- Login Card -->
        <div class="glass rounded-2xl shadow-elegant overflow-hidden border border-gray-200/30">
            <!-- Header -->
            <div class="p-8 text-center">
                <div class="w-16 h-16 mx-auto rounded-lg bg-gradient-to-br from-accent-500 to-accent-600 flex items-center justify-center mb-4 shadow-soft">
                    <i class="bi bi-box-arrow-in-right text-white text-xl"></i>
                </div>
                <h1 class="text-xl font-semibold text-gray-900 mb-2">
                    Welcome Back
                </h1>
                <p class="text-gray-600 text-sm">
                    Sign in to continue to Kerjain
                </p>
            </div>
            
            <!-- Form -->
            <div class="p-6">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

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
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
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
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-emerald-500/10 to-emerald-600/10 flex items-center justify-center mr-2">
                                    <i class="bi bi-lock text-emerald-600 text-xs"></i>
                                </div>
                                <label for="password" class="text-xs font-medium text-gray-700">
                                    Password
                                </label>
                            </div>
                            
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs text-accent-600 hover:text-accent-700 font-medium flex items-center">
                                    <i class="bi bi-key mr-1 text-xs"></i>Forgot?
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password" 
                               class="w-full px-3 py-2.5 bg-white/50 border border-gray-200/50 rounded-lg focus:outline-none focus:ring-1 focus:ring-accent-500/30 focus:border-accent-500/50 transition-all text-sm @error('password') border-rose-500 focus:ring-rose-500/30 focus:border-rose-500 @enderror" 
                               name="password" required autocomplete="current-password"
                               placeholder="••••••••">
                        @error('password')
                            <div class="mt-1.5 px-2 py-1.5 bg-rose-50 border-l-2 border-rose-500 rounded-r flex items-center">
                                <i class="bi bi-exclamation-circle text-rose-500 mr-1.5 text-xs"></i>
                                <span class="text-xs text-rose-700">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-6">
                        <div class="flex items-center">
                            <div class="relative">
                                <input class="sr-only peer" 
                                       type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember" class="flex items-center cursor-pointer">
                                    <div class="w-4 h-4 border border-gray-300 rounded flex items-center justify-center peer-checked:bg-accent-500 peer-checked:border-accent-500 transition-colors mr-2">
                                        <i class="bi bi-check text-white text-xs opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                    </div>
                                    <span class="text-gray-700 text-xs">
                                        Remember me on this device
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-4">
                        <button type="submit" class="w-full py-2.5 px-4 bg-gradient-to-r from-accent-500 to-accent-600 text-white font-medium rounded-lg hover:from-accent-600 hover:to-accent-700 shadow-soft hover:shadow-elegant hover-lift transition-all text-sm flex items-center justify-center">
                            <i class="bi bi-box-arrow-in-right mr-1.5 text-xs"></i>Sign In
                        </button>
                    </div>
                    
                    <!-- Register Link -->
                    <div class="text-center pt-4 border-t border-gray-200/30">
                        <p class="text-gray-600 text-xs">
                            New to Kerjain? 
                            <a href="{{ route('register') }}" class="text-accent-600 hover:text-accent-700 font-medium ml-1 inline-flex items-center">
                                Create an account
                                <i class="bi bi-arrow-right ml-1 text-xs"></i>
                            </a>
                        </p>
                    </div>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="bg-gray-50/30 p-4 border-gray-200/30">
                <div class="flex items-center justify-center space-x-2 text-gray-600 text-xs">
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    /* Custom checkbox styling */
    input[type="checkbox"]:checked + label > div {
        animation: checkmark 0.15s ease;
    }
    
    @keyframes checkmark {
        0% { transform: scale(0.8); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    /* Shake animation for invalid inputs */
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-2px); }
        20%, 40%, 60%, 80% { transform: translateX(2px); }
    }
    
    .animate-shake {
        animation: shake 0.5s ease-in-out;
    }
</style>

<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     // Demo credentials auto-fill
    //     const demoCredentials = document.querySelector('.glass:last-child');
    //     const emailInput = document.getElementById('email');
    //     const passwordInput = document.getElementById('password');
        
    //     if (demoCredentials && emailInput && passwordInput) {
    //         demoCredentials.addEventListener('click', function() {
    //             emailInput.value = 'user@example.com';
    //             passwordInput.value = 'password';
                
    //             // Add visual feedback
    //             demoCredentials.classList.add('bg-accent-50/30', 'border-accent-200');
    //             setTimeout(() => {
    //                 demoCredentials.classList.remove('bg-accent-50/30', 'border-accent-200');
    //             }, 1000);
    //         });
    //     }
        
        // Add focus animation to inputs
        const inputs = document.querySelectorAll('input[type="email"], input[type="password"], input[type="text"]');
        
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });
    });
</script>
@endsection