<?php
    include "dataTable.php";
    include "dbConnection.php";
    $_SESSION["role"] = "student";
    $username = $_SESSION['username'];
    $_SESSION["user"]=$username;
    
    date_default_timezone_set('Asia/Kuala_Lumpur');
?>

<br>
<div class="card">
    <div class="card-header" style="font-size: 20px; font-weight: 500;">
        Available Online Examination 
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
                <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM exam JOIN course ON exam.courseID = course.courseID JOIN student ON exam.courseID = student.courseID WHERE student.studentID='$username' ORDER BY exam.date DESC";
                $resultQuery = mysqli_query($conn, $query);
                $resultRow = mysqli_fetch_assoc($resultQuery);
                $i = 1;

                while ($resultRow){

                    $examID=$resultRow['examID']; // pass examID
                    $examTitle=$resultRow['examTitle'];
                    $examDate=$resultRow['date'];
                    $examTime=$resultRow['time'];

                    $query = "SELECT * FROM result JOIN student ON result.studentID = student.studentID WHERE result.studentID='$username' AND result.examID='$examID'";
                    $countQuery = mysqli_query($conn, $query);
                    $rowcount = mysqli_num_rows($countQuery);

                    $query = "SELECT * FROM mark WHERE studentID='$username' AND examID='$examID'";
                    $resultQuery2=mysqli_query($conn,$query);
                    $rowcount2= mysqli_num_rows($resultQuery2);

                    if($rowcount == 0){ // no record in result table
                            echo "<tr><td>$i</td>";
                            echo "<td>".$resultRow['examID']."</td>";
                            echo "<td>".$resultRow['examTitle']."</td>";
                            echo "<td>".$resultRow['totalQuestion']."</td>";
                            echo "<td>".$resultRow['duration']."</td>";
                            echo "<td>".$resultRow['date']." / ".$resultRow['time']."</td>";
                            echo "<td>".$resultRow['teacherID']."</td>";
                            echo "<form action='takeTest.php?examID=$examID&examTitle=$examTitle&start=0' method='post'>";
  
                        if($rowcount2==0){ // no record in mark table
                            
                            if($examDate < date('Y-m-d')){
                                echo "<td><input type='button' class='btn btn-danger' value='Expired '/></td></form></tr>";
                            }else{
                                echo "<td><input type='submit' class='btn btn-success' name='start' value='Start '/></td></form></tr>";
                            }
                            
                        }else{
                            echo "<td><input type='button' class='btn btn-danger' value='Exam Session Expired'/></td></form></tr>";
                        }
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


                if(isset($_SESSION['sum']) OR isset($_SESSION['examSessionSTART'])){
                    $examID=$_SESSION['examID'];
                    unset($_SESSION['sum']);
                    echo "<script>window.location.href='update.php?examID=$examID&start=1&n=11&totalQ=1&expired=1'</script>";
                    unset($_SESSION['examID']);
                    UNSET($_SESSION['examSessionSTART']);
                }

            
            ?>
            </tbody>
        </table>
    </div>
</div>