<script type="text/javascript">
    function show_alert(status) {
        var alertDiv = document.getElementById("alert");
        if (status == "fail_username") {
            alertDiv.classList.add("alert-warning");
            $(alertDiv).append("<button type='button' class='close' data-dismiss='alert'>&times;</button>"+
                               "</button>It seems you have an account with us! Please use your student ID to login."); 
   
        }else if (status == "password_same_username") {
            alertDiv.classList.add("alert-danger");
            $(alertDiv).append("<button type='button' class='close' data-dismiss='alert'>&times;</button>"+
                               "</button>Password should not same as Student ID!"); 
        }else if (status == "fail_reenter") {
            alertDiv.classList.add("alert-danger");
            $(alertDiv).append("<button type='button' class='close' data-dismiss='alert'>&times;</button>"+
                               "</button>Password mismatch!"); 
        }else {
            alertDiv.classList.add("alert-success");
            $(alertDiv).append("<button type='button' class='close' data-dismiss='alert'>&times;</button>"+
                               "</button>You have registered a new account with us!");
        }
    }
</script>

<?php
include "dbConnection.php";
include "html/createAcc_face.php";
    if (isset($_POST["register"])) {
        $status=0;
        // GET USER INPUT
        $studentID = mysqli_real_escape_string($conn,$_POST['studentID']);
        $studentName = mysqli_real_escape_string($conn,$_POST['studentName']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $course = mysqli_real_escape_string($conn,$_POST['courseID']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $re_password = mysqli_real_escape_string($conn,$_POST['password2']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); 

       
            $GetStudentIdQuery = mysqli_query($conn, "SELECT * FROM student");
            while($ex_username = mysqli_fetch_array($GetStudentIdQuery)) {
                    //check existing studentID
                if($ex_username['studentID'] == $studentID){
                    echo "<script>show_alert('fail_username')</script>"; //Alert use new username
                    $status=0;
                    exit(0);
                }    
            }

        // CHECK PASSWORD
                //validate password cannot same as username
            if($studentID==$password){
                echo "<script>show_alert('password_same_username')</script>";
                $status=0;
                exit(0);
            }else if($password!=$re_password){
                //validate two password are equal to each other
                echo "<script>show_alert('fail_reenter')</script>";   
                $status=0;
                exit(0);
            }
            else
                $status=1;

        // INSERT INTO Database   
        if($status==1){
                //store new data into database
                $insertQuery="INSERT INTO student(studentID,studentName,email,courseID,password_hash) VALUES ('$studentID','$studentName','$email','$course','$hashed_password')";
                $register=mysqli_query($conn,$insertQuery);
                // If Insert Successfully
                if($register){
                    echo "<script>show_alert('User ID:$studentID')</script>";
                    //header("refresh:3;url=
                    echo "<script>window.setTimeout(
                        function(){
                            window.location.href='login.php';
                        },3000);</script>";
                }
                else{
                    echo "<script>show_alert('Database Not Working')</script>";
                    exit(0);
                }
        }
    }
mysqli_close($conn);

?>