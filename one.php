<html>
<head>
<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("para").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("para").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getuser.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>

<form>
<select name="test" onchange="showUser(this.value)">
  <option value="1">CR</option>
  <option value="2">Admin</option>
  <option value="3">3</option>
  </select>
</form>
<br>
<div id="para"><b>What you will excute will be listed here...</b></div>
</body>
</html>