<?php
    session_start();
    $_SESSION["role"] = "admin";
    include "header.php";
    include "dbConnection.php";
    include "dataTable.php";

    $id = $_GET["id"];
?>

<br>
<div class="card">
    <div class="card-header" style="font-size: 20px; font-weight: 500;">
        Detail List
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" style="width: 100%;" id="detail_table" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Question</th>
                <th scope="col">Option 1</th>
                <th scope="col">Option 2</th>
                <th scope="col">Option 3</th>
                <th scope="col">Option 4</th>
                <th scope="col">Student Answer</th>
                <th scope="col">Correct Answer</th>
                <th scope="col">Result</th>
                <th scope="col">Marks</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $detailQuery = mysqli_query($conn, "SELECT b.question, b.option1, b.option2,
                                            b.option3, b.option4, a.studentAns, a.correctAns,
                                            a.result, a.marks FROM result AS a 
                                            INNER JOIN question AS b ON a.questionID = b.questionID
                                            WHERE studentID='$id'");
                $detailRow = mysqli_fetch_row($detailQuery);
                $i = 1;
                do {
                    echo "<tr><td>$i</td>";
                    echo "<td>{$detailRow[0]}</td>";
                    echo "<td>{$detailRow[1]}</td>";
                    echo "<td>{$detailRow[2]}</td>";
                    echo "<td>{$detailRow[3]}</td>";
                    echo "<td>{$detailRow[4]}</td>";
                    echo "<td>{$detailRow[5]}</td>";
                    echo "<td>{$detailRow[6]}</td>";
                    echo "<td>{$detailRow[7]}</td>";
                    echo "<td>{$detailRow[8]}</td>";
                    $detailRow = mysqli_fetch_row($detailQuery);
                    $i++;
                } while ($detailRow);
            ?>
            </tbody>
        </table>
    </div>
</div>
