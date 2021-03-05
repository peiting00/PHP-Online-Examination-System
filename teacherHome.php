<?php
    include "security.php";
    $_SESSION["role"] = "teacher";
    include "header.php";
    include "dbConnection.php";
?>

<body>
<br>
    <?php 
        // menu 
        if ($_GET["nav"] == "examList") {
            include "examList_lec.php";
        }
        else if ($_GET["nav"] == "uploadTest") {
            include "addtest.php";
        } else 
        mysqli_close($conn);
    ?>
</body>
</html>