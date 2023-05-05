<?php 

include "/var/www/html/Facegram/db/db_conn.php";
include "/var/www/html/Facegram/functionality/redirection.php";
include "/var/www/html/Facegram/functionality/template.php";

redir();

$sql="SELECT name, email, types, id FROM users; ";
$result=mysqli_query($conn,$sql);
$users=mysqli_fetch_all($result,MYSQLI_ASSOC); 


 ?>

<!DOCTYPE html>
    <title>ADMIN</title>
<?php echo $head; ?>
        
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <body>

        <?php echo $sidebar1 ?>

            <div class="card">
            
            <div class="card-header">
                <h3 >Users</h3>
            </div>
            <div class="card-body">
                <button type="button"  data-toggle="modal" data-target="#modal" class="ad-btn">Create </button>
                <table id="myTable" class="table table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th >Name</th>
                            <th >Email</th>
                            <th >Role</th>
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
                        
                            <form action="/Facegram/functionality/delete.php" method="POST">
                                <input type="hidden" name="delete_email" value="<?= $user['email'] ?>">
                                <button type="submit" class="ad-btn">Delete</button>
                            </form>
                            <form action="/Facegram/views/edit.php?$user['id']" method="get">
                                <input type="hidden" name="edit_id" value="<?= $user['id'] ?>">
                                <button type="submit" class="ad-btn">Edit</button>
                            </form>
                            
                            </td>
                        </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <div id="pagination" class="stylez"></div>
            
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
                            <form action="/Facegram/functionality/adminc.php" method="POST" class="crt" id="krijim">
                            
                                <label>Name:</label>
                                <input type="text" name="name" class="form-control">
                                <?php 
                                    if(isset($_SESSION['errors']['Name'])){
                                        echo "<p class='error'>" . $_SESSION['errors']['Name'] . "</p>";
                                    }
                                ?>
                                
                                <label>Email:</label>
                                <input type="text" name="email" class="form-control">
                                <?php 
                                    if(isset($_SESSION['errors']['Email'])){
                                        echo "<p class='error'>" . $_SESSION['errors']['Email'] . "</p>";
                    
                                    }
                                    if(isset($_SESSION['errors']['EmU'])){
                                    echo "<p class='error'>" . $_SESSION['errors']['EmU'] . "</p>";
                    
                                    }
                
                                ?>
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                                <?php 
                                    if(isset($_SESSION['errors']['Password'])){
                                        echo "<p class='error'>" . $_SESSION['errors']['Password'] . "</p>";
                    
                                    }
                                ?>
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
                </div>
            </div>
        <?php if (isset($_SESSION['errors'])) {
        echo "<script>$('#modal').modal('show');</script>"; 
        unset($_SESSION['errors']);}   ?>

    
    </body>
    <script>
    var table = document.getElementById("myTable");
    var rowsPerPage = 6;
    var currentPage = 1;

    function showPage(page) {
    currentPage = page;
    var startRow = (currentPage - 1) * rowsPerPage + 1;
    var endRow = startRow + rowsPerPage - 1;
    for (var i = 1; i < table.rows.length; i++) {
        if (i < startRow || i > endRow) {
        table.rows[i].style.display = "none";
        } else {
        table.rows[i].style.display = "";
        }
    }
    }

    function createPaginationButtons() {
    var numRows = table.rows.length - 1;
    var numPages = Math.ceil(numRows / rowsPerPage);
    var paginationDiv = document.getElementById("pagination");
    
    
    var prevButton = document.createElement("button");
    prevButton.innerHTML = "Previous";
    prevButton.addEventListener("click", function() {
        if (currentPage > 1) {
        showPage(currentPage - 1);
        }
    });
    paginationDiv.appendChild(prevButton);

    
    for (var i = 1; i <= numPages; i++) {
        var pageButton = document.createElement("button");
        pageButton.innerHTML = i;
        pageButton.addEventListener("click", function() {
        showPage(parseInt(this.innerHTML));
        });
        paginationDiv.appendChild(pageButton);
    }


    var nextButton = document.createElement("button");
    nextButton.innerHTML = "Next";
    nextButton.addEventListener("click", function() {
        if (currentPage < numPages) {
        showPage(currentPage + 1);
        }
    });
    paginationDiv.appendChild(nextButton);
    }

    showPage(1);
    createPaginationButtons();




    
    

    </script>
    <?php echo $sidebar3 ?>

</html>

