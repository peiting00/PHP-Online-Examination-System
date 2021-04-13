<?php

include "dbConnection.php";

// Create table if not exists
$courseSql = "CREATE TABLE IF NOT EXISTS course (
    courseID VARCHAR(10) NOT NULL PRIMARY KEY,
    courseName VARCHAR(60) NOT NULL)";

$facultySql = "CREATE TABLE IF NOT EXISTS faculty (
    facultyID VARCHAR(10) NOT NULL PRIMARY KEY,
    facultyName VARCHAR(60) NOT NULL)";

$adminSql = "CREATE TABLE IF NOT EXISTS admin (
    adminID VARCHAR(10) NOT NULL PRIMARY KEY, 
    adminName VARCHAR(40) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password_hash CHAR(60) NOT NULL)";

$teacherSql = "CREATE TABLE IF NOT EXISTS teacher (
    teacherID VARCHAR(10) NOT NULL PRIMARY KEY, 
    teacherName VARCHAR(40) NOT NULL,
    facultyID VARCHAR(10) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password_hash CHAR(60) NOT NULL,
    FOREIGN KEY (facultyID) REFERENCES faculty(facultyID))";

$studentSql = "CREATE TABLE IF NOT EXISTS student (
    studentID VARCHAR(10) NOT NULL PRIMARY KEY,
    studentName VARCHAR(40) NOT NULL, 
    email VARCHAR(50) NOT NULL,
    courseID VARCHAR(10) NOT NULL,
    password_hash CHAR(60) NOT NULL,
    FOREIGN KEY (courseID) REFERENCES course(courseID))";

$examSql = "CREATE TABLE IF NOT EXISTS exam (
    examID int NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    examTitle VARCHAR(50) NOT NULL,
    courseID VARCHAR(10) NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    duration INT(5) NOT NULL,
    totalQuestion INT(5) NOT NULL,
    rightAnsMark FLOAT(5) NOT NULL,
    wrongAnsMark FLOAT(5) NOT NULL,
    teacherID VARCHAR(30) NOT NULL,
    FOREIGN KEY (courseID) REFERENCES course(courseID))";

$teacher_courseSql = "CREATE TABLE IF NOT EXISTS teacher_course (
    tc_course int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    teacherID VARCHAR(30) NOT NULL,
    courseID VARCHAR(30) NOT NULL,
    FOREIGN KEY (teacherID) REFERENCES teacher(teacherID))
    FOREIGN KEY (courseID) REFERENCES course(courseID))";

$questionSql = "CREATE TABLE IF NOT EXISTS question (
    questionID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    examID int NOT NULL,
    question VARCHAR(100) NOT NULL, 
    option1 VARCHAR(50) NOT NULL,
    option2 VARCHAR(50) NOT NULL,
    option3 VARCHAR(50) NOT NULL,
    option4 VARCHAR(50) NOT NULL,
    answer VARCHAR(50) NOT NULL";

$resultSql = "CREATE TABLE IF NOT EXISTS result (
    resultID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    studentID VARCHAR(10) NOT NULL,
    examID int NOT NULL,
    questionID int NOT NULL,
    studentAns VARCHAR(50) NOT NULL,
    correctAns VARCHAR(50) NOT NULL,
    result VARCHAR(10) NOT NULL,
    marks FLOAT(10) NOT NULL,
    FOREIGN KEY (studentID) REFERENCES student(studentID),
    FOREIGN KEY (examID) REFERENCES exam(examID),
    FOREIGN KEY (questionID) REFERENCES question(questionID))";
    
if (mysqli_query($conn, $courseSql) && mysqli_query($conn, $facultySql) && mysqli_query($conn, $adminSql) && mysqli_query($conn, $teacherSql) && mysqli_query($conn, $studentSql)
    && mysqli_query($conn, $examSql) && mysqli_query($conn, $questionSql) && mysqli_query($conn, $resultSql)) {
    header("Location:login.php");
    exit;
} else {
    echo "Failed to create table: ".mysqli_error($conn);
}

mysqli_close($conn);
?>