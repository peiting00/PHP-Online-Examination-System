<?php
    include "security.php";
    $_SESSION["role"] = "student";
    include "header.php";
    include "dbConnection.php";
?>

<body>
<br>
    <?php 
        // menu 
        if ($_GET["nav"] == "viewHistory") {
            include "resultList_stu.php";
        } else 
        mysqli_close($conn);
    ?>
</body>
