<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // Check if user is admin before allowing access
        if (!isset($_SESSION['user_id']) || !$this->isAdmin()) {
            header('Location: /login');
            exit;
        }
    }

    private function isAdmin()
    {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }

    public function dashboard()
{
    // Change from instance methods to static methods
    $allUsers = User::findAll();
    $userEmail = User::getEmailById($_SESSION['user_id']);
    $userRole = User::getRoleById($_SESSION['user_id']);
    
    return $this->render('admin/dashboard', [
        'users' => $allUsers,
        'userEmail' => $userEmail,
        'userRole' => $userRole
    ]);
}

public function users()
{
    // Change this too
    $users = User::findAll();
    
    return $this->render('admin/users/index', [
        'users' => $users
    ]);
}

public function createUser()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'email' => $_POST['email'] ?? '',
            'password' => isset($_POST['password']) ? $_POST['password'] : '',
            'role' => $_POST['role'] ?? 'user'
        ];
        
        if (empty($data['email']) || empty($data['password'])) {
            $_SESSION['error'] = 'All fields are required';
            return $this->render('admin/users/create');
        }
        
        if (User::create($data)) {  // Change to static method
            $_SESSION['success'] = 'User created successfully';
            $this->redirect('/admin/dashboard');
        }
        
        $_SESSION['error'] = 'Error creating user';
    }
    
    return $this->render('admin/users/create');
}

public function editUser($id)
{
    $userData = User::findById($id);  // Change to static method
    
    if (!$userData) {
        header('Location: /admin/users');
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'role' => $_POST['role']
        ];
        
        if (!empty($_POST['password'])) {
            $data['password'] = $_POST['password'];
        }
        
        if (User::update($id, $data)) {  // Change to static method
            $_SESSION['success'] = 'User updated successfully';
            header('Location: /admin/users');
            exit;
        }
        
        $_SESSION['error'] = 'Error updating user';
    }
    
    return $this->render('admin/users/edit', ['user' => $userData]);
}

public function deleteUser($id)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (User::delete($id)) {  // Change to static method
            $_SESSION['success'] = 'User deleted successfully';
        } else {
            $_SESSION['error'] = 'Error deleting user';
        }
    }
    
    header('Location: /admin/users');
    exit;
}
}
