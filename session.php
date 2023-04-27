<? 

function checker(){

session_start();
include "db_conn.php";
if (isset($_SESSION['id']) && isset($_SESSION['name'])) {

    $id=$_SESSION['id'];
    
    $sql = "SELECT * FROM users WHERE id='$id' AND type= 'admin' ";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) === 1){
        header("Location: admin.php");
    }else{
        
        
        header("Location: home.php");


    }
    

   
}

}