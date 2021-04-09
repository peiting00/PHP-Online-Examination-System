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
        Online Examination Available
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" style="width: 100%;" id="result_table" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Exam ID</th>
                <th scope="col">Exam Title</th>
                <th scope="col">Total question</th>
                <th scope="col">Duration</th>
                <th scope="col">Date / Time</th>
                <th scope="col">Lecturer</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <?php
                $query = "SELECT * FROM exam JOIN course ON exam.courseID = course.courseID JOIN student ON exam.courseID = student.courseID WHERE student.studentID='$username'";
                $resultQuery = mysqli_query($conn, $query);
                $resultRow = mysqli_fetch_assoc($resultQuery);
                $i = 1;

                while ($resultRow){

                    $examID=$resultRow['examID']; // pass examID

                    $query = "SELECT * FROM result JOIN student ON result.studentID = student.studentID WHERE result.studentID='$username' AND result.examID='$examID'";
                    $countQuery = mysqli_query($conn, $query);
                    $rowcount = mysqli_num_rows($countQuery);
                    
                    if($rowcount == 0){
                        
                        echo "<tr><td>$i</td>";
                        echo "<td>".$resultRow['examID']."</td>";
                        echo "<td>".$resultRow['examTitle']."&nbsp;<span title='This quiz is already solve by you' class='glyphicon glyphicon-ok' aria-hidden='true'></span></td>";
                        echo "<td>".$resultRow['totalQuestion']."</td>";
                        echo "<td>".$resultRow['duration']."</td>";
                        echo "<td>".$resultRow['date']." / ".$resultRow['time']."</td>";
                        echo "<td>".$resultRow['teacherID']."</td>";
                        echo "<form action='takeTest.php?examID=$examID' method='post'>";
                        echo "<td><input type='submit' class='btn btn-success' name='start' value='Start '/></td></form></tr>";
                        $resultRow = mysqli_fetch_assoc($resultQuery);
                        $i++;
                    } 
                    else{
                        echo "<tr style='color:MediumSeaGreen'><td>$i</td>";
                        echo "<td>".$resultRow['examID']."</td>";
                        echo "<td>".$resultRow['examTitle']."</td>";
                        echo "<td>".$resultRow['totalQuestion']."</td>";
                        echo "<td>".$resultRow['duration']."</td>";
                        echo "<td>".$resultRow['date']." / ".$resultRow['time']."</td>";
                        echo "<td>".$resultRow['teacherID']."</td>";
                        echo "<form action='examList_stu.php' method='post'>";
                        echo "<td><input type='button' class='btn btn-danger' value='Taken'/></td></form></tr>";
                        $resultRow = mysqli_fetch_assoc($resultQuery);
                        $i++;
                    } 

                }
            
            ?>
            </tbody>