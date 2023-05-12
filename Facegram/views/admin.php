<?php 

include "/var/www/html/Facegram/db/db_conn.php";
include "/var/www/html/Facegram/functionality/template.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql="SELECT name, email, types, id FROM users; ";
$result=mysqli_query($conn,$sql);
$users=mysqli_fetch_all($result,MYSQLI_ASSOC); 

 ?>

<!DOCTYPE html>
    <html lang="en">
    <head><?php echo $head; ?><title>Users</title></head>
 
    <body>
        <?php echo $sidebar1 ?>
        
            
            <div class="containter-fluid">
            <h3 style="text-align: center;">Users</h3>
            
                <div class="row">
                    <div class="containter">
                        <div class="row">
                            <div class="col-md-2"><button type="button"  data-toggle="modal" data-target="#modal" class="ad-btn" style="position:absolute;right:34%;top:11%;">Create </button></div>
                            <div class="col-md-8">
                                <table id="datatable" class="table table-striped table-bordered table-hover " >
                                    <thead>
                                        <tr>
                                            <th >Name </th>
                                            <th >Email </th>
                                            <th >Role </th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td><?= $user['name'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            <td><?= $user['types'] ?></td>
                                            <td class="button-container">
                                        
                                                <form action="/Facegram/admin/users/delete" method="POST" name="deleteUsers">
                                                    <input type="hidden" name="delete_email" value="<?= $user['email'] ?>">
                                                    <button type="submit" class="ad-btn">Delete</button>
                                                
                                                </form>
                                                <form method="get" action="/Facegram/admin/user/update" name="editUsers">
                                                <input type="hidden" name="edit_id" value="<?= $user['id'] ?>">
                                                    <button type="submit" class="ad-btn">Update</button>
                                                </form>
                                            
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th >Name </th>
                                            <th >Email </th>
                                            <th >Role </th>
                                            <th >Action</th>
                                            </tr>
                                        </tfoot>
                                </table>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
            </div>           
        </div>   
        <?php echo $sidebar2 ?>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Create user</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/Facegram/admin/users/create" method="POST" name="createAdmin"
                            class="crt" id="krijim">
                            
                                <label>Name:</label>
                                <input type="text" name="name" class="form-control">
                                <p class='error'><?php echo $_SESSION['errors']['Name'] ?? ''; ?></p>
                                
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control">
                                <p class='error'><?php echo $_SESSION['errors']['Email'] ?? ''; echo $_SESSION['errors']['EmU'] ?? ''; ?></p>
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                                <p class='error'><?php echo $_SESSION['errors']['Password'] ?? ''; ?></p>
                                <label for="types">Role:</label>
                                <select id="types" name="types" class="form-control" >
                                    <option value="user">user</option>
                                    <option value="admin">admin</option>
                                </select>
                                
                            
                            
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="krijim">Create</button>
                        </div>
                    </div>
                </div><?php echo $foot; ?>
            </div>
        <?php if (isset($_SESSION['errors'])) {echo "<script>$('#modal').modal('show');</script>"; unset($_SESSION['errors']);}   ?>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.13.4/datatables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   
        <script type="text/javascript">$('#datatable').DataTable({});</script>
        <?php echo $sidebar3; ?>
        

    </body>
   

</html>

