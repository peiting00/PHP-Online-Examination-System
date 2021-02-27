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
                </tr>
            </thead>
            <tbody>
            <?php
                if (isset($_GET["search"])) {
                    $searchTerm = mysqli_real_escape_string($conn, htmlspecialchars($_GET["search"]));
                    $searchQuery = mysqli_query($conn, "SELECT * FROM exam WHERE examTitle='$searchTerm'");
                    $searchRow = mysqli_fetch_row($searchQuery); 
                    $i = 1;

                    do {
                        echo "<tr><td>{$searchRow[0]}</td>";
                        echo "<td>{$searchRow[1]}</td>";
                        echo "<td>{$searchRow[2]}</td>";
                        echo "<td>{$searchRow[3]}</td>";
                        echo "<td>{$searchRow[4]}</td>";
                        echo "<td>{$searchRow[5]}</td>";
                        echo "<td>{$searchRow[6]}</td>";
                        echo "<td>{$searchRow[7]}</td>";
                        echo "<td>{$searchRow[8]}</td>";
                        echo "<form action='questionList.php?id=$searchRow[0]' method='post'>";
                        echo "<td><input type='submit' class='btn btn-warning' name='question' value='Question'/></td></form></tr>\n";
                        $searchRow = mysqli_fetch_row($searchQuery);
                        $i++;
                    } while ($searchRow);
                } else {
                    $examQuery = mysqli_query($conn, "SELECT * FROM exam");
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
                        echo "<form action='questionList.php?id=$examRow[0]' method='post'>";
                        echo "<td><input type='submit' class='btn btn-warning' name='question' value='Question'/></td></form></tr>\n";
                        echo "</form>";
                        $examRow = mysqli_fetch_row($examQuery);
                        $i++;
                    } while ($examRow);
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
