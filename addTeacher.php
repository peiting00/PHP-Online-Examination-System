<script type="text/javascript">
    function show_alert(status) {
        var alertDiv = document.getElementById("alert");
        alertDiv.classList.add("alert-danger");
        alertDiv.style.display="inline-block";
        $(alertDiv).append("<button type='button' class='close' data-dismiss='alert'>&times;</button>"+
                            "</button>"+status); 
    }
</script>
<style>
    .btn {
        width: 80px;
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
                        echo "<td><button class='btn btn-primary' name='{$searchRow[0]}' onclick=\"window.location.href='edit.php?id=".$searchRow[0]."'\">Edit</a></button>";
                        echo "<button class='btn btn-danger' name='{$searchRow[0]}' onclick=\"window.location.href='delete.php?id=".$searchRow[0]."'\">Delete</a></button></td>";
                        $searchRow = mysqli_fetch_row($searchQuery);
                        $i++;
                    } while ($searchRow);
                } else {
                    include "dbConnection.php";

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
                    }

                    $teacherQuery = mysqli_query($conn, "SELECT * FROM teacher");
                    $teacherRow = mysqli_fetch_row($teacherQuery);
                    $i = 1;
                    do {
                        echo "<tr><td>$i</td>";
                        echo "<td>{$teacherRow[0]}</td>";
                        echo "<td>{$teacherRow[1]}</td>";
                        echo "<td>{$teacherRow[2]}</td>";
                        echo "<td>{$teacherRow[3]}</td>";
                        echo "<td>{$teacherRow[4]}</td>";
                        echo "<td><button style='align-content: center;' class='btn btn-primary' name='{$teacherRow[0]}' onclick=\"window.location.href='edit.php?id=".$teacherRow[0]."'\">Edit</a></button>";
                        echo "<button class='btn btn-danger' name='{$teacherRow[0]}' onclick=\"window.location.href='delete.php?id=".$teacherRow[0]."'\">Delete</a></button></td>";
                        $teacherRow = mysqli_fetch_row($teacherQuery);
                        $i++;
                    } while ($teacherRow);
                }
            
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
                echo "<td><input type='submit' class='btn btn-success' name='add' value='Add'/></td></tr></form>\n";
            ?>
        </table>
    </div>
</div>