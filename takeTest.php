<?php
    include "security.php";
    //include "dataTable.php";
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
                    <span style="color:red">Warning:</span><br>
                    <span style="color:red">You have only ONE attempt to answer the exam, timer will start as soon as the question loads.</span><br>
                    <span style="color:red">Please be aware that the exam cannot be resumed if you leave the page.</span><br><br><br>
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
            
            //start the exam session
            if(isset($_POST['start'])){

                $_SESSION['examID']=$_GET['examID'];
                $query = "SELECT * FROM question JOIN exam ON question.examID = exam.examID WHERE question.examID=".$_GET['examID']."";
                $resultQuery = mysqli_query($conn, $query) or die("Error" +mysqli_error($conn));
                $resultRow=mysqli_fetch_array($resultQuery);
                if ($resultRow){
                    $duration = $resultRow['duration']; //exam session duration
                }

                //$time = "{$duration} minutes"; // cast duration to string
                $time="1 minutes";
                $startTime= date("Y-m-d H:i:s");
                $_SESSION['examSessionSTART']=$startTime;
                $_SESSION['examSessionEND'] = date('Y-m-d H:i:s',strtotime($time));

            }

            if($_GET['examID'] && $_GET['start']==1 ){
                
                echo "<div style='margin:5%'>";
                if(isset($_GET['ERROR'])){
                    echo "<span style='color:red; bold'>WARNING : DO NOT SUBMIT EMPTY ANSWER !</span><br>";
                }
                $examID=$_GET['examID'];
                $examTitle=$_GET['examTitle'];
                $n=$_GET['n'];

                if(!isset($_GET['qID'])){
                    $query = "SELECT * FROM question JOIN exam ON question.examID = exam.examID WHERE question.examID=$examID ";
                   
                }else{
                    
                        $qid= $_GET['qID'];
                    
                    $query = "SELECT * FROM question JOIN exam ON question.examID = exam.examID WHERE question.examID=$examID and question.questionID=$qid";
                }

                $resultQuery = mysqli_query($conn, $query) or die("Error" +mysqli_error($conn));
                $resultRow=mysqli_fetch_array($resultQuery);
                if ($resultRow){
                        $qID=$resultRow['questionID'];
                        $totalQ=$resultRow['totalQuestion'];
                        $duration = $resultRow['duration']; //exam session
                        echo $n.".&nbsp;";
                        echo "&nbsp;".$resultRow['question']."&nbsp;&nbsp;";
                }
                
                // show exam session
                echo "<strong>START TIME : ".$_SESSION['examSessionSTART'];
                echo "  |   ";
                echo "DUE TIME : ".$_SESSION['examSessionEND']."</strong>";
                
                $query= "SELECT * FROM question WHERE questionID =$qID";
                $resultQuery = mysqli_query($conn, $query);
                echo "<form action='update.php?examID=$examID&examTitle=$examTitle&start=1&n=$n&qID=$qID&totalQ=$totalQ' method='POST'>"; // update answer
                echo "<br>";
                
                if($n==1)
                {
                    $_SESSION['sum']=0; 
                }

                while ($resultRow=mysqli_fetch_array($resultQuery)){ // fetch and display question option
                        echo "<input type='radio' name='ans' value='".$resultRow['option1']."'>&nbsp;".$resultRow['option1']."<br /><br />";
                        echo "<input type='radio' name='ans' value='".$resultRow['option2']."'>&nbsp;".$resultRow['option2']."<br /><br />";
                        echo "<input type='radio' name='ans' value='".$resultRow['option3']."'>&nbsp;".$resultRow['option3']."<br /><br />";
                        echo "<input type='radio' name='ans' value='".$resultRow['option4']."'>&nbsp;".$resultRow['option4']."<br /><br />";
                }
                echo'</tr><br /><button type="submit" name="submitQ" class="btn btn-success"><span aria-hidden="true"></span>&nbsp;Submit</button></form>';

                //session expired
                $now = date('Y-m-d H:i:s');
                if($now >= $_SESSION['examSessionEND']){
                    unset($_SESSION['examSessionStart']);
                    unset($_SESSION['examSessionEND']);
                    header("location:update.php?examID=$examID&examTitle=$examTitle&start=1&n=11&qID=$qID&totalQ=$totalQ&expired=1");
                }
            }
        ?>

        <!--TEST FINISH / RESULT SLIP-->
        <?php 
            date_default_timezone_set('Asia/Kuala_Lumpur');
            $now=date('Y-m-d / H:i:s');

            if($_GET['examID'] && $_GET['start']==2 ){
                $examID=$_GET['examID'];
                $studentID= $_SESSION['username'];
                $Right=$Wrong=$mark=0;
                echo "<div style='margin:5%'>";
                echo "<h3>Your Exam Result</h3><br /><table class='table table-striped title1' style='font-size:20px;font-weight:500'>";
                $query="SELECT * FROM result WHERE studentID='$studentID' AND examID=$examID";
                $resultQuery=mysqli_query($conn,$query);
                while ($resultRow=mysqli_fetch_array($resultQuery)){
                    if($resultRow['result']=="Right")
                        $Right++;
                    else
                        $Wrong++;

                    $mark+=$resultRow['marks'];
                }

                echo "<tr><td>Total Marks</td><td>$mark</td></tr>
                <tr><td>Time Completed&nbsp;<span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></td><td>$now</td></tr>
                <tr style='color:#99cc32'><td>Right Answer&nbsp;<span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></td><td>$Right</td></tr> 
	            <tr style='color:red'><td>Wrong Answer&nbsp;<span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></td><td>$Wrong</td></tr>";
	            
        
            }
        
        
        
        ?>