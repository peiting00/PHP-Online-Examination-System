<?php
    include "security.php";
    $_SESSION["role"] = "admin";
    include "header.php";
    include "dbConnection.php";
    include "dataTable.php";
    $username = $_SESSION["username"];
?>

<body>
<br>
    <?php 
        // menu 
        if ($_GET["nav"] == "studentList") {
            include "studentList.php";
        } else if ($_GET["nav"] == "teacherList") {
            include "teacherList.php";
        } else if ($_GET["nav"] == "examList") {
            include "examList.php";
        }
        mysqli_close($conn);
    ?>
</body>
</html>