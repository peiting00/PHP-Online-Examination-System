<?php
    include "security.php";
    include "dbConnection.php";
    $_SESSION["role"] = "student";

?>

<?php
    

    if($_GET['start']==1 && $_GET['qID']){
        $qID=$_GET['qID']; //question ID
        $n = $_GET['n']; //No of question

        //EMPTY ANSWER RETURN TO QUESTION
        if(($_POST['ans'])==""){
            header("location:takeTest.php?examID=".$_GET['examID']."&examTitle=".$_GET['examTitle']."&start=1&n=$n&qID=$qID&ERROR=1");
        }
        else{
        $totalQ=$_GET['totalQ']; //totalQuestion
        $examID=$_GET['examID']; //Exam ID
        $ans=$_POST['ans']; //answer
        $examTitle=$_GET['examTitle'];
        $username=$_SESSION['username'];
        $lastQ=$qID+$totalQ;

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
        //update total mark
        //$insertQuery="INSERT INTO mark(studentID,examID,totalMarks,"

        // LOOP QUESTION
        if($qID!=$lastQ){
            $qID++;
            $n++;
            header("location:takeTest.php?examID=$examID&examTitle=$examTitle&start=1&n=$n&qID=$qID&totalQ=$totalQ");
        }else{
            header("location:takeTest.php?examID=$examID&examTitle=$examTitle&result=1");
        }


    }




    }



?>

