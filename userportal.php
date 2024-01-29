<?php
include("index.php");
session_start();
if(!isset($_SESSION["rollno"])){
    header("Location:login.php");
    exit();
}
$name=$conn->query("SELECT name FROM users_reg WHERE rollno='{$_SESSION["rollno"]}'");
while ($row = mysqli_fetch_assoc($name)) {

    $name1=$row['name'];
}




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
    .selected{
        padding: 200px;
    }
    img{
        width: 500px;
        height:300px;
    }
    .post{
        border: 10px solid #BA8C63;
        background-color: #274C43;
        width:700px;
        height: 480px;
        color:azure;
        padding: 20px;
        display: flex;
        align-items: center;
        flex-direction: column;
        border-radius: 30px;
    }
    .title{
        margin: 0px;
        font-size: 32px;
        font-family: 'Oswald', sans-serif;
    }
    .desc{
        margin: 0px;
    }
    .sep{
        height: 20px;
        width: 100%;
    }
    /* .title{
        width:100%;
        height:200px;
        position: sticky;
    } */
    .main{
        display: flex;
        align-items: center;
        flex-direction: row;
        justify-content: space-between;
        background-color: black;
        position: sticky;
        top:0;
        margin-bottom: 8px;
    }
    .main h1{
        margin-left: 450px;
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
        margin-left: 210px;
        /*justify-content: center; */
        background-image: url('bg.jpg');
        background-repeat: no-repeat;
        background-size: cover;
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
                        color: black;
}
.side_inp:hover{
    background-color: #f1f1f1;
}
.reaction{
    margin-top: 15px;
    margin-right: 50px;
}
.react_icon{
    width: 40px;
    height: 50px;
}
.react_icon:active{
    transform: scale(1.5);

}
.reaction_sub{
    padding-top: 15px;
    padding-left: 5px;
    padding-right: 5px;
    margin-left: 100px;
}

.reaction_sub
</style>
<body>
    <!-- <img class="title" src="title.jpg" alt=""> -->
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
            <li style="padding-left: 11px;"><form action="logout.php" method="post">
            <input class="side_inp" type="submit" value="Logout">
            </form></li>
        </ul>
    </nav>
<div class="main_body">
<?php
$result = $conn->query("SELECT * FROM posts ORDER BY `time` DESC");
while ($row = $result->fetch_assoc()) {
    $id = $row["id"];
    $title = $row["title"];
    $description = $row["description"];
    $imageData = $row["image"];
    $likes = $row["likes"];
    $dislikes = $row["dislikes"];
    $date = $row["time"];

    echo '<div class="post">';
    echo '<h2 class="title">' . htmlspecialchars($title) . '</h2>';
    echo '<p class="desc">' . htmlspecialchars($description) . '</p>';
    echo '<p>' . htmlspecialchars($date) . '</p>';
    $imageInfo = getimagesize("data:image/jpeg;base64," . base64_encode($imageData));
    if ($imageInfo !== false) {
        // It's an image
        echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Image" />';
    } else {
        // It's not an image, you can handle PDF or other file types accordingly
        echo '<embed src="data:application/pdf;base64,' . base64_encode($imageData) . '" width="500px" height="300px" />';
    }

    $disable = false;
    $result1 = $conn->query("SELECT * FROM results WHERE id = $id and rollno = '{$_SESSION["rollno"]}'");
    if ($result1) {
        $rowCount = $result1->num_rows;
        if ($rowCount>0){
            $disable = true;
        }
    } else {
        echo "Error executing query: " . $conn->error;
    }
    

    echo '<form class="reaction" action="test.php" method = "post">';
    echo '<label class="reaction_sub">';
    echo '<input type="radio" name="vote_' . htmlspecialchars($id) . '" value="likes" required style="display:none;" ><span><img class="react_icon" src="like.png" alt=""></span>';
    echo '</label>';
    echo '<label class="reaction_sub">';
    echo '<input type="radio" name="vote_' . htmlspecialchars($id) . '" value="dislikes" required style ="display:none;"><span><img class="react_icon" src="dislike.png" alt=""></span>';
    echo '</label>';
    echo '<br>';
    echo '<input style="margin-left:165px; background-color:whitesmoke;color:black;border-radius:15px;" type="submit" name="submit" value="Submit" ' . ($disable ? 'disabled' : '') . '>';
    echo '<input type="hidden" name="id" value="' . htmlspecialchars($id) . '">'; 


    echo '</form>';
   
    echo '</div>';
    echo '<div class="sep"></div>';
}


?>
</div>
<script>
    let radio_btns = document.querySelectorAll(`input[type='radio']`);

    radio_btns.forEach((radio) => {
        radio.addEventListener('change', () => {
            console.log(`${radio.value}`);

          
        });
    });
</script>

    
</body>
</html>