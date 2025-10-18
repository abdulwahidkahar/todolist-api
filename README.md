# 📝 ToDoList API

A simple and secure **To-Do List REST API** built with **Laravel**, providing authentication and CRUD operations for managing personal to-do items.  
This project demonstrates how to build a clean, modular API using **Laravel Sanctum** for authentication and resource-based controllers.

---

## 🚀 Introduction
**ToDoList API** allows users to register, authenticate, and manage their to-do tasks.  
It’s built following RESTful design principles and uses **Laravel Sanctum** for token-based authentication.

---

## ✨ Features
- 🔐 User authentication with Laravel Sanctum
- 🧾 CRUD operations for todos (Create, Read, Update, Delete)
- 🧰 Form request validation for secure input
- 🧠 JSON API responses with consistent structure
- 🧪 PHPUnit test-ready configuration

---

## 🧱 Tech Stack
- **Framework:** Laravel 11+
- **Language:** PHP 8.2+
- **Database:** MySQL / SQLite
- **Authentication:** Laravel Sanctum
- **Package Manager:** Composer
- **Frontend (optional):** Vite

---

## ⚙️ Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/abdulwahidkahar/todolist-api.git
   cd todolist-api

2. **Install dependencies**
   ```bash
   composer install

3. **Copy environment file**
   ```bash
   cp .env.example .env
   
4. **Generate application key**
    ```bash
   php artisan key:generate
   
5. **Run database migrations**
   ```bash
   php artisan migrate

6. **(Optional) Seed the database**
   ```bash
   php artisan db:seed
