<?php
    function showData(){
        $servername = "it's_a_secret";
        $username = "it's_a_secret";
        $password = "it's_a_secret";
        $dbname = "it's_a_secret";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        //$conn_for_answers = new mysqli($servername, $username, $password, $dbname_for_answers);
        // Check connection to both the databases
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        echo "Connected successfully";
        echo "<br>";


        $sql = "SELECT * FROM username";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo $row["user"]. "<br>";
                // array_push($data,$row["user"]);
            }
        }

        $conn->close();
    }
?>

<form method="post" action="">
<input type="password" name="pass">
<input type="submit">
</form>

<?php
    $pass = $_POST["pass"];
    if ($pass == "it's_a_secret"){
        showData();
    }
?>


