<?php 


class Middleware { 
    public function handle($url) 
    {

       
        $allowedRoutes = [
            '/login',
            '/register',
            '/login/post',
            '/register/submit'
            
        ];

        $adminRoutes = [
            '/admin',
            '/admin/profile',
            '/admin/users',
            '/admin/users/create',
            '/admin/users/delete',
            '/admin/user/update',
            '/admin/user/update/info',
            '/admin/user/update/image',
            '/admin/profile/updateimg',
            '/admin/profile/updateinfo',
            '/admin/profile/updatepass',
            '/logout'
        ];

        $userRoutes = [
            '/user',
            '/user/profile',
            '/user/profile/updateimg',
            '/user/profile/updateinfo',
            '/user/profile/updatepass',
            '/logout'
        ];

      
       
        if(isset($_SESSION['id'])){
            $id = $_SESSION['id'];
            $users = UserModel::getUsersById($id);
            $userRole = $users['types'];
            
            if($userRole === 'admin' && !in_array($url, $adminRoutes)){
                $this->redirect('/admin/users');

            }elseif($userRole === 'user' && !in_array($url, $userRoutes)){
                $this->redirect('/user');

            }

        }else{
        
            if (!in_array($url, $allowedRoutes)) {
                $this->redirect('/login');
            }
        }
    }
    private function redirect($url) 
    {
        header("Location: $url");
        exit();
    }

}