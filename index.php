<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
<script src="button.js"></script>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/*button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}*/

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
  margin:10px;
  margin-right: 30%;
  margin-left: 30%;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 600px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;  
  }
  .container {
  padding: 16px;
  margin:10px;
  margin-right: 0em;
  margin-left: 0em;
}
}
</style>
</head>
<body>

<h2 align="center"><b>SNIP 2.0</b></h2>

<form action="1.php" method="post">


  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit">Login</button>

  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
  </div>
</form>
<div class="container">
  <hr>
  <h4><p>Example username : SCS/1234/16</p>
    <p>Example password : 1234</p>
  </h4>
</div>
<div class="footer">
  <!-- Use a button to open the snackbar -->
  <button style="background-color:grey;" onclick="myFunction()">&#128519;</button>

  <!-- The actual snackbar -->
  <div id="snackbar">https://github.com/vishnu-vr/snip2</div>
</div>

</body>
</html>
