<?php 


class AccessControl{
    public function handle($url) {
        include "/var/www/html/Facegram/db/db_conn.php";
        $allowedRoutes = [
            '/Facegram/login',
            '/Facegram/register'
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
    $sql = "SELECT types FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $userRole = $row['types'];




    if ($userRole === 'admin' && !in_array($url, $adminRoutes)) {
        $this->redirect('/Facegram/admin/users');
    } elseif ($userRole === 'user' && !in_array($url, $userRoutes)) {
        $this->redirect('/Facegram/user');
    }

    } else {
        // User is not logged in
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