<?php
include("index.php");
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $result = $_POST["vote_" . $_POST["id"]]; 
    $submitButtonId = $_POST["id"];
    $rollno = $_SESSION["rollno"];

    $mysql="INSERT INTO results (id,rollno,result) VALUES('$submitButtonId','$rollno','$result')";
    if ($conn->query($mysql) === TRUE) {
        //
     } else {
       echo "Error: " . $mysql . "<br>" . $conn->error;
    }

    $sql = "UPDATE posts SET $result = $result + 1 WHERE id = $submitButtonId";
    if ($conn->query($sql) === TRUE) {
        //
    } else {
        echo "Error updating record: " . $conn->error;
    }

    header("Location: userportal.php");
    exit;


}




?>