<?php
    include "security.php";
    include "dbConnection.php";
    $_SESSION["role"] = "student";
?>

<?php
    if($_GET['start']==1 && $_GET['qID']){
        $qID=$_GET['qID']; //question ID
        $n = $_GET['n']; //No of question
        $totalQ=$_GET['totalQ']; //totalQuestion
        $examID=$_GET['examID']; //Exam ID
        $ans=$_POST['ans']; //answer
        $examTitle=$_GET['examTitle'];
        $username=$_SESSION['username'];

        //EMPTY ANSWER RETURN TO QUESTION
        if($ans==""){
            header("location:takeTest.php?examID=".$_GET['examID']."&examTitle=".$_GET['examTitle']."&start=1&n=$n&qID=$qID&ERROR=1");
        } else {
            // LOOP QUESTION
            if($ans!="") {
                //GET Answer and Mark rubric
                $query = "SELECT * FROM question JOIN exam ON question.examID = exam.examID WHERE question.examID=$examID AND question.questionID=$qID";
                $answer = mysqli_query($conn, $query);
                
                while($resultRow = mysqli_fetch_assoc($answer)){
                    $correctAns = $resultRow['answer'];
                    $rightMark= $resultRow['rightAnsMark'];
                    $wrongMark=$resultRow['wrongAnsMark'];
                }
                
                if($ans == $correctAns){
                    $_SESSION['sum']=$_SESSION['sum']+$rightMark;
                    //INSERT RESULT
                    $insertQuery="INSERT INTO result(studentID,examID,questionID,studentAns,correctAns,result,marks) VALUES ('$username','$examID','$qID','$ans','$correctAns','Right','$rightMark')";
                    $insert=mysqli_query($conn,$insertQuery);
                    if(!$insert){
                        header("location:takeTest.php?examID=$examID&examTitle=$examTitle&start=1&n=$n&qID=$qID&totalQ=$totalQ");
                    }

                }else{
                    $_SESSION['sum']=$_SESSION['sum']+$wrongMark;
                    $insertQuery="INSERT INTO result(studentID,examID,questionID,studentAns,correctAns,result,marks) VALUES ('$username','$examID','$qID','$ans','$correctAns','Wrong','$wrongMark')";
                    $insert=mysqli_query($conn,$insertQuery);
                    if(!$insert){
                        header("location:takeTest.php?examID=$examID&examTitle=$examTitle&start=1&n=$n&qID=$qID&totalQ=$totalQ");
                    }
                    
                }

                if($n>=$totalQ){
                    $sum = $_SESSION['sum'];
                    header("location:takeTest.php?examID=$examID&examTitle=$examTitle&start=2"); //result 
                    $insertQuery="INSERT INTO mark(studentID,examID,totalMarks,ranking) VALUES ('$username','$examID','$sum',1)";
                    $insert=mysqli_query($conn,$insertQuery);
                    if($insert)
                    {
                        // RANKING for same exam
                        $getTotalMark = "SELECT * FROM mark WHERE examID=$examID";
                        $totalQuery=mysqli_query($conn,$getTotalMark);
                        $resultRow = mysqli_fetch_assoc($totalQuery);
                        $c = 0;
                        $rank = 1;
                        $temp = 0;
                        $total = array();
                        while($resultRow){
                            $total[$c] = $resultRow['totalMarks'];
                            $c++;  
                            $resultRow = mysqli_fetch_assoc($totalQuery);
                        }
                        $total[$c] = 0;
                        for($a=0;$a<$c;$a++)
                        {
                            for($i=0;$i<$c;$i++)    
                            {
                                if($total[$i+1]!=0){
                                    if($total[$i]<$total[$i+1])
                                    {
                                        $temp = $total[$i];
                                        $total[$i] = $total[$i+1];
                                        $total[$i+1] = $temp;
                                    }
                                }   
                            }
                        }
                        for($i=0;$i<sizeof($total)-1;$i++)
                        {
                            $updateQuery="UPDATE mark SET ranking = '$rank' WHERE totalMarks = '$total[$i]' AND examID = '$examID'";
                            $update=mysqli_query($conn,$updateQuery);
                            if($total[$i+1]!=0)
                            {
                                if($total[$i]==$total[$i+1])
                                {
                                    $rank = $rank;
                                }   
                                else
                                {
                                    $rank++;
                                }
                            }   
                        }
                    }
                }
                else{
                    $qID++;
                    $n++;
                    header("location:takeTest.php?examID=$examID&examTitle=$examTitle&start=1&n=$n&qID=$qID&totalQ=$totalQ");
                }
            }
        }
    }
?>

