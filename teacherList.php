<script type="text/javascript">
    function show_alert(status) {
        var alertDiv = document.getElementById("alert");
        alertDiv.style.display="inline-block";
        if (status == "add") {
            alertDiv.classList.add("alert-success");
            $(alertDiv).append("<button type='button' class='close' data-dismiss='alert'>&times;</button>"+
            "</button>"+"Record added successfully!"); 
        } else if (status == "update") {
            alertDiv.classList.add("alert-success");
            $(alertDiv).append("<button type='button' class='close' data-dismiss='alert'>&times;</button>"+
            "</button>"+"Record updated successfully!"); 
        } else if (status == "delete") {
            alertDiv.classList.add("alert-success");
            $(alertDiv).append("<button type='button' class='close' data-dismiss='alert'>&times;</button>"+
            "</button>"+"Record deleted successfully!"); 
        } else {
            alertDiv.classList.add("alert-danger");
            alertDiv.style.display="inline-block";
            $(alertDiv).append("<button type='button' class='close' data-dismiss='alert'>&times;</button>"+
            "</button>"+status);
        } 
    }
    
    $(document).ready(function (){
        $(".editBtn").click(function() {
            var btnID = this.id;
            var id = document.getElementsByName(btnID)[0].innerHTML;
            var name = document.getElementsByName(btnID)[1].innerHTML;
            var faculty = document.getElementsByName(btnID)[2].innerHTML;
            var email = document.getElementsByName(btnID)[3].innerHTML;
            var password = document.getElementsByName(btnID)[4].innerHTML;
            // for title
            document.getElementById("title").innerHTML = id;
            // for all <input>
            $('#editID').val(id);
            $('#teacherID').val(id);
            $('#name').val(name);
            $('#faculty').val(faculty);
            $('#email').val(email);
            $('#password').val(password);
        });

        $(".deleteBtn").click(function() {
            var btnID = this.id;
            var id = document.getElementsByName(btnID)[0].innerHTML;
            // for <p>
            document.getElementById("teacherID").innerHTML = id;
            // for hidden <input>
            $('#deleteID').val(id);
        });

        $(".enrollBtn").click(function() {
            var btnID = this.id;
            var id = document.getElementsByName(btnID)[0].innerHTML;
            // for <p>
            document.getElementById("teacherID").innerHTML = id;
            // for hidden <input>
            $('#enrollID').val(id);
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
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                <th scope="col">Enroll</th>
                </tr>
            </thead>
            <tbody>
            <?php
            
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
                        echo "<script>show_alert('add')</script>";
                    } else {
                        $error = mysqli_error($conn);
                        echo "<script>show_alert(\"$error\")</script>";
                    } 

                // update teacher database
                } else if (isset($_POST["edit"])) {
                    $editID = $_POST["editID"];
                    $teacherID = $_POST["teacherID"];
                    $name = $_POST["name"];
                    $faculty = $_POST["faculty"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    $updateQuery = mysqli_query($conn,"UPDATE teacher
                            SET teacherID='$teacherID', teacherName='$name', facultyID='$faculty', email='$email', password_hash='$hashed_password'
                            WHERE teacherID='$editID'");

                    if($updateQuery) {
                        echo "<script>show_alert('update')</script>";
                    } else {
                        $error = mysqli_error($conn);
                        echo "<script>show_alert(\"$error\")</script>";
                    }

                // delete record
                } else if (isset($_POST["delete"])) {
                    $id = $_POST["deleteID"];
                    $deleteQuery = mysqli_query($conn, "DELETE FROM teacher WHERE teacherID='$id'");

                    if($deleteQuery) {
                        echo "<script>show_alert('delete')</script>"; 
                    } else {
                        $error = mysqli_error($conn);
                        echo "<script>show_alert(\"$error\")</script>";
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
                    echo "<td><button style='width: 80px;' class='editBtn btn btn-primary' id='$teacherRow[0]' data-toggle='modal' data-target='#editModal'\">Edit</a></button></td>";
                    echo "<td><button style='width: 80px;' class='deleteBtn btn btn-danger' id='$teacherRow[0]' data-toggle='modal' data-target='#deleteModal'\">Delete</a></button></td>";
                    echo "<td><button style='width: 80px;' class='enrollBtn btn btn-success' id='$teacherRow[0]' data-toggle='modal' data-target='#enrollModal'\">Enroll</a></button></td>";
                    $teacherRow = mysqli_fetch_row($teacherQuery);
                    $i++;
                } while ($teacherRow);
            
                // add teacher form
                echo "</tbody>";
                echo "<form action='adminHome.php?nav=teacherList' method='post'>";
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
                echo "<td><input style='width: 80px;' type='submit' class='btn btn-success' name='add' value='Add'/></td><td></td><td></td></tr></form>\n";
            ?>
        </table>

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
                    <form action="adminHome.php?nav=teacherList" method="post">
                        <input name="editID" id="editID" style="display: none;"/>
                        <div class="input">
                            <label class="modalLabel" for="name">Teacher ID</label>
                            <input type="text" class="form-control" name="teacherID" id="teacherID" required>
                        </div>
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
                            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel"/>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div id="deleteModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p style="float: left;">Are you sure to delete&nbsp;</p><p id="teacherID"></p>
                </div>
                <div class="modal-footer">
                    <form action="adminHome.php?nav=teacherList" method="post">
                        <input name="deleteID" id="deleteID" style="display: none;"/>
                        <input type="submit" name="delete" class="btn btn-success" value="Yes"/>
                        <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel"/>
                    </form>
                </div>
                </div>

            </div>
        </div>
        <!-- Enroll Model -->
        <div id="enrollModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title">Enroll</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <form action="adminHome.php?nav=teacherList" method="post">
                        <input name="enrollID" style="display: none;"/>
                        <div class="input">
                            <label class="modalLabel" for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="enrollID" readonly>
                        </div>
                        <div class="input">
                            <label class="modalLabel" for="faculty">Faculty</label>
                            <select class='form-control' name="faculty" id='faculty' required >
                            <?php
                                $courseQuery = mysqli_query($conn, "SELECT * FROM course");
                                if (mysqli_num_rows($courseQuery) > 0) {
                                    while ($courseRow = mysqli_fetch_assoc($courseQuery)) {
                                        echo "<option  id='courseID' value='{$courseRow["courseID"]}'>{$courseRow["courseName"]}</option>\n";
                                    }
                                }
                            ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="enroll" class="btn btn-success" value="Enroll"/>
                            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel"/>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>

    </div>
</div>