<?php 
include("index.php");
?>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);


if ($q == 1){

$result = $conn->query("SELECT * FROM posts WHERE post_id = 200");

while($row = $result->fetch_assoc()) {
    echo $row['title'];
  
}

}

if ($q == 2){

    $result = $conn->query("SELECT * FROM posts WHERE post_id = 100");
    
    while($row = $result->fetch_assoc()) {
        echo $row['title'];
      
    }
    
    }


?>
</body>
</html>