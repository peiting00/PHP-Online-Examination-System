<?php
include "dbConnection.php";
?>
<!DOCTYPE html>
<html>
<head>
        <title>Create Account Page</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- Font Awesome CSS -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
        <link rel="stylesheet" href="css/login.css">
        <!-- Rotobo Font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="fonts/icomoon/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
     </head>

    <body>
        <div class="top">
            <img src="images/logo2.png"/>
        </div>
        <div class="bottom">
            <div class="alert" id="alert" role="alert">
            </div>
            <div class="container col-md-6">
                <div class="form-block">
                    <h3><strong>Online Examination Registration</strong></h3>
                    <form action="createAcc.php" name="login" method="post">
                        
                        <div class="form-group">
                            <label for="userID">Student ID</label>
                            <input type="text" class="form-control" placeholder="Your Student ID" name="studentID" id="studentID" required>
                        </div>
                        <div class="form-group">
                            <label for="userID">Full Name</label>
                            <input type="text" class="form-control" placeholder="Your Full Name" name="studentName" id="studentName" required>
                        </div>
                        <div class="form-group">
                            <label for="course">Course ID </label>
                            <select id="courseID" class="form-control" name="courseID">
                            <option value="invalid" disabled selected>Choose your course ID</option>
                            <?php 
                            $courseID=mysqli_query($conn,"SELECT courseID from course");
                            while($id=mysqli_fetch_array($courseID)){
                                echo "<option value='".$id['courseID']."'class='form-control'>".$id['courseID']."</option>";
                            }
                            ?>
                            </select>
                            
                        </div>
                        <div class="form-group">
                            <label for="userID">Email</label>
                            <input type="email" class="form-control" placeholder="Your Email" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" placeholder="Your Password" name="password" id="password" pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}"
                             title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                             onkeyup="keyUp()" required>
                        </div>
                        <div class="message" id="message" style="display:none" >
                            <label style="font-weight:bold">Password must contain the following:</label>
                            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                            <p id="number" class="invalid">A <b>number</b></p>
                            <p id="length" class="invalid" >Minimum <b>8 characters</b></p>
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm Password <span style="color:red">*</span></label>
                            <input type="password" class="form-control" id="password2" name="password2"  placeholder="Re-enter your password " required>
                        </div>
                        <div class="form-group">
                            <span>Have an account already?</span>
                            <span><a href="login.php" class="create-acc">Click me to login</a></span> 
                        </div>
                        
                        <input type="submit" name="register" value="Register" class="btn btn-block">
                    </form>
                </div>
            </div>
        </div>
   


<!-- Password Validation -->
<script type="text/javascript">
    var myInput = document.getElementById("password");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");
    // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
        document.getElementById("message").style.display = "block";
    }
    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
        document.getElementById("message").style.display = "none";
    }
    // When the user starts to type something inside the password field
        function keyUp() {
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if(myInput.value.match(lowerCaseLetters)) {  
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }                   
        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if(myInput.value.match(upperCaseLetters)) {  
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }
        // Validate numbers
            var numbers = /[0-9]/g;
            if(myInput.value.match(numbers)) {  
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }            
        // Validate length
            if(myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        }
</script>

</body>
</html>