@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <!-- Header -->
        <div class="glass rounded-xl p-4 mb-6 shadow-elegant border border-gray-200/30">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <div>
                    <h1 class="text-lg font-semibold text-gray-900 mb-1 flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-accent-500/10 to-accent-600/10 flex items-center justify-center mr-2">
                            <i class="bi bi-grid-1x2 text-accent-600 text-sm"></i>
                        </div>
                        My Todo List
                    </h1>
                    <p class="text-gray-600 text-xs flex items-center">
                        {{ $todos->count() }} {{ Str::plural('task', $todos->count()) }} in total
                    </p>
                </div>
                <div class="mt-2 md:mt-0">
                    <a href="{{ route('todos.create') }}" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-accent-500 to-accent-600 text-white font-medium rounded-lg hover:from-accent-600 hover:to-accent-700 shadow-soft hover:shadow-elegant hover-lift transition-all text-sm">
                        <i class="bi bi-plus-circle mr-1.5 text-xs"></i>Add New Todo
                    </a>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        @if($todos->isEmpty())
        <div class="max-w-md mx-auto">
            <div class="glass rounded-xl p-6 text-center shadow-elegant border border-gray-200/30">
                <div class="w-16 h-16 mx-auto rounded-lg bg-gradient-to-br from-gray-500/10 to-accent-500/10 flex items-center justify-center mb-4">
                    <i class="bi bi-inbox text-3xl text-gray-600 opacity-50"></i>
                </div>
                <h3 class="text-base font-semibold text-gray-900 mb-2">No tasks yet</h3>
                <p class="text-gray-600 text-sm mb-4 max-w-sm mx-auto">Start organizing your day by creating your first todo</p>
                <a href="{{ route('todos.create') }}" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-accent-500 to-accent-600 text-white font-medium rounded-lg hover:from-accent-600 hover:to-accent-700 shadow-soft hover:shadow-elegant hover-lift transition-all text-sm">
                    <i class="bi bi-plus-circle mr-1.5 text-xs"></i>Create Your First Todo
                </a>
            </div>
        </div>
        @else
        <!-- Todo Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
            @foreach($todos as $todo)
            <div class="glass rounded-lg overflow-hidden border border-gray-200/30 hover-lift hover:shadow-elegant transition-all {{ $todo->completed ? 'border-l-2 border-l-emerald-400' : '' }}">
                <div class="p-4 h-full flex flex-col">
                    <!-- Header with Toggle -->
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-grow mr-2">
                            <h3 class="font-medium text-gray-900 mb-1 text-sm {{ $todo->completed ? 'line-through text-gray-500' : '' }}">
                                {{ $todo->title }}
                            </h3>
                            @if($todo->completed)
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                <i class="bi bi-check-circle mr-0.5 text-xs"></i>Completed
                            </span>
                            @endif
                        </div>
                        <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex-shrink-0 w-7 h-7 rounded-lg flex items-center justify-center {{ $todo->completed ? 'bg-emerald-200 text-emerald-600 hover:bg-emerald-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }} transition-colors" 
                                    title="{{ $todo->completed ? 'Mark as pending' : 'Mark as done' }}">
                                @if($todo->completed)
                                    <i class="bi bi-check-circle-fill text-sm"></i>
                                @else
                                    <i class="bi bi-circle text-sm"></i>
                                @endif
                            </button>
                        </form>
                    </div>
                    
                    <!-- Description -->
                    @if($todo->description)
                    <div class="mb-3 flex-grow">
                        <p class="text-gray-600 text-xs {{ $todo->completed ? 'line-through text-gray-400' : '' }}">
                            {{ Str::limit($todo->description, 100) }}
                        </p>
                    </div>
                    @endif
                    
                    <!-- Due Date -->
                    @if($todo->due_date)
                    <div class="mb-3">
                        <div class="flex items-center">
                            <div class="w-5 h-5 rounded bg-gradient-to-br from-amber-500/10 to-amber-600/10 flex items-center justify-center mr-2">
                                <i class="bi bi-calendar text-amber-600 text-xs"></i>
                            </div>
                            <span class="text-xs {{ $todo->completed ? 'line-through text-gray-400' : 'text-gray-600' }}">
                                Due {{ \Carbon\Carbon::parse($todo->due_date)->format('M d, Y') }}
                                @if(\Carbon\Carbon::parse($todo->due_date)->lt(now()) && !$todo->completed)
                                <span class="ml-1.5 inline-flex items-center px-1 py-0.5 rounded text-xs font-medium bg-rose-100 text-rose-800">
                                    <i class="bi bi-exclamation-triangle mr-0.5 text-xs"></i>Overdue
                                </span>
                                @endif
                            </span>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Footer Actions -->
                    <div class="mt-auto pt-3 border-t border-gray-200/30">
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500 flex items-center">
                                <i class="bi bi-clock mr-1 text-xs"></i>
                                {{ $todo->created_at->format('M d') }}
                            </span>
                            <div class="flex space-x-1 gap-2">
                                <a href="{{ route('todos.show', $todo) }}" class="w-6 h-6 rounded flex items-center justify-center text-gray-500 hover:text-accent-600 hover:bg-gray-50/50 transition-colors" title="View">
                                    <i class="bi bi-eye text-md rounded-md p-2 bg-gray-100"></i>
                                </a>
                                <a href="{{ route('todos.edit', $todo) }}" class="w-6 h-6 rounded flex items-center justify-center text-gray-500 hover:text-accent-600 hover:bg-gray-50/50 transition-colors" title="Edit">
                                    <i class="bi bi-pencil text-md rounded-md p-2 bg-gray-100"></i>
                                </a>
                                <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-6 h-6 rounded flex items-center justify-center text-gray-500 hover:text-rose-600 hover:bg-rose-50/50 transition-colors" 
                                            title="Delete" 
                                            onclick="return confirm('Are you sure you want to delete this task?')">
                                        <i class="bi bi-trash text-md rounded-md p-2 bg-gray-100"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- API Test Section -->
        <!-- <div class="mt-8">
            <div class="glass rounded-xl overflow-hidden shadow-elegant border border-gray-200/30">
                <div class="p-4 border-b border-gray-200/30">
                    <h5 class="font-medium text-gray-900 flex items-center text-sm">
                        <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-violet-500/10 to-violet-600/10 flex items-center justify-center mr-2">
                            <i class="bi bi-code-slash text-violet-600 text-xs"></i>
                        </div>
                        API Test
                    </h5>
                    <p class="text-gray-600 text-xs mt-1">
                        Test the Web Service API endpoints:
                    </p>
                </div>
                <div class="p-4">
                    <div class="mb-3">
                        <code class="block bg-gray-50/30 px-3 py-2 rounded-lg border border-gray-200/50 font-mono text-xs">
                            GET {{ url('/api/todos') }}
                        </code>
                        <small class="text-gray-500 text-xs">Retrieve all todos in JSON format</small>
                    </div>
                    <button id="testApi" class="inline-flex items-center px-3 py-1.5 glass border border-gray-200/50 text-accent-600 font-medium rounded-lg hover:bg-gray-50/50 hover-lift transition-all text-sm">
                        <i class="bi bi-play-circle mr-1.5 text-xs"></i>Test API
                    </button>
                    <div id="apiResult" class="mt-3 hidden">
                        <div class="glass border-l-2 border-accent-400 rounded-r-lg p-3 mb-2">
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded bg-gradient-to-br from-accent-500/10 to-accent-600/10 flex items-center justify-center mr-2">
                                    <i class="bi bi-info-circle text-accent-600 text-xs"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-accent-800 font-medium text-xs">API Response</div>
                                </div>
                            </div>
                        </div>
                        <pre class="bg-gray-50/30 p-3 rounded-lg border border-gray-200/50 overflow-x-auto max-h-60"><code id="apiData" class="font-mono text-xs"></code></pre>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>

@push('scripts')
<script>
document.getElementById('testApi').addEventListener('click', function() {
    const btn = this;
    const originalText = btn.innerHTML;
    
    btn.innerHTML = '<i class="bi bi-hourglass-split mr-1.5 text-xs"></i>Testing...';
    btn.disabled = true;
    btn.classList.add('opacity-75');
    
    fetch('/api/todos', {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('apiData').textContent = JSON.stringify(data, null, 2);
        document.getElementById('apiResult').classList.remove('hidden');
        document.getElementById('apiResult').classList.add('animate-fade-in');
        btn.innerHTML = '<i class="bi bi-check-circle mr-1.5 text-xs"></i>Test Complete';
        btn.classList.remove('glass');
        btn.classList.add('bg-emerald-100', 'text-emerald-700', 'border-emerald-300');
    })
    .catch(error => {
        document.getElementById('apiData').textContent = 'Error: ' + error;
        document.getElementById('apiResult').classList.remove('hidden');
        document.getElementById('apiResult').classList.add('animate-fade-in');
        btn.innerHTML = '<i class="bi bi-x-circle mr-1.5 text-xs"></i>Test Failed';
        btn.classList.remove('glass');
        btn.classList.add('bg-rose-100', 'text-rose-700', 'border-rose-300');
    })
    .finally(() => {
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
            btn.classList.remove('opacity-75', 'bg-emerald-100', 'text-emerald-700', 'border-emerald-300', 'bg-rose-100', 'text-rose-700', 'border-rose-300');
            btn.classList.add('glass');
        }, 3000);
    });
});
</script>
@endpush
@endsection