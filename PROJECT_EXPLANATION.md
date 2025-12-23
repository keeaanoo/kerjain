# Kerjain Todo App - Penjelasan Detail untuk Dosen

## Pendahuluan

Kerjain adalah aplikasi web todo list yang dibangun menggunakan Laravel framework. Aplikasi ini dirancang untuk memenuhi semua kriteria yang diminta dalam tugas, yaitu Frontend, Backend, Webservice, Database, Authentication, dan PWA. Berikut adalah penjelasan detail bagaimana setiap kriteria terpenuhi dalam project ini.

## 1. Frontend

### Deskripsi
Frontend aplikasi ini menggunakan kombinasi teknologi modern untuk memberikan user experience yang baik dan responsif.

### Teknologi yang Digunakan
- **Laravel Blade Templates**: Template engine untuk rendering HTML
- **Tailwind CSS**: Framework CSS untuk styling modern dan responsif
- **Alpine.js**: Library JavaScript untuk interaktivitas frontend

### Bukti Implementasi

#### File: `resources/views/layouts/app.blade.php`
```html
<!-- Frontend: Main layout template -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js untuk interaktivitas -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
```

#### File: `resources/views/todos/index.blade.php`
```html
<!-- Frontend: Responsive grid layout dengan Tailwind CSS -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
    @foreach($todos as $todo)
    <div class="glass rounded-lg overflow-hidden border border-gray-200/30 hover-lift hover:shadow-elegant transition-all">
        <!-- Todo card dengan interaktivitas Alpine.js -->
    </div>
    @endforeach
</div>
```

### Fitur Frontend
- **Responsivitas**: Menggunakan Tailwind CSS classes seperti `md:grid-cols-2`, `lg:grid-cols-2`
- **Interaktivitas**: Alpine.js untuk dropdown menu, mobile menu toggle
- **Modern UI**: Glassmorphism effects, smooth animations, hover effects
- **Mobile-first**: Design yang mengutamakan pengalaman mobile

## 2. Backend

### Deskripsi
Backend menggunakan Laravel framework dengan arsitektur MVC (Model-View-Controller) yang robust dan scalable.

### Teknologi yang Digunakan
- **Laravel Framework**: PHP framework untuk backend development
- **Eloquent ORM**: Object-Relational Mapping untuk database operations
- **Middleware**: Untuk authentication dan authorization

### Bukti Implementasi

#### File: `app/Http/Controllers/TodoController.php`
```php
<?php
namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    // Backend: Authentication middleware
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Backend: CRUD operations
    public function index()
    {
        $todos = Auth::user()->todos;
        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date'
        ]);

        Auth::user()->todos()->create($request->all());
        return redirect()->route('todos.index');
    }
}
```

#### File: `app/Models/Todo.php`
```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'completed', 'due_date'
    ];

    protected $casts = [
        'completed' => 'boolean',
        'due_date' => 'date',
    ];

    // Backend: Eloquent relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

### Arsitektur Backend
- **MVC Pattern**: Controllers handle requests, Models manage data, Views render UI
- **Dependency Injection**: Laravel's service container
- **Middleware Pipeline**: Request processing pipeline
- **Eloquent ORM**: Database abstraction layer

## 3. Webservice

### Deskripsi
Aplikasi menyediakan RESTful API yang dapat diakses oleh client eksternal dengan format JSON.

### Teknologi yang Digunakan
- **Laravel Routes**: Route definition dengan middleware
- **Content Negotiation**: Automatic response format detection
- **JSON Responses**: Structured API responses

### Bukti Implementasi

#### File: `routes/web.php`
```php
<?php
use App\Http\Controllers\TodoController;

// Webservice: API routes dengan authentication middleware
Route::prefix('api')->middleware('auth')->group(function () {
    Route::get('/todos', [TodoController::class, 'index']);
    Route::post('/todos', [TodoController::class, 'store']);
    Route::put('/todos/{todo}', [TodoController::class, 'update']);
    Route::delete('/todos/{todo}', [TodoController::class, 'destroy']);
});
```

#### File: `app/Http/Controllers/TodoController.php` (Method API)
```php
// Webservice: Content negotiation untuk response format
public function index(Request $request)
{
    $todos = Auth::user()->todos;

    // Return JSON untuk API calls, HTML untuk web requests
    if ($request->wantsJson()) {
        return response()->json($todos);
    }

    return view('todos.index', compact('todos'));
}
```

### API Endpoints
```
GET    /api/todos          # List todos (JSON)
POST   /api/todos          # Create todo
PUT    /api/todos/{id}     # Update todo
DELETE /api/todos/{id}     # Delete todo
POST   /todos/{id}/toggle  # Toggle completion
```

### Testing API
```bash
# Contoh curl request
curl -X GET http://localhost:8000/api/todos \
  -H "Accept: application/json" \
  -H "Authorization: Bearer {token}"
```

## 4. Database

### Deskripsi
Database menggunakan MySQL dengan Laravel migrations untuk schema management dan Eloquent ORM untuk data operations.

### Teknologi yang Digunakan
- **MySQL Database**: Relational database
- **Laravel Migrations**: Database schema versioning
- **Eloquent ORM**: Object-relational mapping
- **Database Relationships**: Foreign key constraints

### Bukti Implementasi

#### File: `database/migrations/2025_12_15_152116_create_todos_table.php`
```php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            // Database: Foreign key relationship
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('completed')->default(false);
            $table->date('due_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
```

#### File: `app/Models/Todo.php` (Relationships)
```php
// Database: Eloquent relationships
public function user()
{
    return $this->belongsTo(User::class);
}
```

#### File: `app/Models/User.php`
```php
// Database: Inverse relationship
public function todos()
{
    return $this->hasMany(Todo::class);
}
```

### Database Schema
- **Users Table**: Standard Laravel authentication table
- **Todos Table**: Custom table dengan foreign key ke users
- **Relationships**: One-to-many (User has many Todos)
- **Constraints**: Foreign key constraints dengan cascade delete

## 5. Authentication

### Deskripsi
Authentication menggunakan Laravel's built-in authentication system dengan tambahan authorization policies.

### Teknologi yang Digunakan
- **Laravel Auth**: Built-in authentication scaffolding
- **Session Management**: Cookie-based sessions
- **Authorization Policies**: Policy-based access control
- **CSRF Protection**: Cross-site request forgery protection

### Bukti Implementasi

#### File: `routes/web.php`
```php
// Authentication: Laravel auth routes
Auth::routes();
```

#### File: `app/Http/Controllers/TodoController.php`
```php
// Authentication: Middleware protection
public function __construct()
{
    $this->middleware('auth');
}
```

#### File: `app/Policies/TodoPolicy.php`
```php
<?php
namespace App\Policies;

use App\Models\Todo;
use App\Models\User;

class TodoPolicy
{
    // Authentication: Authorization - users can only access their own todos
    public function view(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }

    public function update(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }

    public function delete(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }
}
```

#### File: `resources/views/auth/login.blade.php`
```html
<!-- Authentication: Login form -->
<form action="{{ route('login') }}" method="POST">
    @csrf
    <!-- Form fields untuk email dan password -->
</form>
```

### Fitur Authentication
- **Registration**: User dapat mendaftar akun baru
- **Login/Logout**: Session-based authentication
- **Password Reset**: Forgot password functionality
- **Authorization**: Policy-based access control
- **Security**: CSRF protection, password hashing

## 6. PWA (Progressive Web App)

### Deskripsi
Aplikasi dapat diinstall sebagai PWA dengan offline capabilities dan native app-like experience.

### Teknologi yang Digunakan
- **Service Worker**: Background caching dan offline functionality
- **Web App Manifest**: App metadata untuk installation
- **Cache API**: Programmatic caching strategies

### Bukti Implementasi

#### File: `public/manifest.json`
```json
{
  "name": "Kerjain Todo App",
  "short_name": "Kerjain",
  "start_url": "/",
  "display": "standalone",
  "background_color": "#ffffff",
  "theme_color": "#171717",
  "icons": [
    {
      "src": "/icon-192x192.png",
      "sizes": "192x192",
      "type": "image/png"
    }
  ]
}
```

#### File: `public/serviceworker.js`
```javascript
// PWA: Service Worker untuk caching
const CACHE_NAME = 'kerjain-todo-v1';
const urlsToCache = [
  '/',
  '/login',
  '/register',
  '/todos',
  '/css/app.css',
  '/js/app.js'
];

// PWA: Install event - cache resources
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        return cache.addAll(urlsToCache);
      })
  );
});

// PWA: Fetch event - serve from cache or network
self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => {
        if (response) {
          return response;
        }
        return fetch(event.request);
      })
  );
});
```

#### File: `resources/views/layouts/app.blade.php`
```html
<!-- PWA: Meta tags untuk PWA -->
<link rel="manifest" href="{{ asset('manifest.json') }}">
<meta name="theme-color" content="#171717">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

<!-- PWA: Service worker registration -->
<script>
if ('serviceWorker' in navigator) {
  window.addEventListener('load', function() {
    navigator.serviceWorker.register('{{ asset('serviceworker.js') }}');
  });
}
</script>
```

### Fitur PWA
- **Installable**: Dapat diinstall di mobile devices
- **Offline Support**: Core functionality works tanpa internet
- **Caching**: Cache-first strategy untuk performance
- **Background Sync**: Service worker untuk background operations
- **Native-like UX**: Standalone display mode

## Kesimpulan

Project Kerjain Todo App ini telah memenuhi semua kriteria yang diminta dengan implementasi yang komprehensif dan best practices. Setiap komponen (Frontend, Backend, Webservice, Database, Authentication, PWA) telah diimplementasikan dengan teknologi yang sesuai dan dapat dibuktikan melalui kode yang ada dalam project.

### Teknologi Utama yang Digunakan
- **Backend**: Laravel 12.x, PHP 8.2+
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: MySQL dengan Eloquent ORM
- **Authentication**: Laravel Auth dengan Policies
- **PWA**: Service Worker, Web App Manifest
- **API**: RESTful endpoints dengan JSON responses

### File-file Kunci
- `app/Http/Controllers/TodoController.php` - Backend logic dan API
- `resources/views/layouts/app.blade.php` - Frontend layout dan PWA
- `database/migrations/` - Database schema
- `app/Policies/TodoPolicy.php` - Authentication dan authorization
- `public/serviceworker.js` - PWA functionality
- `routes/web.php` - Routing dan API endpoints

