<div class="card">
    <div class="card-header" style="font-size: 20px; font-weight: 500;">
        Exam List
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" style="width: 100%;" id="exam_table" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Course</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Duration</th>
                <th scope="col">Total Question</th>
                <th scope="col">Right Answer Mark</th>
                <th scope="col">Wrong Answer Mark</th>
                <th scope="col">Question</th>
                <th scope="col">Result</th>
                <th scope="col">DELETE</th>
                </tr>
            </thead>
            <tbody>
            <?php
                
                $username = $_SESSION['username'];
                $examQuery = mysqli_query($conn, "SELECT * FROM exam WHERE teacherID = '$username'");
                $examRow = mysqli_fetch_row($examQuery);
                $i = 1;
                
                do {
                    echo "<tr><td>{$examRow[0]}</td>";
                    echo "<td>{$examRow[1]}</td>";
                    echo "<td>{$examRow[2]}</td>";
                    echo "<td>{$examRow[3]}</td>";
                    echo "<td>{$examRow[4]}</td>";
                    echo "<td>{$examRow[5]}</td>";
                    echo "<td>{$examRow[6]}</td>";
                    echo "<td>{$examRow[7]}</td>";
                    echo "<td>{$examRow[8]}</td>";
                    
                    $checkqus = mysqli_query($conn, "SELECT examID FROM question WHERE examID='$examRow[0]'");
                    
                    if(mysqli_fetch_row($checkqus)>0){
                        echo "<form action='questionList_tec.php?id=$examRow[0]' method='post'>";
                        echo "<td><input type='submit' class='btn btn-warning' name='question' value='Question'/></form></td>\n";
                    }
                    else{
                        echo "<form action='addquestion.php?id=$examRow[0]' method='post'>";
                        echo "<td><input type='submit' class='btn btn-danger' name='question' value='Add Question'/></td>\n";
                        echo "<input type='hidden' class='btn btn-danger' name='exam_id' value='$examRow[0]'/>";
                        echo "<input type='hidden' class='btn btn-danger' name='total_question' value='$examRow[6]'/></form>";
                    }
                    echo "<form action='resultList.php?id=$examRow[0]' method='post'>";
                    echo "<td><input type='submit' class='btn btn-secondary' name='result' value='Result'/></td></form>\n";

                    echo "<form action='code.php' method='post'>";
                    echo "<input type='hidden' class='btn btn-danger' name='exam_id' value='$examRow[0]'/>";
                    echo "<td><input type='submit' class='btn btn-danger' name='delete' value='DELETE'/></td></form></tr>\n";
                    $examRow = mysqli_fetch_row($examQuery);
                    $i++;
                } while ($examRow);

           
       
            ?>
            </tbody>
        </table>
    </div>
</div>
