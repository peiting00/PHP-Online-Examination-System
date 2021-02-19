<style>
    .btn {
        width: 80px;
    }
</style>
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
            echo "<tr><td></td>";
            echo "<td><input type='text' class='form-control' name='teacherID'/></td>";
            echo "<td><input type='text' class='form-control' name='teacherName'/></td>";
            echo "<td><input type='text' class='form-control' name='faculty'/></td>";
            echo "<td><input type='text' class='form-control' name='email'/></td>";
            echo "<td><input type='text' class='form-control' name='password'/></td>";
            echo "<td><button class='btn btn-success' onclick=\"window.location.href='add.php'\">Add</a></button></td></tr>\n";
            ?>
        </table>
    </div>
</div>