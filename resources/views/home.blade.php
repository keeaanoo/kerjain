@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
        <!-- Welcome Card -->
        <div class="glass rounded-2xl shadow-elegant overflow-hidden mb-8 animate-fade-in border border-gray-200/30">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200/30">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <p class="text-gray-600 text-sm">Welcome to your productivity hub</p>
                    </div>
                    <div class="glass rounded-lg px-3 py-1.5 inline-flex items-center border border-gray-200/30">
                        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-accent-500 to-accent-600 flex items-center justify-center text-white text-xs font-medium mr-2">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="font-medium text-gray-800 text-sm">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Content -->
            <div class="p-6">
                <!-- Flash Message -->
                @if (session('status'))
                    <div class="mb-6 p-3 glass rounded-lg border border-emerald-200/50 shadow-soft">
                        <div class="flex items-center">
                            <div class="w-7 h-7 rounded-full bg-emerald-100 flex items-center justify-center mr-3">
                                <i class="bi bi-check-lg text-emerald-600 text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-emerald-800 font-medium text-sm">{{ session('status') }}</div>
                            </div>
                            <button type="button" onclick="this.parentElement.parentElement.remove()" class="w-6 h-6 rounded-full hover:bg-emerald-50 flex items-center justify-center text-emerald-500 hover:text-emerald-700 transition-colors">
                                <i class="bi bi-x text-sm"></i>
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Hero Section -->
                <div class="text-center py-4">
                    <div class="mb-6">
                        <div class="w-16 h-16 mx-auto rounded-lg bg-gradient-to-br from-gray-500/10 to-accent-500/10 flex items-center justify-center mb-4">
                            <i class="bi bi-check2-square text-gray-600 text-2xl"></i>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-900 mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h2>
                        <p class="text-gray-600 text-sm max-w-md mx-auto">
                            You're successfully logged in and ready to manage your tasks.
                        </p>
                    </div>
                    
                    <!-- Quick Actions Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-6">
                        <a href="{{ route('todos.index') }}" class="group">
                            <div class="glass rounded-xl p-4 text-center hover-lift border border-gray-200/30 hover:border-accent-300/50 transition-all">
                                <div class="w-12 h-12 mx-auto rounded-lg bg-gradient-to-br from-gray-500/10 to-gray-600/10 group-hover:from-gray-500/20 group-hover:to-gray-600/20 flex items-center justify-center mb-3">
                                    <i class="bi bi-house text-gray-600 text-xl"></i>
                                </div>
                                <h3 class="font-medium text-gray-800 mb-0.5 text-sm">My Todos</h3>
                                <p class="text-gray-500 text-xs">View and manage tasks</p>
                                <div class="mt-3 text-accent-600 text-xs font-medium flex items-center justify-center">
                                    <span>Go to todos</span>
                                </div>
                            </div>
                        </a>
                        
                        <a href="{{ route('todos.create') }}" class="group">
                            <div class="glass rounded-xl p-4 text-center hover-lift border border-gray-200/30 hover:border-accent-300/50 transition-all">
                                <div class="w-12 h-12 mx-auto rounded-lg bg-gradient-to-br from-accent-500/10 to-accent-600/10 group-hover:from-accent-500/20 group-hover:to-accent-600/20 flex items-center justify-center mb-3">
                                    <i class="bi bi-plus-circle text-accent-600 text-xl"></i>
                                </div>
                                <h3 class="font-medium text-gray-800 mb-0.5 text-sm">Add New</h3>
                                <p class="text-gray-500 text-xs">Create a new task</p>
                                <div class="mt-3 text-accent-600 text-xs font-medium flex items-center justify-center">
                                    <span>Create task</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Primary Actions -->
                    <div class="flex flex-col sm:flex-row gap-2 justify-center">
                        <a href="{{ route('todos.index') }}" class="px-4 py-2.5 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white font-medium hover:from-accent-600 hover:to-accent-700 shadow-soft hover:shadow-elegant hover-lift transition-all inline-flex items-center justify-center text-sm">
                            <i class="bi bi-house mr-1.5 text-xs"></i>Go to Dashboard
                        </a>
                        
                        <a href="{{ route('todos.create') }}" class="px-4 py-2.5 rounded-lg glass border border-gray-200/50 text-gray-700 font-medium hover:bg-gray-50/50 hover-lift transition-all inline-flex items-center justify-center text-sm">
                            <i class="bi bi-plus-circle mr-1.5 text-xs"></i>Create New Todo
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="bg-gray-50/30 p-4 border-t border-gray-200/30">
                <div class="text-center">
                    <div class="inline-flex items-center flex-wrap justify-center gap-1.5 text-gray-600 text-xs">
                        <span class="inline-flex items-center">
                            <i class="bi bi-clock mr-1 text-xs"></i>
                            <span>Logged in at {{ now()->format('g:i A') }}</span>
                        </span>
                        <span class="hidden sm:inline">•</span>
                        <span>{{ now()->format('M j, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Stats Overview -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <div class="glass rounded-xl p-4 text-center border border-gray-200/30">
                <div class="text-lg font-semibold text-gray-900 mb-0.5">0</div>
                <div class="text-gray-500 text-xs">Pending</div>
            </div>
            <div class="glass rounded-xl p-4 text-center border border-gray-200/30">
                <div class="text-lg font-semibold text-gray-900 mb-0.5">0</div>
                <div class="text-gray-500 text-xs">In Progress</div>
            </div>
            <div class="glass rounded-xl p-4 text-center border border-gray-200/30">
                <div class="text-lg font-semibold text-gray-900 mb-0.5">0</div>
                <div class="text-gray-500 text-xs">Completed</div>
            </div>
            <div class="glass rounded-xl p-4 text-center border border-gray-200/30">
                <div class="text-lg font-semibold text-gray-900 mb-0.5">0</div>
                <div class="text-gray-500 text-xs">Total</div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom styles for the home page */
    .hover-lift {
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-2px);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add entrance animation to stats
        const stats = document.querySelectorAll('.glass');
        stats.forEach((stat, index) => {
            stat.style.opacity = '0';
            stat.style.transform = 'translateY(5px)';
            
            setTimeout(() => {
                stat.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
                stat.style.opacity = '1';
                stat.style.transform = 'translateY(0)';
            }, 50 + (index * 30));
        });
    });
</script>
@endsection