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
        //EMPTY ANSWER RETURN TO QUESTION
        if(($_POST['ans'])==""){
            header("location:takeTest.php?examID=".$_GET['examID']."&examTitle=".$_GET['examTitle']."&start=1&n=$n&qID=$qID&lastQ=$lastQ&ERROR=1");
        }
        else{
        
        $examID=$_GET['examID']; //Exam ID
        $ans=$_POST['ans']; //answer
        $examTitle=$_GET['examTitle'];
        $username=$_SESSION['username'];
        

        if($n==1){
            $lastQ=$qID+$totalQ;
        }
        //GET Answer and Mark rubric
        $query = "SELECT * FROM question JOIN exam ON question.examID = exam.examID WHERE question.examID=$examID AND question.questionID=$qID";
        $answer = mysqli_query($conn, $query);
        
        while($resultRow = mysqli_fetch_array($answer)){
            $correctAns = $resultRow['answer'];
            $rightMark= $resultRow['rightAnsMark'];
            $wrongMark=$resultRow['wrongAnsMark'];
        }
        
        if($ans == $correctAns){
            //INSERT RESULT
            $insertQuery="INSERT INTO result(studentID,examID,questionID,studentAns,correctAns,result,marks) VALUES ('$username','$examID','$qID','$ans','$correctAns','Right','$rightMark')";
            $insert=mysqli_query($conn,$insertQuery);

            if(!$insert){
                header("location:takeTest.php?examID=$examID&examTitle=$examTitle&start=1&n=$n&qID=$qID&totalQ=$totalQ");
            }

        }else{
            $insertQuery="INSERT INTO result(studentID,examID,questionID,studentAns,correctAns,result,marks) VALUES ('$username','$examID','$qID','$ans','$correctAns','Wrong','$wrongMark')";
            $insert=mysqli_query($conn,$insertQuery);

            if(!$insert){
                header("location:takeTest.php?examID=$examID&examTitle=$examTitle&start=1&n=$n&qID=$qID&totalQ=$totalQ");
            }
        }


        
        $insertQuery="INSERT INTO mark(studentID,examID,totalMarks) VALUES ('$username','$examID','$sum')";
        
        // RANKING for same exam
        $getTotalMark = "SELECT * FROM mark WHERE examID=$examID";
        $ranking=mysqli_query($conn,$getTotalMark);
        $resultRow = mysqli_fetch_assoc($ranking);
        $c = 0;
        $rank = 1;
        $temp = 0;
        $total = array();
        while($row=mysqli_fetch_assoc($ranking)){
            $total[$c] = $resultRow['totalMarks'];
            $c++;  
        }
        for($i=0;$i<$c;$i++)    
        {
            if($total[$i]<$total[$i+1])
            {
                $temp = $total[$i];
                $total[$i] = $total[$i+1];
                $total[$i+1] = $temp;
            }
        }
        $i=0;
        while($row=mysqli_fetch_assoc($ranking)){
            $updateQuery="UPDATE mark SET ranking = '$rank' WHERE totalMarks = '$total[$i]' AND examID = '$examID'";
            $update=mysqli_query($conn,$updateQuery);
            $i++;
            $rank++;
        }


        // LOOP QUESTION
        if($qID>$lastQ){
            header("location:takeTest.php?examID=$examID&examTitle=$examTitle&start=2"); //result 
            
        }else{
            $qID++;
            $n++;
            header("location:takeTest.php?examID=$examID&examTitle=$examTitle&start=1&n=$n&qID=$qID&totalQ=$totalQ&lastQ=$lastQ");
        }


    }

    }

?>

