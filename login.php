<?php
    include("index.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="login.php" method="POST">
        <label for="">ID</label>
        <input type="number" name="id" >
        <label for="">password</label>
        <input type="password" name="password1" id="">
        <input type="submit" value="Submit" name="adminsubmit">
    </form>
    <br><br><br>
    <form action="login.php" method="POST">
        <label for="">Rollno</label>
        <input type="number" name="rollno" >
        <label for="">password</label>
        <input type="password" name="password2" id="">
        <input type="submit" value="Submit" name="usersubmit">
    </form>
</body>
</html>

<?php 


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["adminsubmit"])){
        $id = $_POST["id"];
        $password = $_POST["password1"];
        try{
            $sql = "SELECT password FROM admin_reg WHERE id = '$id'";
            $result = $conn->query($sql);

            if ($result != false){
                if($result->num_rows>0){
                    $row = $result->fetch_assoc();
                    $checkpass = $row["password"];

                    if ($password === $checkpass){
                        $_SESSION["id"] = $id;
                        header("Location:admindashboard.php");
                    }
                    else{
                        echo "password wrong";
                    }
                }
                else{
                    echo "id not found";
                }
            }

        }
        catch(mysqli_sql_exception){
            echo "admin not found";
        }
        
    }
    if(isset($_POST["usersubmit"])){
        $rollno = $_POST["rollno"];
        $password = $_POST["password2"];
        try{
            $sql = "SELECT password FROM users_reg WHERE rollno = '$rollno'";
            $result = $conn->query($sql);

            if ($result != false){
                if($result->num_rows>0){
                    $row = $result->fetch_assoc();
                    $checkpass = $row["password"];

                    if ($password === $checkpass){
                        $_SESSION["rollno"] = $rollno;
                        header("Location:userportal.php");
                    }
                    else{
                        echo "password wrong";
                    }
                }
                else{
                    echo "rollno not found";
                }
            }

        }
        catch(mysqli_sql_exception){
            echo "admin not found";
        }
    }

}

?>
