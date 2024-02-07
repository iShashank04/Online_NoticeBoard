<?php
include("index.php");
session_start();

echo $_SESSION["id"];
if(!isset($_SESSION["id"])){
    header("Location:login.php");
    exit();
}

if(isset($_POST["submit"])){
    echo "working";
    $title = $_POST["title"];
    $description = $_POST["description"];
    if (isset($_FILES["Media"]) && $_FILES["Media"]["error"] == 0) {
        
        
        $tempFilePath = $_FILES['Media']['tmp_name'];

        $uploadedImageContent = file_get_contents($tempFilePath);

        //$base64Image = base64_encode($uploadedImageContent);
    }

    $stmt = $conn->prepare("INSERT INTO posts (title, description, image,post_id) VALUES (?, ?, ?,?)");

    // Bind parameters
    $stmt->bind_param("ssss", $title, $description, $uploadedImageContent,$_SESSION["id"]);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Inserted";
        header("Location:admindashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
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
            background-color: #d7d2cb;
        }
        .addfile{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 175px;
            margin-left: 620px;
            border: 2px solid black;
            background-color: blanchedalmond;
            width:300px;
            height: 280px;
            border-radius: 20px;
        }
        form{
            display:flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div class="addfile">
    <form action="addfile.php" method="post" enctype="multipart/form-data">
        <label for="">Title</label>
        <input type="text" name="title" id="">
        <br>
        <label for="">Description</label>
        <input type="text" name="description" id="">
        <br>
        <label for="">Image</label>
        <input type="file" name="Media" id="">
        <br>
        <input type="submit" value="submit" name="submit">
    </form>
    </div>
    
</body>
</html>
