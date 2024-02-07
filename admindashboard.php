<?php
include("index.php");
session_start();
if(!isset($_SESSION["id"])){
    header("Location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color:#d7d2cb;
        }
        h1{

            margin-left: 10px;
        }
        .grid-container{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }
        .post{
            width: 225px;
            height: 200px;
            padding: 50px;
            background-color: blanchedalmond;
            margin: 10px;
            word-wrap:break-word;
        }
        .options{
            display: flex;
            flex-direction: row-reverse;
            justify-content: space-between;
            margin-left:20px;
            margin-right:20px;
        }
        .options a{
            color:black;
            text-decoration: none;
        }
        .options a h2 {
            margin: 0px;
        }
        .options a:visited{
            color: black;
        }
    </style>
</head>
<body>
    <h1>Welcome Admin</h1>
    <div class="options">
    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
    <a href="addfile.php"><h2>Add +</h2> </a>
    </div>
    <br>

    <?php
        $result = $conn->query("SELECT * FROM posts ORDER BY `time` DESC");
        echo '<div class="grid-container">';
        while ($row = $result->fetch_assoc()) {
            $title = $row["title"];
            $description = $row["description"];
           
            $likes = $row["likes"];
            $dislikes = $row["dislikes"];
            $date = $row["time"];
            $post_id = $row["post_id"];

            if($post_id == $_SESSION["id"]){

            echo '<div class="post">';
            echo '<h2>' . htmlspecialchars($title) . '</h2>';
            echo '<p>' . htmlspecialchars($description) . '</p>';
            echo '<p>' . htmlspecialchars($date) . '</p>';

            echo '</div>';
            }
        }

        echo '</div>';

?>

</body>
</html>