<?php
    include "security.php";
    include "dataTable.php";
    include "dbConnection.php";
    $_SESSION["role"] = "student";
    include "header.php";

?>


<br>
<div class="card">
    <div class="card-header" style="font-size: 20px; font-weight: 500;">
        Online Examination Session
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" style="width: 100%;" id="result_table" cellspacing="0" width="100%">
        <thead>
                <tr>
                    <th scope="col">Examination ID: <?php echo $_GET['examID'] ?></th>
                    <th scope="col">Examination Title: <?php echo $_GET['examTitle']?></th>
                    <th scope="col">Student ID: <?php echo $_SESSION['username']?></th>
                </tr>
                <!-- Before the Test start -->
                <?php if( $_GET['examID'] && $_GET['start']==0 ){?>
                <tr>
                    <th colspan="3" ><br>
                    <span style="color:red">Warning: You have only ONE attempt to answer the exam, timer will start as soon as the question loads.</span>
                    <br><br><br>

                    <?php
                        echo "<form action='takeTest.php?examID=".$_GET['examID']."&examTitle=".$_GET['examTitle']."&start=1&n=1' method='post'>";
                        echo "<input type='submit' class='btn btn-success' name='start' value='Start the exam'/>&nbsp;&nbsp;";
                        echo "<a href='studentHome.php?nav=takeTest' style='color:grey'>CANCEL</a></form>";}
                    ?>
                    </th>
                </tr>
            </thread>
        </table>

        <!-- Test Start-->
        <?php
            if( $_GET['examID'] && $_GET['start']==1 ){
                $examID=$_GET['examID'];
                $examTitle=$_GET['examTitle'];
                $n=$_GET['n'];
                $query = "SELECT * FROM question JOIN exam ON question.examID = exam.examID WHERE question.examID='".$_GET['examID']."'";
                $resultQuery = mysqli_query($conn, $query);
                
                while ($resultRow=mysqli_fetch_assoc($resultQuery)){
                        
                        $qID=$resultRow['questionID'];
                        $totalQ=$resultRow['totalQuestion'];
                        echo $n;
                        echo "&nbsp;".$resultRow['question']."<br>";
                }
                
                $resultQuery = mysqli_query($conn, $query);
                echo "<form action='update.php?examID=$examID&start=1&qID=$qID&n=$n&totalQ=$totalQ' method='post'>"; // update answer
                echo "<br>";
                
                while ($resultRow=mysqli_fetch_assoc($resultQuery)){
                        echo "<input type='radio' name='ans' value='".$resultRow['option1']."'>&nbsp;".$resultRow['option1']."<br /><br />";
                        echo "<input type='radio' name='ans' value='".$resultRow['option2']."'>&nbsp;".$resultRow['option2']."<br /><br />";
                        echo "<input type='radio' name='ans' value='".$resultRow['option3']."'>&nbsp;".$resultRow['option3']."<br /><br />";
                        echo "<input type='radio' name='ans' value='".$resultRow['option4']."'>&nbsp;".$resultRow['option4']."<br /><br />";
                }
                        echo "<td><div><button type='submit' class='btn btn-success'><span class='glyphicon glyphicon-lock' aria-hidden='true'></span>Submit</button></div></td></form></tr>";
                        
                
            }
        ?>
                

            