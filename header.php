<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> 
    <link rel="stylesheet" href="css/header.css">
    <!-- Rotobo Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<script>
</script>
<body>
    <!-- Image and text -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <a class="navbar-brand" style="color: #F7F7F7; font-weight: 500;" href="adminHome.php">
            Online Examination System
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" style="margin-left: 10px;" id="navbarNav">
          <ul class="navbar-nav">
            <?php 
              if ($_SESSION["role"] == "admin") {
                echo "<li class='nav-item active'>";
                  echo "<a class='nav-link' href='adminHome.php?nav=studentList'>Student List<span class='sr-only'>(current)</span></a>";
                echo "</li>";
                echo "<li class='nav-item'>";
                  echo "<a class='nav-link' href='adminHome.php?nav=teacherList'>Teacher List</a>";
                echo "</li>";
                echo "<li class='nav-item'>";
                  echo "<a class='nav-link' href='adminHome.php?nav=examList'>Exam List</a>";
                echo "</li>";
                echo "<li class='nav-item'>";
                    echo "<a class='nav-link' href='logout.php'>Logout</a>";
                echo "</li>";
              } else if ($_SESSION["role"] == "teacher") {
                echo "<li class='nav-item active'>";
                  echo "<a class='nav-link' href='teacherHome.php?nav=examList'>Exam List</a>";
                echo "</li>";
                echo "<li class='nav-item'>";
                  echo "<a class='nav-link' href='teacherHome.php?nav=uploadTest'>Upload Test<span class='sr-only'>(current)</span></a>";
                echo "</li>";
                echo "<li class='nav-item'>";
                  echo "<a class='nav-link' href='logout.php'>Logout</a>";
                echo "</li>";
              } else if ($_SESSION["role"] == "student") {
                echo "<li class='nav-item active'>";
                  echo "<a class='nav-link' href='studentHome.php?nav=takeTest'>Take Test<span class='sr-only'>(current)</span></a>";
                echo "</li>";
                echo "<li class='nav-item'>";
                  echo "<a class='nav-link' href='studentHome.php?nav=viewHistory'>View History<span class='sr-only'>(current)</span></a>";
                echo "</li>";
                echo "<li class='nav-item'>";
                  echo "<a class='nav-link' href='logout.php'>Logout</a>";
                echo "</li>";
                echo "<li class='nav-item' class='nav justify-content-end'>";
                  echo "<a class='nav-link active justify-content-end'>";
                echo "   | Welcome, ".$_SESSION['username']." !</a>";
                echo "</li>";
              }
            ?>
          </ul>
        </div>
    </nav> 
</body>
</html>
