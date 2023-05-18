<?php 



class UserModel {

    public static function getImageById($id){

        $sql = "SELECT users.id, images.img_url 
        FROM images ,users 
        WHERE images.id_img= users.img AND users.id=$id";

        return mysqli_fetch_assoc(Database::query($sql));
    }

    public static function getImageByName($img){
        
        $sql="SELECT images.id_img FROM images WHERE img_url='$img'";
        return  mysqli_fetch_assoc(Database::query($sql));

    }

    public static function getUserByEmailAndId($email,$id){
        $sql="SELECT * FROM users WHERE email='$email' AND id !='$id'";
        return mysqli_fetch_assoc(Database::query($sql));
    }

    public static function getUsersById($id){
    
        
        $sql="SELECT * FROM users WHERE id='$id'";
        return mysqli_fetch_assoc(Database::query($sql));

    }

    public static function getUsersByEmail($email){
    
        $sql="SELECT * FROM users WHERE email='$email'";
        return mysqli_fetch_assoc(Database::query($sql));

    }

    public static function getAllUsers(){

        $sql="SELECT id,name,email,types FROM users";
        return mysqli_fetch_all(Database::query($sql),MYSQLI_ASSOC);
    }

    public static function deleteUserByEmail($email){

        $sql="DELETE FROM users WHERE email= '$email'";
        Database::query($sql);

    }

    public static function createUser($name, $email, $password, $types){


        
        $sql="INSERT INTO users(name,email,password,types) VALUES ('$name','$email','$password','$types');";
                
        Database::query($sql);

    }

    public static function updateUserPicture($img_id,$id){
        $sql="UPDATE users SET img='$img_id' WHERE id='$id'";
        Database::query($sql);
    }
    
    public static function uploadPic($img){
        
       
        $sql="INSERT INTO images(img_url) VALUES('$img')";
        Database::query($sql);
      
    }

    public static function updateUserInfo($name,$email,$id){

        $sql="UPDATE users SET name = '$name', email='$email' WHERE id= $id";
        Database::query($sql);
    }

    public static function updateUserPass($password,$id){
        $sql="UPDATE users SET password = '$password' WHERE id= $id";
        Database::query($sql);
    }

}