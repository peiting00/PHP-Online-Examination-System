<?php
    include "security.php";
    $_SESSION["role"] = "teacher";
    include "header.php";
    include "dbConnection.php";
    include "dataTable.php";

    $id = $_GET["id"];
?>

<br>
<div class="card">
    <div class="card-header" style="font-size: 20px; font-weight: 500;">
        Result List
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" style="width: 100%;" id="result_table" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Student ID</th>
                <th scope="col">Name</th>
                <th scope="col">Marks</th>
                <th scope="col">Details</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $resultQuery = mysqli_query($conn, "SELECT a.studentID, b.studentName, SUM(marks) FROM result 
                                            AS a INNER JOIN student AS b ON a.studentID = b.studentID
                                            WHERE examID='$id'");
                $resultRow = mysqli_fetch_row($resultQuery);
                $i = 1;
                do {
                    echo "<tr><td>$i</td>";
                    echo "<td>{$resultRow[0]}</td>";
                    echo "<td>{$resultRow[1]}</td>";
                    echo "<td>{$resultRow[2]}</td>";
                    echo "<form action='detailList_tec.php?id=$resultRow[0]' method='post'>";
                    echo "<td><input type='submit' class='btn btn-primary' name='detail' value='Detail'/></td></form></tr>\n";
                    $resultRow = mysqli_fetch_row($resultQuery);
                    $i++;
                } while ($resultRow);
            ?>
            </tbody>
        </table>
    </div>
</div>
