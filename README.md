# Kerjain - Todo List Application

A modern, full-stack web application built with Laravel that demonstrates complete web development capabilities including frontend, backend, webservice, database, authentication, and PWA features.

## 🚀 Project Overview

Kerjain is a comprehensive todo list application that showcases modern web development practices. The application allows users to create, manage, and track their daily tasks with a beautiful, responsive interface.

## ✅ Requirements Fulfillment

This project meets all specified requirements:

### 🎨 Frontend
- **Framework**: Laravel Blade templating engine
- **Styling**: Tailwind CSS with custom design system
- **Interactivity**: Alpine.js for dynamic UI components
- **Responsiveness**: Mobile-first design with adaptive layouts
- **User Experience**: Modern glassmorphism design with smooth animations

### ⚙️ Backend
- **Framework**: Laravel 12.x (PHP 8.2+)
- **Architecture**: MVC pattern with service layer
- **Controllers**: RESTful TodoController handling CRUD operations
- **Models**: Eloquent ORM for data management
- **Middleware**: Authentication and authorization layers

### 🌐 Webservice
- **API Endpoints**: RESTful API routes with JSON responses
- **Authentication**: Protected API routes with middleware
- **Content Negotiation**: Automatic HTML/JSON response detection
- **CORS Support**: Cross-origin resource sharing enabled
- **Documentation**: Inline API documentation in routes

### 🗄️ Database
- **ORM**: Laravel Eloquent with relationships
- **Migrations**: Database schema management
- **Seeders**: Data seeding for development
- **Relationships**: User-Todo foreign key constraints
- **Data Types**: Proper casting for dates, booleans, and strings

### 🔐 Authentication
- **Laravel Auth**: Built-in authentication system
- **User Registration**: Secure signup process
- **Login/Logout**: Session-based authentication
- **Authorization**: Policy-based access control
- **Security**: CSRF protection and password hashing

### 📱 PWA (Progressive Web App)
- **Service Worker**: Offline caching and background sync
- **Web App Manifest**: Installable on mobile devices
- **Meta Tags**: PWA-specific meta tags for mobile optimization
- **Caching Strategy**: Cache-first approach for better performance
- **Offline Support**: Core functionality works without internet

## 🛠️ Technology Stack

- **Backend**: Laravel 12.x, PHP 8.2+
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: MySQL/SQLite (configurable)
- **Build Tools**: Vite, NPM
- **Testing**: PHPUnit
- **Deployment**: Railway-ready configuration

## 📁 Project Structure

```
kerjain/
├── app/
│   ├── Http/Controllers/
│   │   ├── TodoController.php      # Main CRUD controller
│   │   └── Auth/                   # Authentication controllers
│   ├── Models/
│   │   ├── Todo.php                # Todo model with relationships
│   │   └── User.php                # User model
│   └── Policies/
│       └── TodoPolicy.php          # Authorization policies
├── database/migrations/
│   ├── create_users_table.php      # Users table schema
│   └── create_todos_table.php      # Todos table schema
├── public/
│   ├── manifest.json               # PWA manifest
│   └── serviceworker.js            # PWA service worker
├── resources/views/
│   ├── layouts/app.blade.php       # Main layout with PWA tags
│   ├── auth/                       # Authentication views
│   └── todos/                      # Todo CRUD views
├── routes/
│   └── web.php                     # Routes with API endpoints
└── README.md                       # This file
```

## 🚀 Installation & Setup

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL or SQLite

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd kerjain
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed  # Optional: seed sample data
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start the application**
   ```bash
   php artisan serve
   ```

## 📱 Features

### Core Functionality
- ✅ User registration and authentication
- ✅ Create, read, update, delete todos
- ✅ Mark todos as complete/incomplete
- ✅ Due date management
- ✅ Responsive design for all devices

### Advanced Features
- 🔄 Real-time todo status updates
- 📊 Todo statistics and progress tracking
- 🎨 Modern UI with glassmorphism effects
- 📱 PWA capabilities with offline support
- 🔒 Secure authentication and authorization
- 🌐 RESTful API for external integrations

## 🔗 API Endpoints

The application provides RESTful API endpoints:

```
GET    /api/todos          # List all todos (authenticated)
POST   /api/todos          # Create new todo
GET    /api/todos/{id}     # Show specific todo
PUT    /api/todos/{id}     # Update todo
DELETE /api/todos/{id}     # Delete todo
POST   /todos/{id}/toggle  # Toggle completion status
```

## 🎯 Usage Examples

### Web Interface
1. Register/Login to access the dashboard
2. Click "New Task" to create todos
3. Use the toggle button to mark tasks complete
4. Edit or delete tasks as needed

### API Usage
```bash
# Get all todos
curl -H "Accept: application/json" \
     -H "Authorization: Bearer {token}" \
     http://localhost:8000/api/todos

# Create new todo
curl -X POST \
     -H "Content-Type: application/json" \
     -H "Authorization: Bearer {token}" \
     -d '{"title":"New Task","description":"Task description"}' \
     http://localhost:8000/api/todos
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- Laravel Framework for the robust backend foundation
- Tailwind CSS for the beautiful styling system
- Alpine.js for seamless frontend interactivity
- Laravel community for excellent documentation and support

---

**Built with ❤️ using Laravel**
