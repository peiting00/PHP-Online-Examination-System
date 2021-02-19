<?php
    session_start();
    $_SESSION["role"] = "admin";
    include "html/header.php";
    include "dbConnection.php";
?>

<script>
    $(document).ready(function () {
        $('#student_table').DataTable({
            "autoWidth": false,
            scrollX: true
        });

        $('#teacher_table').DataTable({
            autoWidth: false,
            scrollX: true,
            columnDefs: [{
                            "targets": 6, 
                            "className": "text-center",
                            "width": "5%"
                        }],
        });
    });
</script>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.css"/>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/datatables.min.js"></script>
</head>
<style>
    table.dataTable tr.odd { 
        background-color: #E9E6E1; 
    }

    table.dataTable tr.even { 
        background-color: #F7F7F7; 
    }

    table.dataTable tr.odd td.sorting_1 {
        background-color: #E9E6E1; 
    }

    table.dataTable tr.even td.sorting_1 { 
        background-color: #F7F7F7; 
    }

    .dataTables_wrapper .dataTables_filter {
        float: right;
        text-align: right;
    }
</style>
<body>
<br>
    <?php 
        if ($_GET["nav"] == "studentList") {
            include "studentList.php";
        } else if ($_GET["nav"] == "addTeacher") {
            include "addTeacher.php";
        } else if ($_GET["nav"] == "viewTest") {
            include "viewTest.php";
        }
    ?>
</body>
</html>