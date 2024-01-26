<?php
include("index.php");
session_start();
if(!isset($_SESSION["id"])){
    header("Location:login.php");
    exit();
}
echo $_SESSION["id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
    <br>

    <?php
        $result = $conn->query("SELECT * FROM posts ORDER BY `time` DESC");
        while ($row = $result->fetch_assoc()) {
            $title = $row["title"];
            $description = $row["description"];
           
            $likes = $row["likes"];
            $dislikes = $row["dislikes"];
            $date = $row["time"];

            echo '<div class="post">';
            echo '<h2>' . htmlspecialchars($title) . '</h2>';
            echo '<p>' . htmlspecialchars($description) . '</p>';
            echo '<p>' . htmlspecialchars($date) . '</p>';
            echo '<p>Likes ' . htmlspecialchars($likes) . '</p>';
            echo '<p>Dislikes ' . htmlspecialchars($dislikes) . '</p>';
            echo '</div>';
            echo '<hr>';
        }


?>



    <a href="addfile.php">Add + </a>
</body>
</html>