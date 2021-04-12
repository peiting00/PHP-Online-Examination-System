<?php
    include "dataTable.php";
    include "dbConnection.php";
    $_SESSION["role"] = "student";
    $username = $_SESSION['username'];
    $_SESSION["user"]=$username;
    
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
                <th scope="col">Student Name</th>
                <th scope="col">Total Marks Obtained</th>
                <th scope="col">Ranking</th>
                <th scope="col">Exam Taken</th>
                <th scope="col">Date / Time</th>
                <th scope="col">Details</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM mark JOIN student ON mark.studentID = student.studentID JOIN exam ON mark.examID = exam.examID WHERE mark.studentID='$username'";
                $resultQuery = mysqli_query($conn, $query);
                $resultRow = mysqli_fetch_assoc($resultQuery);
                //echo $resultQuery." ".$resultRow;
                $i = 1;
                do {
                    $id = $resultRow['examID'];
                    echo "<tr><td>$i</td>";
                    echo "<td>".$resultRow['studentID']."</td>";
                    echo "<td>".$resultRow['studentName']."</td>";
                    echo "<td>".$resultRow['totalMarks']."</td>";
                    //$query2 = "SELECT * FROM mark WHERE exam";
                    //$rankQuery = mysqli_query($conn, $query);
                    //$rankRow = mysqli_fetch_assoc($resultQuery);
                    echo "<td>".$resultRow['ranking']."</td>";
                    echo "<td>".$resultRow['examTitle']."</td>";
                    echo "<td>".$resultRow['date']." / ".$resultRow['time']."</td>";
                    echo "<form action='detailList_stu.php?id=$id' method='post'>";
                    echo "<td><input type='submit' class='btn btn-primary' name='detail' value='Detail'/></td></form></tr>\n";
                    $resultRow = mysqli_fetch_assoc($resultQuery);
                    $i++;
                } while ($resultRow);
            ?>
            </tbody>
        </table>
    </div>
</div>
