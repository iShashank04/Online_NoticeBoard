<?php
include("index.php");
session_start();
if(!isset($_SESSION["rollno"])){
    header("Location:login.php");
    exit();
}

$rollno = $_SESSION["rollno"];
$likedpost = array();
$dislikedpost = array();
$name=$conn->query("SELECT name,email FROM users_reg WHERE rollno='{$_SESSION["rollno"]}'");
while ($row = mysqli_fetch_assoc($name)) {

    $name1=$row['name'];
    $email=$row['email'];
}

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
    .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 500px;
        }
        .container h1{
            text-align: center;
            color: #333;
        }
        .profile-info {
            margin-top: 20px;
        }
        .profile-info p {
            margin: 10px 0;
        }
        #profile-image {
            display: block;
            margin: 0 auto;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
    .main{

        align-items: center;
        height: 160px;
        justify-content: space-between;
        background-color: black;
        position: sticky;
        top:0px;
        margin-bottom: 8px;
    }
    .main h1{
        margin-left: 450px;
        margin-top: 0px;
        padding-top: 50px;
	color: #fbf6f6;
	font-weight: normal;
	font-size: 60px;
    font-weight: 100;
	line-height: 42px;
	text-shadow: 0 2px #030202, 0 3px #777;
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
        margin-left: 210px;
        background-image: url('bg.jpg');
        background-repeat: no-repeat;
        background-size: cover;
    }
    td{
        text-align: center;
    }
    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
      background-color: #f2f2f2;
    }

    th {
      border: 1px solid black;
      background-color: #f2f2f2;
    }


    th:first-child {
      border-right: 1px solid black;
    }

    th:last-child {
      border-left: 1px solid black;
    }
    .sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #acacac;;
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
.sidebar ul li:hover{
    background-color: #f1f1f1;
}
.sidebar ul li a{
    text-decoration: none;
    font-size: 26px;
    font-family: fantasy;
    color: black;
}
.side_inp{
    border:none; background-color:#acacac;font-size: 26px;
                        font-family: fantasy;
                padding-left:0px;
                color: black;
}
.side_inp:hover{
    background-color: #f1f1f1;
}
</style>
<body>
<div class="main">
        <h1> OnBoard ,Students !!!</h1>
        <!-- <div class="info"><img id="user_logo" src="user.png" >   
            <span class="hide">  <?php    $roll=$_SESSION["rollno"];
                            echo '<h3> Name:'. htmlspecialchars($name1) . '</h3>';
                            echo '<h3> rollno:'. htmlspecialchars($roll) . '</h3>';?></span>
        </div> -->
    </div>
<nav class="sidebar">
    <ul>
        <li><a href="userportal.php">Home</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><form action="logout.php" method="post">
        <input class="side_inp" type="submit" value="Logout">
        </form></li>
    </ul>
</nav>
    <div class="main_body">
<div class="container">
        <h1>User Profile</h1>
        <input type="file" id="file-input" accept="image/*" style="display: none;">
        <label for="file-input">
            <img id="profile-image" src="default-profile-image.jpg" alt="Profile Picture">
            <div style="text-align: center; color: blue;">Click to Change Profile Picture</div>
        </label>
        <div class="profile-info">
            <?php
            echo '<p><strong>Name:</strong>'. htmlspecialchars($name1) .'</p>';
            echo '<p><strong>Email:</strong>'. htmlspecialchars($email) .'</p>';
            echo '<p><strong>Roll no:</strong>'. htmlspecialchars($roll) .'</p>';
            ?>
        </div>
    </div>
    <table>
    <tr>
    <th>Likes</th>
    <th>Dislikes</th>
    </tr>
    <tr>
    <td>
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
    </td>

    <td>
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
    </td>
    </tr>
    </table>
    </div>
    <script>
         const fileInput = document.getElementById('file-input');
        const profileImage = document.getElementById('profile-image');

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profileImage.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
