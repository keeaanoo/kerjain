@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
        <!-- Back Navigation -->
        <div class="mb-4">
            <a href="{{ route('todos.index') }}" class="inline-flex items-center px-3 py-2 glass border border-gray-200/50 text-gray-700 font-medium rounded-lg hover:bg-gray-50/50 hover-lift transition-all text-sm">
                <i class="bi bi-arrow-left mr-1.5 text-xs"></i>Back to List
            </a>
        </div>
        
        <!-- Main Card -->
        <div class="glass rounded-xl overflow-hidden shadow-elegant border border-gray-200/30">
            <div class="p-4 border-b border-gray-200/30">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3">
                    <div class="flex-1">
                        <h1 class="text-lg font-semibold text-gray-900 mb-2 {{ $todo->completed ? 'line-through text-gray-500' : '' }}">
                            {{ $todo->title }}
                        </h1>
                        <div class="flex flex-wrap gap-2 items-center">
                            @if($todo->completed)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                <i class="bi bi-check-circle mr-1 text-xs"></i>Completed
                            </span>
                            @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                <i class="bi bi-clock mr-1 text-xs"></i>Pending
                            </span>
                            @endif
                            <span class="text-gray-500 text-xs flex items-center">
                                <i class="bi bi-calendar mr-1 text-xs"></i>
                                Created {{ $todo->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="flex space-x-1 mt-2 md:mt-0">
                        <a href="{{ route('todos.edit', $todo) }}" class="inline-flex items-center px-3 py-1.5 glass border border-gray-200/50 text-accent-600 font-medium rounded-lg hover:bg-gray-50/50 hover-lift transition-all text-sm">
                            <i class="bi bi-pencil mr-1.5 text-xs"></i>Edit
                        </a>
                        <button type="button" onclick="openDeleteModal()" class="inline-flex items-center px-3 py-1.5 text-rose-700 font-medium rounded-lg border border-rose-300 hover:from-rose-200 hover:to-rose-300 hover-lift transition-all text-sm">
                            <i class="bi bi-trash mr-1.5 text-xs"></i>Delete
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="p-4">
                <!-- Description -->
                @if($todo->description)
                <div class="mb-6">
                    <h3 class="text-xs font-medium text-gray-700 mb-2 flex items-center">
                        <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-accent-500/10 to-accent-600/10 flex items-center justify-center mr-2">
                            <i class="bi bi-text-paragraph text-accent-600 text-xs"></i>
                        </div>
                        Description
                    </h3>
                    <div class="p-3 glass rounded-lg border border-gray-200/30 {{ $todo->completed ? 'line-through text-gray-500' : '' }} text-sm">
                        {{ $todo->description }}
                    </div>
                </div>
                @endif
                
                <!-- Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <!-- Due Date Card -->
                    <div class="glass rounded-lg border border-gray-200/30 p-3">
                        <h3 class="text-xs font-medium text-gray-700 mb-2 flex items-center">
                            <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-amber-500/10 to-amber-600/10 flex items-center justify-center mr-2">
                                <i class="bi bi-calendar text-amber-600 text-xs"></i>
                            </div>
                            Due Date
                        </h3>
                        @if($todo->due_date)
                        <div>
                            <p class="text-sm font-semibold text-gray-900 mb-0.5 {{ $todo->completed ? 'line-through text-gray-500' : '' }}">
                                {{ \Carbon\Carbon::parse($todo->due_date)->format('M d, Y') }}
                            </p>
                            <div class="text-xs text-gray-600">
                                @if(\Carbon\Carbon::parse($todo->due_date)->lt(now()) && !$todo->completed)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">
                                    <i class="bi bi-exclamation-triangle mr-1 text-xs"></i>Overdue
                                </span>
                                @else
                                @if(!$todo->completed)
                                <span class="{{ $todo->completed ? 'line-through text-gray-400' : '' }}">
                                    Due in {{ \Carbon\Carbon::parse($todo->due_date)->diffForHumans() }}
                                </span>
                                @endif
                                @endif
                            </div>
                        </div>
                        @else
                        <span class="text-gray-500 text-sm">No due date set</span>
                        @endif
                    </div>
                    
                    <!-- Status Card -->
                    <div class="glass rounded-lg border border-gray-200/30 p-3">
                        <h3 class="text-xs font-medium text-gray-700 mb-2 flex items-center">
                            <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-gray-500/10 to-gray-600/10 flex items-center justify-center mr-2">
                                <i class="bi bi-info-circle text-gray-600 text-xs"></i>
                            </div>
                            Status
                        </h3>
                        <div class="mb-2">
                            @if($todo->completed)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-gradient-to-r from-emerald-100 to-emerald-200 text-emerald-800 font-medium border border-emerald-300 text-xs">
                                <i class="bi bi-check-circle mr-1.5 text-xs"></i>Completed
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-gradient-to-r from-amber-100 to-amber-200 text-amber-800 font-medium border border-amber-300 text-xs">
                                <i class="bi bi-clock mr-1.5 text-xs"></i>Pending
                            </span>
                            @endif
                        </div>
                        <p class="text-xs text-gray-600">
                            @if($todo->completed)
                            Task was completed successfully
                            @else
                            Task is awaiting completion
                            @endif
                        </p>
                    </div>
                </div>
                
                <!-- Timeline Card -->
                <div class="glass rounded-lg border border-gray-200/30 p-3 mb-6">
                    <h3 class="text-xs font-medium text-gray-700 mb-3 flex items-center">
                        <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-violet-500/10 to-violet-600/10 flex items-center justify-center mr-2">
                            <i class="bi bi-clock-history text-violet-600 text-xs"></i>
                        </div>
                        Timeline
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Created</p>
                            <div class="flex items-center text-gray-700 text-sm">
                                <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-accent-500/10 to-accent-600/10 flex items-center justify-center mr-2">
                                    <i class="bi bi-plus-circle text-accent-600 text-xs"></i>
                                </div>
                                {{ $todo->created_at->format('M d, Y') }}
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Last Updated</p>
                            <div class="flex items-center text-gray-700 text-sm">
                                <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-blue-500/10 to-blue-600/10 flex items-center justify-center mr-2">
                                    <i class="bi bi-arrow-repeat text-blue-600 text-xs"></i>
                                </div>
                                {{ $todo->updated_at->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-2">
                    <form action="{{ route('todos.toggle', $todo) }}" method="POST" class="w-full sm:w-auto">
                        @csrf
                    </form>
                    <a href="{{ route('todos.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-3 py-2 glass border border-gray-200/50 text-gray-700 font-medium rounded-lg hover:bg-gray-50/50 hover-lift transition-all text-sm">
                        <i class="bi bi-grid-1x2 mr-1.5 text-xs"></i>All Tasks
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center p-4 z-50 hidden">
    <div class="glass rounded-xl shadow-elegant max-w-md w-full border border-gray-200/30">
        <div class="p-4 border-b border-gray-200/30">
            <h3 class="text-sm font-semibold text-gray-900">Confirm Deletion</h3>
        </div>
        <div class="p-4">
            <p class="text-gray-600 text-sm mb-3">Are you sure you want to delete this task?</p>
            <div class="glass border-l-2 border-amber-400 rounded-r-lg p-3 mb-4">
                <div class="flex items-center">
                    <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-amber-500/10 to-amber-600/10 flex items-center justify-center mr-2">
                        <i class="bi bi-exclamation-triangle text-amber-600 text-xs"></i>
                    </div>
                    <div class="flex-1">
                        <div class="text-amber-800 font-medium text-xs">This action cannot be undone.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 border-t border-gray-200/30 bg-gray-50/30 rounded-b-xl flex justify-end space-x-2">
            <button type="button" onclick="closeDeleteModal()" class="px-3 py-1.5 glass border border-gray-200/50 text-gray-700 font-medium rounded-lg hover:bg-gray-50/50 hover-lift transition-all text-sm">
                Cancel
            </button>
            <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-1.5 bg-gradient-to-r from-rose-500 to-rose-600 text-white font-medium rounded-lg hover:from-rose-600 hover:to-rose-700 shadow-soft hover:shadow-elegant hover-lift transition-all text-sm">
                    Delete Task
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openDeleteModal() {
    document.getElementById('deleteModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Add keyboard shortcut for modal
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('deleteModal').classList.contains('hidden')) {
        closeDeleteModal();
    }
});
</script>
@endpush
@endsection