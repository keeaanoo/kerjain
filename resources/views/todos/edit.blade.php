@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-xl font-semibold text-gray-900 mb-1 flex items-center">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-accent-500/10 to-accent-600/10 flex items-center justify-center mr-2">
                    <i class="bi bi-pencil-square text-accent-600 text-sm"></i>
                </div>
                Edit Task
            </h1>
            <p class="text-gray-600 text-sm">
                Update your todo task
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form Card -->
            <div class="lg:col-span-2">
                <div class="glass rounded-xl overflow-hidden shadow-elegant border border-gray-200/30">
                    <div class="p-6">
                        <form action="{{ route('todos.update', $todo) }}" method="POST" id="editForm">
                            @csrf
                            @method('PUT')
                            
                            <!-- Title -->
                            <div class="mb-4">
                                <div class="flex items-center mb-2">
                                    <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-gray-500/10 to-gray-600/10 flex items-center justify-center mr-2">
                                        <i class="bi bi-card-heading text-gray-600 text-xs"></i>
                                    </div>
                                    <label for="title" class="text-xs font-medium text-gray-700">
                                        Task Title *
                                    </label>
                                </div>
                                <input type="text" 
                                       class="w-full px-3 py-2.5 bg-white/50 border border-gray-200/50 rounded-lg focus:outline-none focus:ring-1 focus:ring-accent-500/30 focus:border-accent-500/50 transition-all text-sm @error('title') border-rose-500 focus:ring-rose-500/30 focus:border-rose-500 @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $todo->title) }}" 
                                       required
                                       placeholder="Enter task title">
                                @error('title')
                                    <div class="mt-1.5 px-2 py-1.5 bg-rose-50 border-l-2 border-rose-500 rounded-r flex items-center">
                                        <i class="bi bi-exclamation-circle text-rose-500 mr-1.5 text-xs"></i>
                                        <span class="text-xs text-rose-700">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            
                            <!-- Description -->
                            <div class="mb-4">
                                <div class="flex items-center mb-2">
                                    <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-accent-500/10 to-accent-600/10 flex items-center justify-center mr-2">
                                        <i class="bi bi-text-paragraph text-accent-600 text-xs"></i>
                                    </div>
                                    <label for="description" class="text-xs font-medium text-gray-700">
                                        Description
                                    </label>
                                </div>
                                <textarea class="w-full px-3 py-2.5 bg-white/50 border border-gray-200/50 rounded-lg focus:outline-none focus:ring-1 focus:ring-accent-500/30 focus:border-accent-500/50 transition-all text-sm @error('description') border-rose-500 focus:ring-rose-500/30 focus:border-rose-500 @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="3"
                                          placeholder="Add task details (optional)">{{ old('description', $todo->description) }}</textarea>
                                @error('description')
                                    <div class="mt-1.5 px-2 py-1.5 bg-rose-50 border-l-2 border-rose-500 rounded-r flex items-center">
                                        <i class="bi bi-exclamation-circle text-rose-500 mr-1.5 text-xs"></i>
                                        <span class="text-xs text-rose-700">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            
                            <!-- Due Date -->
                            <div class="mb-6">
                                <div class="flex items-center mb-2">
                                    <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-amber-500/10 to-amber-600/10 flex items-center justify-center mr-2">
                                        <i class="bi bi-calendar text-amber-600 text-xs"></i>
                                    </div>
                                    <label for="due_date" class="text-xs font-medium text-gray-700">
                                        Due Date
                                    </label>
                                </div>
                                <input type="date" 
                                       class="w-full px-3 py-2.5 bg-white/50 border border-gray-200/50 rounded-lg focus:outline-none focus:ring-1 focus:ring-accent-500/30 focus:border-accent-500/50 transition-all text-sm @error('due_date') border-rose-500 focus:ring-rose-500/30 focus:border-rose-500 @enderror" 
                                       id="due_date" 
                                       name="due_date" 
                                       value="{{ old('due_date', $todo->due_date ? \Carbon\Carbon::parse($todo->due_date)->format('Y-m-d') : '') }}"
                                       min="{{ date('Y-m-d') }}">
                                <p class="mt-1 text-xs text-gray-500">Optional - Set a deadline for this task</p>
                                @error('due_date')
                                    <div class="mt-1.5 px-2 py-1.5 bg-rose-50 border-l-2 border-rose-500 rounded-r flex items-center">
                                        <i class="bi bi-exclamation-circle text-rose-500 mr-1.5 text-xs"></i>
                                        <span class="text-xs text-rose-700">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            
                            <!-- Completed Status -->
                            <div class="mb-6">
                                <div class="flex items-center mb-2">
                                    <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-emerald-500/10 to-emerald-600/10 flex items-center justify-center mr-2">
                                        <i class="bi bi-check-circle text-emerald-600 text-xs"></i>
                                    </div>
                                    <label class="text-xs font-medium text-gray-700">
                                        Completion Status
                                    </label>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="completed" value="0" 
                                               {{ !$todo->completed ? 'checked' : '' }}
                                               class="sr-only peer">
                                        <div class="w-4 h-4 border border-gray-300 rounded-full flex items-center justify-center peer-checked:border-accent-500 peer-checked:bg-accent-500 transition-all mr-1.5">
                                            <div class="w-1.5 h-1.5 rounded-full bg-white opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                        </div>
                                        <span class="text-gray-700 text-xs">Pending</span>
                                    </label>
                                    <label class="flex items-center cursor-pointer">
                                        <input type="radio" name="completed" value="1" 
                                               {{ $todo->completed ? 'checked' : '' }}
                                               class="sr-only peer">
                                        <div class="w-4 h-4 border border-gray-300 rounded-full flex items-center justify-center peer-checked:border-emerald-500 peer-checked:bg-emerald-500 transition-all mr-1.5">
                                            <div class="w-1.5 h-1.5 rounded-full bg-white opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                        </div>
                                        <span class="text-gray-700 text-xs">Completed</span>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Form Actions -->
                            <div class="flex justify-between items-center pt-4 border-t border-gray-200/30">
                                <a href="{{ route('todos.index', $todo) }}" class="inline-flex items-center px-3 py-2 glass border border-gray-200/50 text-gray-700 font-medium rounded-lg hover:bg-gray-50/50 hover-lift transition-all text-sm">
                                    <i class="bi bi-arrow-left mr-1.5 text-xs"></i>Cancel
                                </a>
                                <div class="flex space-x-2">
                                    <button type="submit" class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-accent-500 to-accent-600 text-white font-medium rounded-lg hover:from-accent-600 hover:to-accent-700 shadow-soft hover:shadow-elegant hover-lift transition-all text-sm">
                                        <i class="bi bi-save mr-1.5 text-xs"></i>Update Task
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Task Info Sidebar -->
            <div class="lg:col-span-1 space-y-4">
                <!-- Current Task Info -->
                <div class="glass rounded-xl overflow-hidden shadow-elegant border border-gray-200/30">
                    <div class="p-4 border-b border-gray-200/30">
                        <h3 class="font-medium text-gray-800 mb-1 flex items-center text-sm">
                            <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-blue-500/10 to-blue-600/10 flex items-center justify-center mr-2">
                                <i class="bi bi-info-circle text-blue-600 text-xs"></i>
                            </div>
                            Task Info
                        </h3>
                    </div>
                    <div class="p-4 ml-2">
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500 mb-0.5">Created</p>
                                <p class="text-sm text-gray-700">{{ $todo->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-0.5">Last Updated</p>
                                <p class="text-sm text-gray-700">{{ $todo->updated_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-0.5">Status</p>
                                @if($todo->completed)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    <i class="bi bi-check-circle mr-1 text-xs"></i>Completed
                                </span>
                                @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                    <i class="bi bi-clock mr-1 text-xs"></i>Pending
                                </span>
                                @endif
                            </div>
                            @if($todo->due_date)
                            <div>
                                <p class="text-xs text-gray-500 mb-0.5">Due Date</p>
                                <p class="text-sm text-gray-700">{{ \Carbon\Carbon::parse($todo->due_date)->format('M d, Y') }}</p>
                                @if(\Carbon\Carbon::parse($todo->due_date)->lt(now()) && !$todo->completed)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-rose-100 text-rose-800 mt-1">
                                    <i class="bi bi-exclamation-triangle mr-1 text-xs"></i>Overdue
                                </span>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for description
    const descriptionInput = document.getElementById('description');
    if (descriptionInput) {
        const charCounter = document.createElement('div');
        charCounter.className = 'text-right text-xs text-gray-500 mt-1';
        charCounter.innerHTML = `${descriptionInput.value.length}/500 characters`;
        descriptionInput.parentNode.appendChild(charCounter);
        
        descriptionInput.addEventListener('input', function() {
            const length = this.value.length;
            charCounter.textContent = `${length}/500 characters`;
            
            if (length > 500) {
                charCounter.classList.remove('text-gray-500');
                charCounter.classList.add('text-rose-500');
            } else if (length > 450) {
                charCounter.classList.remove('text-gray-500', 'text-rose-500');
                charCounter.classList.add('text-amber-500');
            } else {
                charCounter.classList.remove('text-amber-500', 'text-rose-500');
                charCounter.classList.add('text-gray-500');
            }
        });
    }
    
    // Date input validation
    const dateInput = document.getElementById('due_date');
    if (dateInput) {
        dateInput.addEventListener('change', function() {
            if (this.value) {
                const selectedDate = new Date(this.value);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                
                if (selectedDate < today) {
                    this.classList.add('border-rose-500');
                    alert('Please select a future date');
                } else {
                    this.classList.remove('border-rose-500');
                    this.classList.add('border-emerald-500');
                }
            }
        });
    }
    
    // Form validation animation
    const form = document.getElementById('editForm');
    const inputs = form.querySelectorAll('input[required], textarea');
    
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

<style>
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-2px); }
    20%, 40%, 60%, 80% { transform: translateX(2px); }
}

.animate-shake {
    animation: shake 0.5s ease-in-out;
}
</style>
@endsection