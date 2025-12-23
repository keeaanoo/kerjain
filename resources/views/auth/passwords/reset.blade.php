@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-md">
        <!-- Reset Password Card -->
        <div class="glass rounded-2xl shadow-elegant overflow-hidden border border-gray-200/30 animate-fade-in">
            <!-- Header -->
            <div class="p-8 text-center border-b border-gray-200/30">
                <div class="mb-4">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-gradient-to-br from-accent-500 to-accent-600 flex items-center justify-center shadow-soft">
                        <i class="bi bi-key text-white text-lg"></i>
                    </div>
                </div>
                <h1 class="text-xl font-semibold text-gray-900 mb-2">
                    Reset Password
                </h1>
                <p class="text-gray-500 text-sm">
                    Enter your new password below
                </p>
            </div>
            
            <!-- Form -->
            <div class="p-8">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email Field -->
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">
                            <i class="bi bi-envelope mr-1.5 text-xs text-accent-500"></i>
                            Email Address
                        </label>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ $email ?? old('email') }}" 
                               required 
                               autocomplete="email" 
                               autofocus
                               class="w-full px-3 py-2.5 rounded-lg glass border border-gray-300/50 focus:border-accent-500/50 focus:ring-2 focus:ring-accent-500/10 transition-all duration-200 text-sm @error('email') border-rose-300 focus:border-rose-500 focus:ring-rose-500/10 @enderror"
                               placeholder="you@example.com">
                        
                        @error('email')
                            <div class="mt-1.5 flex items-center text-rose-600 text-xs">
                                <i class="bi bi-exclamation-circle mr-1.5 text-xs"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-5">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">
                            <i class="bi bi-lock mr-1.5 text-xs text-accent-500"></i>
                            New Password
                        </label>
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required 
                               autocomplete="new-password"
                               class="w-full px-3 py-2.5 rounded-lg glass border border-gray-300/50 focus:border-accent-500/50 focus:ring-2 focus:ring-accent-500/10 transition-all duration-200 text-sm @error('password') border-rose-300 focus:border-rose-500 focus:ring-rose-500/10 @enderror"
                               placeholder="••••••••">
                        
                        @error('password')
                            <div class="mt-1.5 flex items-center text-rose-600 text-xs">
                                <i class="bi bi-exclamation-circle mr-1.5 text-xs"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-6">
                        <label for="password-confirm" class="block text-sm font-medium text-gray-700 mb-1.5">
                            <i class="bi bi-lock-fill mr-1.5 text-xs text-accent-500"></i>
                            Confirm New Password
                        </label>
                        <input id="password-confirm" 
                               type="password" 
                               name="password_confirmation" 
                               required 
                               autocomplete="new-password"
                               class="w-full px-3 py-2.5 rounded-lg glass border border-gray-300/50 focus:border-accent-500/50 focus:ring-2 focus:ring-accent-500/10 transition-all duration-200 text-sm"
                               placeholder="••••••••">
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-4">
                        <button type="submit" 
                                class="w-full py-3 px-4 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white font-medium hover:from-accent-600 hover:to-accent-700 shadow-soft hover:shadow-elegant hover-lift transition-all text-sm">
                            <i class="bi bi-arrow-clockwise mr-2 text-xs"></i>
                            Reset Password
                        </button>
                    </div>

                    <!-- Back to Login Link -->
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-accent-600 transition-colors group">
                            <i class="bi bi-arrow-left mr-1.5 text-xs group-hover:-translate-x-0.5 transition-transform"></i>
                            Back to Sign In
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="mt-6 text-center">
            <p class="text-xs text-gray-500">
                Make sure your new password is strong and different from previous passwords
            </p>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Custom focus styles for form inputs */
    input:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(14, 165, 233, 0.1);
    }
    
    /* Smooth error animation */
    .error-message {
        animation: slideDown 0.3s ease-out;
    }
</style>
@endpush

@push('scripts')
<script>
    // Password visibility toggle
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInputs = document.querySelectorAll('input[type="password"]');
        
        passwordInputs.forEach(input => {
            const wrapper = document.createElement('div');
            wrapper.className = 'relative';
            input.parentNode.insertBefore(wrapper, input);
            wrapper.appendChild(input);
            
            const toggleBtn = document.createElement('button');
            toggleBtn.type = 'button';
            toggleBtn.className = 'absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-accent-500 transition-colors';
            toggleBtn.innerHTML = '<i class="bi bi-eye text-sm"></i>';
            
            wrapper.appendChild(toggleBtn);
            
            toggleBtn.addEventListener('click', function() {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                
                const icon = this.querySelector('i');
                if (type === 'text') {
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        });
        
        // Smooth form validation feedback
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const inputs = this.querySelectorAll('input[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('border-rose-300');
                    
                    // Add error animation
                    input.style.animation = 'none';
                    setTimeout(() => {
                        input.style.animation = 'pulseSoft 0.5s ease-in-out';
                    }, 10);
                }
            });
            
            if (!isValid) {
                e.preventDefault();
            }
        });
        
        // Remove error state on input
        const errorInputs = document.querySelectorAll('input');
        errorInputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.classList.contains('border-rose-300')) {
                    this.classList.remove('border-rose-300');
                }
            });
        });
    });
</script>
@endpush
@endsection