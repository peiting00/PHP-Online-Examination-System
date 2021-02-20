<script type="text/javascript">
    function show_alert(status) {
        var alertDiv = document.getElementById("alert");
        alertDiv.classList.add("alert-danger");
        alertDiv.style.display="inline-block";
        $(alertDiv).append("<button type='button' class='close' data-dismiss='alert'>&times;</button>"+
                            "</button>"+status); 
    }

    $(document).ready(function (){
        $(".btn").click(function() {
            var btnID = this.id;
            var id = document.getElementsByName(btnID)[0].innerHTML;
            var name = document.getElementsByName(btnID)[1].innerHTML;
            var faculty = document.getElementsByName(btnID)[2].innerHTML;
            var email = document.getElementsByName(btnID)[3].innerHTML;
            var password = document.getElementsByName(btnID)[4].innerHTML;
            document.getElementById("title").innerHTML = id;
            $('#id').val(id);
            $('#name').val(name);
            $('#faculty').val(faculty);
            $('#email').val(email);
            $('#password').val(password);
        });
    });
</script>
<style>
    .input {
        display: flex;
        flex-direction: row;
        margin-bottom: 10px;
    }

    .modalLabel {
        display: inline-block;
        width: 140px;
        text-align: right;
        margin-top: 8px;
        margin-right: 20px;
    }
</style>
<div class="alert" style="display: none; width: 100%;" id="alert" role="alert">
</div>
<div class="card">
    <div class="card-header" style="font-size: 20px; font-weight: 500;">
        Teacher List
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" style="width: 100%;" id="teacher_table" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Teacher ID</th>
                <th scope="col">Name</th>
                <th scope="col">Faculty</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // search teacher
                if (isset($_GET["search"])) {
                    $searchTerm = mysqli_real_escape_string($conn, htmlspecialchars($_GET["search"]));
                    $searchQuery = mysqli_query($conn, "SELECT * FROM teacher WHERE teacherID='$searchTerm' OR 
                                                teacherName='$searchTerm' OR facultyID='$searchTerm' OR email='$searchTerm'");
                    $searchRow = mysqli_fetch_row($searchQuery); 
                    $i = 1;

                    do {
                        echo "<tr><td>$i</td>";
                        echo "<td>{$searchRow[0]}</td>";
                        echo "<td>{$searchRow[1]}</td>";
                        echo "<td>{$searchRow[2]}</td>";
                        echo "<td>{$searchRow[3]}</td>";
                        echo "<td>{$searchRow[4]}</td>";
                        echo "<td><button style='width: 80px;' class='btn btn-primary' data-toggle='modal' data-target='#editModal'\">Edit</a></button>";
                        echo "<button style='width: 80px;' class='btn btn-danger'\">Delete</a></button></td>";
                        $searchRow = mysqli_fetch_row($searchQuery);
                        $i++;
                    } while ($searchRow);
                } else {
                    include "dbConnection.php";

                    // add teacher to database
                    if (isset($_POST["add"])) {
                        $id = $_POST["teacherID"];
                        $name = $_POST["teacherName"];
                        $faculty = $_POST["faculty"];
                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        $addQuery = mysqli_query($conn, "INSERT INTO teacher
                        (teacherID, teacherName, facultyID, email, password_hash) VALUES
                        ('$id', '$name', '$faculty', '$email', '$hashed_password')");

                        if($addQuery) {
                            $_SESSION['insert'] = "Record is added successfully!"; 
                            mysqli_close($conn);
                        } else {
                            $error = mysqli_error($conn);
                            echo "<script>show_alert(\"$error\")</script>";
                        } 

                    // update teacher database
                    } else if (isset($_POST["edit"])) {
                        $id = $_POST["id"];
                        $name = $_POST["name"];
                        $faculty = $_POST["faculty"];
                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        $updateQuery = mysqli_query($conn,"UPDATE teacher
                                SET teacherName='$name', facultyID='$faculty', email='$email', password_hash='$hashed_password'
                                WHERE teacherID='$id'");

                        if($updateQuery) {
                            $_SESSION['update'] = "Record is updated successfully!"; 
                        } else {
                            echo mysqli_error($conn);
                        }
                    }

                    // load teacher list
                    $teacherQuery = mysqli_query($conn, "SELECT * FROM teacher");
                    $teacherRow = mysqli_fetch_row($teacherQuery);
                    $i = 1;
                    do {
                        echo "<tr><td>$i</td>";
                        echo "<td name='$teacherRow[0]'>{$teacherRow[0]}</td>";
                        echo "<td name='$teacherRow[0]'>{$teacherRow[1]}</td>";
                        echo "<td name='$teacherRow[0]'>{$teacherRow[2]}</td>";
                        echo "<td name='$teacherRow[0]'>{$teacherRow[3]}</td>";
                        echo "<td name='$teacherRow[0]'>{$teacherRow[4]}</td>";
                        echo "<td><button style='width: 80px;' class='btn btn-primary' id='$teacherRow[0]' data-toggle='modal' data-target='#editModal'\">Edit</a></button>";
                        echo "<button style='width: 80px;' id='$teacherRow[0]' class='btn btn-danger'\">Delete</a></button></td>";
                        $teacherRow = mysqli_fetch_row($teacherQuery);
                        $i++;
                    } while ($teacherRow);
                }
            
                // add teacher form
                echo "</tbody>";
                echo "<form action='adminHome.php?nav=addTeacher' method='post'>";
                echo "<tr><td></td>";
                echo "<td><input type='text' class='form-control' name='teacherID' required/></td>";
                echo "<td><input type='text' class='form-control' name='teacherName' required/></td>";
                echo "<td><select class='form-control' style='padding: 3px;' name='faculty' required>";
                    $facultyQuery = mysqli_query($conn, "SELECT facultyID FROM faculty");
                    if (mysqli_num_rows($facultyQuery) > 0) {
                        while ($facultyRow = mysqli_fetch_assoc($facultyQuery)) {
                            echo "<option value='{$facultyRow["facultyID"]}'>{$facultyRow["facultyID"]}</option>\n";
                        }
                    }
                echo "</select></td>";
                echo "<td><input type='text' class='form-control' name='email' required/></td>";
                echo "<td><input type='text' class='form-control' name='password' required/></td>";
                echo "<td><input style='width: 80px;' type='submit' class='btn btn-success' name='add' value='Add'/></td></tr></form>\n";
            ?>

            <!-- Edit Model -->
            <div id="editModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title">Edit</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <form action="adminHome.php?nav=addTeacher" method="post">
                        <input name="id" id="id" style="display: none;">
                        <div class="input">
                            <label class="modalLabel" for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="input">
                            <label class="modalLabel" for="faculty">Faculty</label>
                            <select class='form-control' name="faculty" id='faculty' required>
                            <?php
                                $facultyQuery = mysqli_query($conn, "SELECT facultyID FROM faculty");
                                if (mysqli_num_rows($facultyQuery) > 0) {
                                    while ($facultyRow = mysqli_fetch_assoc($facultyQuery)) {
                                        echo "<option  id='facultyID' value='{$facultyRow["facultyID"]}'>{$facultyRow["facultyID"]}</option>\n";
                                    }
                                }
                            ?>
                            </select>
                        </div>
                        <div class="input">
                            <label class="modalLabel" for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required/></label>
                        </div>
                        <div class="input">
                            <label class="modalLabel" for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required/></label>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="edit" class="btn btn-success" value="Edit"/>
                            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close"/>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </table>
</div>