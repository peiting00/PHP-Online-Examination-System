<script type="text/javascript">
    function show_alert(status) {
        var alertDiv = document.getElementById("alert");

        if (status == "fail_username") {
            alertDiv.classList.add("alert-warning");
            $(alertDiv).append("User does not exists."); 
        } else if (status == "fail_password") {
            alertDiv.classList.add("alert-danger");
            $(alertDiv).append("Wrong password."); 
        } else {
            alertDiv.classList.add("alert-success");
            $(alertDiv).append("<button type='button' class='close' data-dismiss='alert'>&times;</button>"+
                               "</button>Welcome, "+status+".");
        }
    }
</script>

<?php
    include "login.html";
    include "dbConnection.php";

    if (isset($_POST["admin_login"]) || isset($_POST["teacher_login"]) || isset($_POST["student_login"])) {
        $userID = $_POST["userID"];
        $password = $_POST["password"];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        if (isset($_POST["admin_login"])) {
            $loginQuery = mysqli_query($conn, "SELECT password_hash FROM admin WHERE adminID='$userID'");
        } else if (isset($_POST["teacher_login"])) {
            $loginQuery = mysqli_query($conn, "SELECT password_hash FROM teacher WHERE teacherID='$userID'");
        } else if (isset($_POST["student_login"])) {
            $loginQuery = mysqli_query($conn, "SELECT password_hash FROM student WHERE studentID='$userID'");
        }

        $password_hash = mysqli_fetch_row($loginQuery);
        
        if($loginQuery) {
            if ($password_hash[0] == "") {
                echo "<script>show_alert('fail_username')</script>";
            } else if (password_verify($password, $password_hash[0])) {
                echo "<script>show_alert('$userID')</script>";
                header( "refresh:3;url=home.php" );
            } else {
                echo "<script>show_alert('fail_password')</script>";
            }
        }
    }

    mysqli_close($conn);
?>