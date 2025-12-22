@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-md">
        <!-- Verification Card -->
        <div class="glass rounded-2xl shadow-elegant overflow-hidden border border-gray-200/30">
            <!-- Header -->
            <div class="p-8 text-center">
                <div class="relative mb-6">
                    <div class="w-16 h-16 mx-auto rounded-lg bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center mb-4 shadow-soft">
                        <i class="bi bi-envelope-check text-white text-xl"></i>
                    </div>
                </div>
                <h1 class="text-xl font-semibold text-gray-900 mb-2">
                    Verify Your Email
                </h1>
                <p class="text-gray-600 text-sm">
                    We've sent a verification link to your email address
                </p>
            </div>
            
            <!-- Body -->
            <div class="p-6">
                @if (session('resent'))
                    <div class="mb-6 p-3 glass rounded-lg border border-emerald-200/50 shadow-soft">
                        <div class="flex items-center">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center mr-3">
                                <i class="bi bi-check-lg text-emerald-600 text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-emerald-800 font-medium text-sm">{{ __('A fresh verification link has been sent to your email address.') }}</div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="mb-6">
                    <!-- Instruction Box -->
                    <div class="glass rounded-lg p-4 mb-4 border border-gray-200/30">
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-accent-500/10 to-accent-600/10 flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="bi bi-envelope text-accent-600 text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-800 mb-1 text-sm">Check Your Inbox</h3>
                                <p class="text-gray-600 text-xs">
                                    {{ __('Before proceeding, please check your email for a verification link.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Resend Form -->
                    <div class="mb-6">
                        <p class="text-gray-600 text-center mb-3 text-sm">
                            {{ __('If you did not receive the email') }}
                        </p>
                        
                        <form method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="w-full py-2.5 px-4 bg-gradient-to-r from-accent-500 to-accent-600 text-white font-medium rounded-lg hover:from-accent-600 hover:to-accent-700 shadow-soft hover:shadow-elegant hover-lift transition-all text-sm flex items-center justify-center">
                                <i class="bi bi-envelope-plus mr-1.5 text-xs"></i>
                                {{ __('Resend Verification Email') }}
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Additional Actions -->
                <div class="pt-4 border-t border-gray-200/30">
                    <!-- Spam Folder Tip -->
                    <div class="mb-4 p-3 glass rounded-lg flex items-center">
                        <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-amber-500/10 to-amber-600/10 flex items-center justify-center mr-2">
                            <i class="bi bi-exclamation-triangle text-amber-600 text-xs"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">
                                <span class="font-medium">Tip:</span> Check your spam folder if you can't find the email
                            </p>
                        </div>
                    </div>
                    
                    <!-- Back to Home -->
                    <a href="{{ route('home') }}" class="block w-full py-2.5 px-4 glass border border-gray-200/50 text-gray-700 font-medium rounded-lg hover:bg-gray-50/50 hover-lift transition-all flex items-center justify-center text-sm">
                        <i class="bi bi-house mr-1.5 text-xs"></i>Back to Home
                    </a>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="bg-gray-50/30 p-4 border-t border-gray-200/30">
                <div class="flex items-center justify-center space-x-2 text-gray-600 text-xs">
                    <i class="bi bi-clock"></i>
                    <span>Links expire in 24 hours</span>
                </div>
            </div>
        </div>
        
        <!-- Support Information -->
        <div class="mt-6 text-center">
            <div class="glass rounded-lg p-4 border border-gray-200/30">
                <p class="text-gray-600 text-xs mb-1">Need assistance with verification?</p>
                <a href="#" class="text-accent-600 hover:text-accent-700 font-medium text-sm inline-flex items-center">
                    <i class="bi bi-headset mr-1.5 text-xs"></i>Contact Support
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add entrance animation to elements
        const elements = document.querySelectorAll('.glass');
        elements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(5px)';
            
            setTimeout(() => {
                el.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 50 + (index * 30));
        });
    });
</script>
@endsection