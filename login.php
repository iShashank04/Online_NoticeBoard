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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('bg3.png');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .login-container {
            margin-left: 700px;
            background-color: #333333;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .login-container label {
            display: block;
            margin-bottom: 8px;
            color: white;
        }

        .login-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #sub{
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #sub:hover {
            background-color: #45a049;
        }
        .login-header{
            color: whitesmoke;
            display: flex;
            flex-direction: row;
            
        }
        .login-container table{
            color: whitesmoke;
            text-align: center;
            width: 100%;
            border-bottom: solid 1px whitesmoke;
            margin-bottom: 10px;
        }
        .mode{
            background-color: #333333;
            border: none;
            color: whitesmoke;
        }
        .mode:hover{
            cursor: pointer;
        }
        p{
            color: whitesmoke;
            margin-left: 700px;
        }
        a:visited{
            color:aquamarine;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h2 style="color: whitesmoke; margin-left: 700px;font-size: 50px;">Login</h2>
<div class="login-container">
    <table>
        <tr>
            <td style="border-right: solid 1px whitesmoke;"><button class="mode" onclick="adminMode()"><h3>admin</h3></button></td>
            <td style="padding-left: 10px;"><button class="mode" onclick=userMode()><h3>user</h3></button></td>
        </tr>
    </table>
    <form action="login.php" method="POST">
        <label for="username" id="u1">Roll No:</label>
        <input id="u1_value" type="text" id="username" name="rollno" required>

        <label for="password">Password:</label>
        <input id="u2_value" type="password" name="password2" required>

        <button id="sub" type="submit" value="Submit" name="usersubmit">Login</button>
    </form>
</div>
    <p>Are you new to the platform?Then <a href="register.php">Register</a> now</p>
<script>
    function adminMode(){
        document.getElementById("u1").innerText = "ID:";
        var1=document.getElementById("u1_value")
        var1.setAttribute("name","id");
        var_val1=document.getElementById("u2_value")
        var_val1.setAttribute("name","password1");
        var2=document.getElementById("sub")
        var2.setAttribute("name","adminsubmit");
    }
    function userMode(){
        document.getElementById("u1").innerText = "Roll No:";
        var1=document.getElementById("u1_value")
        var1.setAttribute("name","rollno");
        var_val1=document.getElementById("u2_value")
        var_val1.setAttribute("name","password2");
        var2=document.getElementById("sub")
        var2.setAttribute("name","usersubmit");
    }   
</script>
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
                        echo "<h2 style='color:white'>password wrong</h2>";
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
