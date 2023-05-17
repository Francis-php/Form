<?php 
class PostController
{
    public static function showProfile()
    {
        $id=$_SESSION['id'];
        $type=UserModel::getUsersById($id)['types'];

        if($type==='user'){
        
            require '/var/www/html/Facegram/views/user_home.php';
            
        }else{
            
            require '/var/www/html/Facegram/views/admn_home.php';
            
        }
    }
}