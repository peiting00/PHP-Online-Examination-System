<?php

include "dbConnection.php";

if(isset($_POST['button_action'])){
$title = $_POST['online_exam_title'];
$course = $_POST['online_exam_course'];
$date = $_POST['online_exam_datetime'];
$time = $_POST['online_exam_time'];
$duration = $_POST['online_exam_duration'];
$question = $_POST['total_question'];
$mark = $_POST['marks_per_right_answer'];
$wrong = $_POST['marks_per_wrong_answer'];
$userID = $_POST['userID'];

$wrongWsign = "-".$wrong;

$query = "INSERT INTO exam (examTitle, courseID, date, time, duration, totalQuestion, rightAnsMark, WrongAnsMark, teacherID) 
VALUES ('$title', '$course', '$date', '$time', '$duration', '$question', '$mark', '$wrongWsign', '$userID')";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
?>
                <html><header><h3>Record added successfully! You will be return to homepage by 3 second!</h3></header></html>

<?php
                header("refresh:3;url=teacherHome.php?nav=examList");
        }

}

if(isset($_POST['addquestion'])){
        $examID = $_POST['exam_id'];
        $q = $_POST['total_question'];
        $title = $_POST['question_title'];
        $option1 = $_POST['option_first'];
        $option2 = $_POST['option_second'];
        $option3 = $_POST['option_third'];
        $option4 = $_POST['option_fourth'];
        $answer = $_POST['answer_option'];

        for($i=0; $i<$q; $i++){

                if($answer[$i]==1){
                        $ans = $option1[$i];
                }
                else if($answer[$i]==2){
                        $ans = $option2[$i];
                }
                else if($answer[$i]==3){
                        $ans = $option3[$i];
                }
                else{
                        $ans = $option4[$i];
                }

                $sql = "INSERT INTO question (examID, question, option1, option2, option3, option4, answer) 
                VALUES ('$examID', '$title[$i]', '$option1[$i]', '$option2[$i]', '$option3[$i]', '$option4[$i]', '$ans')";
                $run = mysqli_query($conn, $sql);
        }

        if($run){
                ?>
                <html><header><h3>Record added successfully! You will be return to homepage by 3 second!</h3></header></html>

<?php
                header("refresh:3;url=teacherHome.php?nav=examList");
        }
        else{
                echo "cannot work";
        }


}

if(isset($_POST['delete'])){
        $examID = $_POST['exam_id'];

        $q = "DELETE exam FROM exam WHERE examID = '$examID'"; 
        $c1 = mysqli_query($conn, $q);
        $q2 = "DELETE question FROM question WHERE examID = '$examID'";
        $c2 = mysqli_query($conn, $q2);

        if($c1 && $c2){
                echo "Record DELETED Successfully";
                header("Location: teacherHome.php?nav=examList");
        }
        else {
                ?>
                <html><header><h3>Error Occur please refresh the page!</h3></header></html>

<?php
        }
}

?>