<?php 


class Middleware {


    
    public function handle($url) {

       
        $allowedRoutes = [
            '/Facegram/login',
            '/Facegram/register',
            '/Facegram/login/post'
        ];

        $adminRoutes = [
            '/Facegram/admin',
            '/Facegram/admin/profile',
            '/Facegram/admin/users',
            '/Facegram/admin/users/create',
            '/Facegram/admin/users/delete',
            '/Facegram/admin/user/update',
            '/Facegram/admin/user/update/info',
            '/Facegram/admin/user/update/image',
            '/Facegram/logout'
        ];

        $userRoutes = [
            '/Facegram/user',
            '/Facegram/user/profile',
            '/Facegram/logout'
        ];

      
       
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $users = UserModel::getUsersById($id);
    $userRole = $users['types'];
   



    if ($userRole === 'admin' && !in_array($url, $adminRoutes)) {
        $this->redirect('/Facegram/admin/users');
    } elseif ($userRole === 'user' && !in_array($url, $userRoutes)) {
        $this->redirect('/Facegram/user');
    }

    } else {
        
        if (!in_array($url, $allowedRoutes)) {
            $this->redirect('/Facegram/login');
        }
    }
    }

    private function redirect($url) {
        header("Location: $url");
        exit();
    }

}