<?php
include("index.php");
session_start();
if(!isset($_SESSION["rollno"])){
    header("Location:login.php");
    exit();
}
echo "welcome {$_SESSION["rollno"]}";

$rollno = $_SESSION["rollno"];
$likedpost = array();
$dislikedpost = array();


$mysql = "SELECT `id`, `result` FROM `results` WHERE `rollno` = ?";
$stmt = $conn->prepare($mysql);
$stmt->bind_param("s", $rollno);
$stmt->execute();
$result = $stmt->get_result();
echo "<br>";
if ($result) {
    
    
    while ($row = $result->fetch_assoc()) {
        if($row['result'] == "likes"){
            array_push($likedpost,$row['id']);
        }
        else{
            array_push($dislikedpost,$row['id']);
        }
    }
    
} else {
    echo "Error: " . $mysql . "<br>" . $conn->error;
}

$stmt->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    img{
        width: 500px;
        height:300px;
    }
</style>
<body>
    <h1>Likes</h1>
    <?php
    foreach($likedpost as $postid){
        $mysql = "SELECT * FROM `posts` WHERE `id` = ?";
        $stmt = $conn->prepare($mysql);
        $stmt->bind_param("s", $postid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                
                echo '<div class="post">';
                echo '<h2>' . htmlspecialchars($row['title']) . '</h2>';
                echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                echo '<p>' . htmlspecialchars($row['time']) . '</p>';
                $imageInfo = getimagesize("data:image/jpeg;base64," . base64_encode($row['image']));
                if ($imageInfo !== false) {
                    // It's an image
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="Image" />';
                } else {
                    // It's not an image, you can handle PDF or other file types accordingly
                    echo '<embed src="data:application/pdf;base64,' . base64_encode($row['image']) . '" width="500px" height="300px" />';
                }
            }
            
        } else {
            echo "Error: " . $mysql . "<br>" . $conn->error;
        }

    }
    ?>


    <h1>Dislikes</h1>
    <?php
    foreach($dislikedpost as $postid){
        $mysql = "SELECT * FROM `posts` WHERE `id` = ?";
        $stmt = $conn->prepare($mysql);
        $stmt->bind_param("s", $postid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                
                echo '<div class="post">';
                echo '<h2>' . htmlspecialchars($row['title']) . '</h2>';
                echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                echo '<p>' . htmlspecialchars($row['time']) . '</p>';
                $imageInfo = getimagesize("data:image/jpeg;base64," . base64_encode($row['image']));
                if ($imageInfo !== false) {
                    // It's an image
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="Image" />';
                } else {
                    // It's not an image, you can handle PDF or other file types accordingly
                    echo '<embed src="data:application/pdf;base64,' . base64_encode($row['image']) . '" width="500px" height="300px" />';
                }
            }
            
        } else {
            echo "Error: " . $mysql . "<br>" . $conn->error;
        }

    }
    ?>
</body>
</html>