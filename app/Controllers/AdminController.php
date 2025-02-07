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
        $user = new User();
        $currentUser = $user->findById($_SESSION['user_id']);
        return isset($currentUser['role']) && $currentUser['role'] === 'admin';
    }

    public function dashboard()
    {
        $user = new User();
        $totalUsers = $user->count();
        $recentUsers = $user->findRecent(5);
        
        return $this->view('admin/dashboard', [
            'totalUsers' => $totalUsers,
            'recentUsers' => $recentUsers
        ]);
    }

    public function users()
    {
        $user = new User();
        $users = $user->findAll();
        
        return $this->view('admin/users/index', [
            'users' => $users
        ]);
    }

    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'role' => $_POST['role']
            ];
            
            if ($user->create($data)) {
                $_SESSION['success'] = 'User created successfully';
                header('Location: /admin/users');
                exit;
            }
            
            $_SESSION['error'] = 'Error creating user';
        }
        
        return $this->view('admin/users/create');
    }

    public function editUser($id)
    {
        $user = new User();
        $userData = $user->findById($id);
        
        if (!$userData) {
            header('Location: /admin/users');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'role' => $_POST['role']
            ];
            
            if (!empty($_POST['password'])) {
                $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }
            
            if ($user->update($id, $data)) {
                $_SESSION['success'] = 'User updated successfully';
                header('Location: /admin/users');
                exit;
            }
            
            $_SESSION['error'] = 'Error updating user';
        }
        
        return $this->view('admin/users/edit', ['user' => $userData]);
    }

    public function deleteUser($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            if ($user->delete($id)) {
                $_SESSION['success'] = 'User deleted successfully';
            } else {
                $_SESSION['error'] = 'Error deleting user';
            }
        }
        
        header('Location: /admin/users');
        exit;
    }
}
