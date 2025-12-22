<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $todos = Auth::user()->todos()->orderBy('created_at', 'desc')->get();

        if ($request->wantsJson()) {
            return response()->json($todos);
        }

        return view('todos.index', compact('todos'));
    }
    
    public function create()
    {
        return view('todos.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date'
        ]);

        $todo = Auth::user()->todos()->create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'completed' => false
        ]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Todo berhasil ditambahkan!', 'todo' => $todo], 201);
        }

        return redirect()->route('todos.index')->with('success', 'Todo berhasil ditambahkan!');
    }
    
    public function show(Request $request, Todo $todo)
    {
        $this->authorize('view', $todo);

        if ($request->wantsJson()) {
            return response()->json($todo);
        }

        return view('todos.show', compact('todo'));
    }
    
    public function edit(Todo $todo)
    {
        $this->authorize('update', $todo);
        return view('todos.edit', compact('todo'));
    }
    
    public function update(Request $request, Todo $todo)
    {
        $this->authorize('update', $todo);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'completed' => 'boolean'
        ]);

        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'completed' => $request->has('completed') ? $request->completed : $todo->completed
        ]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Todo berhasil diperbarui!', 'todo' => $todo]);
        }

        return redirect()->route('todos.index')->with('success', 'Todo berhasil diperbarui!');
    }
    
    public function destroy(Request $request, Todo $todo)
    {
        $this->authorize('delete', $todo);
        $todo->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Todo berhasil dihapus!']);
        }

        return redirect()->route('todos.index')->with('success', 'Todo berhasil dihapus!');
    }
    
    public function toggleComplete(Request $request, Todo $todo)
    {
        $this->authorize('update', $todo);
        $todo->update(['completed' => !$todo->completed]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Status todo diperbarui!', 'todo' => $todo]);
        }

        return redirect()->route('todos.index')->with('success', 'Status todo diperbarui!');
    }
}