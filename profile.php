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
    body{
        margin-top: 0px;
    }
    img{
        width: 500px;
        height:300px;
    }
    .main{
        display: flex;
        align-items: center;
        flex-direction: row;
        justify-content: space-between;
        background-color: #6483ed91;
    }
    .main h1{
        margin-left: 450px;
	color: black;
	font-weight: normal;
	font-size: 60px;
    font-weight: 100;
	line-height: 42px;
	text-shadow: 0 2px white, 0 3px #777;
    }
    #user_logo{
        width: 60px;
        height: 60px;
    }
    .info{
        position: relative;
        margin-right: 100px;
    }
    .info h3{
        margin:0px;
    }
    .info .hide{
        visibility: hidden;
        width: 200px;
        background-color: black;
        color: #fff;
        text-align:left;
        padding: 5px 0;
        border-radius: 6px;
    
        top: 100%;
        left: 50%;
        margin-left: -60px;
        position: absolute;
        z-index: 1;
    }
    .info:hover .hide{
        visibility: visible;
    }

    .main_body{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar ul li {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
</style>
<body>
<div class="main">
        <h1> OnBoard ,Students !!!</h1>
        <div class="info"><img id="user_logo" src="user.png" >   
            <span class="hide">  <?php    $roll=$_SESSION["rollno"];
                            echo '<h3> Name:'. htmlspecialchars($name1) . '</h3>';
                            echo '<h3> rollno:'. htmlspecialchars($roll) . '</h3>';?></span>
        </div>
    </div>
<nav class="sidebar">
    <ul>
        <li><a href="userportal.php">Home</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><form action="logout.php" method="post">
        <input style="border:none;" type="submit" value="Logout">
        </form></li>
    </ul>
</nav>
    <div class="main_body">
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
    </div>
</body>
</html>