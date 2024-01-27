<?php
include("index.php");
session_start();
if(!isset($_SESSION["rollno"])){
    header("Location:login.php");
    exit();
}
echo "welcome {$_SESSION["rollno"]}";





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .selected{
        padding: 200px;
    }
    h2{
        color: green;
    }
    img{
        width: 500px;
        height:300px;
    }
</style>
<body>
<form action="logout.php" method="post">
        <input type="submit" value="Logout">
</form>
<a href="profile.php">Profile</a>

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
    echo '<h2>' . htmlspecialchars($title) . '</h2>';
    echo '<p>' . htmlspecialchars($description) . '</p>';
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

   
    echo '<form action="test.php" method = "post">';
    echo '<input type="radio" name="vote_' . htmlspecialchars($id) . '" value="likes" required ><span>Like</span>';
    echo '<input type="radio" name="vote_' . htmlspecialchars($id) . '" value="dislikes" required><span>Dislike</span>';
    echo '<input type="submit" name="submit" value="Submit" ' . ($disable ? 'disabled' : '') . '>';
    echo '<input type="hidden" name="id" value="' . htmlspecialchars($id) . '">'; 


    echo '</form>';
   
    echo '</div>';
    echo '<hr>';
}


?>
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