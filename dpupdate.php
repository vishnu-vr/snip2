<?php

    if (isset($_GET['username'])) {

        $username = $_GET['username'];  //eg scs/7026/16
        $name_of_user = $_GET['name_of_user'];  //eg vishnu ramesh

        //username, date and name of user combo separated with "#"
        $user = $username."#".date("Y/m/d/l")."#".$name_of_user;
        //echo $user;
        //Details for connecting to hostinger database
        $servername = "it's_a_secret";
        $dbusername = "it's_a_secret";
        $dbpassword = "it's_a_secret"; 
        $dbname = "it's_a_secret";

        //Create connection
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
        //Create query
        $sql = "INSERT INTO username (user) VALUES ('$user')";

        //if username not null then upload to db
        if ($username != ""){
            //Execute the query
            $conn->query($sql);                
        }

        //Close the connection
        $conn->close();

        echo json_encode("success");
    }
?>


