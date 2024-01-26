<?php 
    include("index.php");

    if(isset($_POST["submit"])){

        
        if(isset($_POST["name"])){
        $nam = $_POST["name"];
        }
        
        if(isset($_POST["rollno"])){
            $rollno = (int)$_POST["rollno"];
            }
        if(isset($_POST["branch"])){
            $branch = $_POST["branch"];
            }
        if(isset($_POST["year"])){
            $year = (int)$_POST["year"];
                }
        if(isset($_POST["email"])){
            $email = $_POST["email"];
                    }
        if(isset($_POST["password"])){
                        $password = $_POST["password"];
                        }
    $mysql="INSERT INTO users_reg (name,rollno,branch,year,email,password) VALUES('$nam','$rollno','$branch','$year','$email','$password')";

    if ($conn->query($mysql) === TRUE) {
        $url = 'login.php';
        header('Location: '.$url);
            die();
     } else {
       echo "Error: " . $mysql . "<br>" . $conn->error;
    }

    


}
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form  in HTML | CodingNepal</title>
    <style>
       

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Open Sans', sans-serif;
}

body {
  
    margin-top: 3%;
    margin-right: 3%;
    scroll-margin-right: 50px;
    background-size: 100px 100px auto;
    height: 90vh;
    width: 100vw;
    background-image: url('bg3.png');
    background-repeat: no-repeat;
    background-size: cover;
  
}
::-webkit-scrollbar{
    width: 10px;
}
form {
  padding: 40px;
  background: #333333;
  max-width: 500px;
  width: 100%;
  margin-left: 850px;
  border-radius: 5px;
  box-shadow: 0 10px 13px rgba(153, 149, 149, 0.05);
  scroll-margin-right: 50px;
}

form h2 {
    color: whitesmoke;
  font-size: 33px;
  text-align: center;
  margin-bottom: 50%;
  margin: 0px 0 30px;
}

form .form-group {
  margin-bottom: 15px;
  position: relative;
}

form label {
    color: whitesmoke;
  display: block;
  font-size: 13px;
  margin-bottom: 5px;
}

form input,
form select {
  height: 40px;
  padding: 10px;
  width: 100%;
  font-size: 15px;
  outline: none;
  background: #fff;
  border-radius: 3px;
  border: 1px solid #fef1f1;
}
form input:focus,
form select:focus {
  border-color: #121212;
}

form input.error,
form select.error {
  border-color: #f91919;
  background: #e3b3b9;
}

form small {
  font-size: 14px;
  margin-top: 5px;
  display: block;
  color: #f91919;
}

form .password i {
  position: absolute;
  right: 0px;
  height: 40px;
  top: 28px;
  font-size: 13px;
  line-height: 40px;
  width: 45px;
  cursor: pointer;
  color: #100f0f;
  text-align: center;
}
.submit-btn {
  margin-top: 28px;
}

.submit-btn input {
  color: white;
  border: none;
  height: auto;
  font-size: 15px;
  padding: 13px 0;
  border-radius: 4px;
  cursor: pointer;
  font-weight: 500;
  text-align: center;
  background: #35cb76;
  transition: 0.2s ease;
}

.submit-btn input:hover {
  background: #252424;
}
    </style>
  </head>
  <body>
    <form action="register.php" method="POST">
      <h2 >Registration Form</h2>
      <div class="form-group fullname">
        <label for="fullname">Full Name</label>
        <input name="name" type="text" id="fullname" placeholder="Enter your full name">
      </div>
      <div class="form-group RollNUmber">
        <label for="Roll Number">Roll number</label>
        <input name="rollno" type="text" id="Roll number" placeholder="Enter your roll number">
      </div>
      <div class="form-group branch">
        <label for="branch">Branch</label>
        <select name="branch" id="gender">
          <option value="" selected disabled>Select your branch</option>
          <option value="CSE">CSE</option>
          <!-- <option value="IT">IT</option> -->
          <!-- <option value="ECE">ECE</option> -->
          <!-- <option value="EEE">EEE</option> -->
          <!-- <option value="MECH">MECH</option> -->
          <!-- <option value="CHEM">CHEM</option> -->
          <!-- <option value="CIVIL">CIVIL</option> -->
        </select>
      </div>
      <div class="form-group year">
        <label for="year">Year</label>
        <select name="year" id="year">
          <option value="" selected disabled>Select your year</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
      </div>

      <div class="form-group email">
        <label for="email">Email Address</label>
        <input name="email" type="text" id="email" placeholder="Enter your email address">
      </div>
      <div class="form-group password">
        <label for="password">Password</label>
        <input name="password" type="password" id="password" placeholder="Enter your password">
        <i id="pass-toggle-btn" class="fa-solid fa-eye"></i>
      </div>
      <div class="form-group confirm password">
        <label for="confirm password">Confirm Password</label>
        <input name="confirmpassword" type="confirm password" id="confirm password" placeholder="Enter your password">
        <i id="pass-toggle-btn" class="fa-solid fa-eye"></i>
      </div>


      <div class="form-group submit-btn">
        <input name="submit" type="submit" value="Submit">
      </div>
    </form>

  </body>
</html>