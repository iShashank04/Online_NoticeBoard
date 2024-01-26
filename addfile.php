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

    $stmt = $conn->prepare("INSERT INTO posts (title, description, image) VALUES (?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("sss", $title, $description, $uploadedImageContent);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Inserted";
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
</head>
<body>
    <form action="addfile.php" method="post" enctype="multipart/form-data">
        <label for="">Title</label>
        <input type="text" name="title" id="">
        <br>
        <br>
        <label for="">Description</label>
        <input type="text" name="description" id="">
        <br>
        <br>
        <label for="">Image</label>
        <input type="file" name="Media" id="">

        <input type="submit" value="submit" name="submit">
    </form>
    
    
</body>
</html>
