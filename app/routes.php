<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\HomeController;
use App\Controllers\AdminController;

// Home route
$router->get('/', [HomeController::class, 'index']);

// Auth routes
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'register']);
$router->get('/logout', [AuthController::class, 'logout']);

// Dashboard routes
$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/profile', [DashboardController::class, 'profile']);
$router->post('/profile', [DashboardController::class, 'profile']);

// Article routes
$router->get('/dashboard/article/create', [DashboardController::class, 'createArticle']);
$router->post('/dashboard/article/create', [DashboardController::class, 'createArticle']);
$router->get('/dashboard/article/:id/edit', [DashboardController::class, 'editArticle']);
$router->post('/dashboard/article/:id/edit', [DashboardController::class, 'editArticle']);
$router->post('/dashboard/article/:id/delete', [DashboardController::class, 'deleteArticle']);

// Admin routes
$router->get('/admin/dashboard', [AdminController::class, 'dashboard']);
$router->get('/admin/users', [AdminController::class, 'users']);
$router->get('/admin/users/create', [AdminController::class, 'createUser']);
$router->post('/admin/users/store', [AdminController::class, 'storeUser']); // Add this for form submission
$router->get('/admin/users/edit/:id', [AdminController::class, 'editUser']); // Change to GET for showing edit form
$router->post('/admin/users/update/:id', [AdminController::class, 'updateUser']); // Add this for updating user
$router->post('/admin/users/delete/:id', [AdminController::class, 'deleteUser']);
