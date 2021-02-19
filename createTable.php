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

    
if (mysqli_query($conn, $courseSql) && mysqli_query($conn, $facultySql) && mysqli_query($conn, $adminSql) && mysqli_query($conn, $teacherSql) && mysqli_query($conn, $studentSql)) {
    header("Location:login.php");
    exit;
} else {
    echo "Failed to create table: ".mysqli_error($conn);
}

mysqli_close($conn);
?>