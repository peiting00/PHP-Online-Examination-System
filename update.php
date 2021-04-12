<?php
    include "security.php";
    include "dbConnection.php";
    $_SESSION["role"] = "student";

?>

<?php
    if($_GET['start']==1 && $_GET['qID']){
        $n=$_GET['n']; //noOfQuestion
        $totalQ=$_GET['totalQ']; //totalQuestion
        $examID=$_GET['examID']; //Exam ID
        $ans=$_POST['ans']; //answer
        $qID=$_GET['qID']; //question ID

        $getAnswerQuery = "SELECT * FROM question JOIN exam ON question.examID = exam.examID WHERE question.examID=$examID AND question.questionID=$qID";
        $answer = mysqli_query($conn, $query);
        
        while($resultRow = mysqli_fetch_assoc($resultQuery)){
            $ans=$resultRow['answer'];
        }

    }



?>