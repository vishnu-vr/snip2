<?php
    
    function showData(){

        //count the number of hits
        function countHits($inp) {
            
            $keys = array_keys($inp);   //array containing keys from $inp dictionary

            $count = 0;
            for ($x = 0; $x < sizeof($keys); $x++) {
                //if my key found do not count
                if($keys[$x] == "vishnu"){
                    continue;
                }
                else{
                    $count += $inp[$keys[$x]]["count"];
                }
            }
            return $count;
        }

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
        //echo "<br><br>";

        $sql = "SELECT * FROM username";
        $result = $conn->query($sql);
        $conn->close();

        
        $data = []; //for usernames and name_of_user (ie eg scs/7026/16 and vishnu ramesh)
        $date = [];//for usernames, date and name_of_user (ie eg scs/7026/16 and vishnu ramesh)

        //pushing the rows into data array
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                //echo $row["user"]. "<br>";

                $row_from_db = $row["user"];

                //if its an empty row 
                //or the first character are "#"
                //(ie empty username) then continue
                if ($row_from_db == "" or substr($row_from_db,0,1) == "#"){
                    continue;
                }

                //splitting username, date and name_of_user
                $datarr = explode("#",$row_from_db);

                //only pushing usernames to data array
                //if my username found replace username with name
                if($datarr[0] == "SCS/7026/16"){
                    array_push($data,"vishnu");
                }
                else{
                    //if length of $datarr == 3 it contains (username # date # name_of_user)
                    if(sizeof($datarr) == 3){
                        //eg $datarr[0] : "SCS/7026/16"
                        //$datarr[1] : "2020/4/1/monday"
                        //$datarr[2] : "vishnu ramesh"
                        array_push($data,$datarr[0]." - ".$datarr[2]);  //eg SCS/7026/16 - vishnu ramesh 
                    }
                    //if it doesn't contain name_of_user
                    //then only push username
                    else{
                        array_push($data,$datarr[0]);   //eg $datarr[0] : "SCS/7026/16"
                    }
                    
                }
                
                //pushing username, date and name_of_user to date array
                //if $datarr contains a thrid section (ie name_of_user)
                if(sizeof($datarr) == 3){
                    //if my username found replace username with my name
                    //and push name with date
                    if ($datarr[0] == "SCS/7026/16"){
                        array_push($date,"vishnu"." - ".$datarr[1]);
                    }
                    else{
                        //pushing username - date - name_of_user
                        //eg scs/7026/16 - 2020/3/12/monday - vishnu ramesh
                        array_push($date,$datarr[0]." - ".$datarr[1]." - ".$datarr[2]);
                    }
                }
                //else if it only contains username and date but doesn't contain name_of_user
                else if(sizeof($datarr) == 2){
                    //if my uername found replace username with my name
                    if ($datarr[0] == "SCS/7026/16"){
                        array_push($date,"vishnu"." - ".$datarr[1]);
                    }
                    else{
                        //pushing username - date
                        //eg scs/7026/16 - 2020/3/12/monday
                        array_push($date,$datarr[0]." - ".$datarr[1]);
                    }
                }            

            }
        }

        //print_r($date);
    	echo "<br><br>";


        //#######################################
        //##      USERNAME HITS SECTION      ###
        //#######################################

    	$clean = array();  //more like a python dictionary
        
        //eliminating duplicates
    	for ($x = 0; $x < sizeof($data); $x++) {

            //if its an empty request don't consider
            if ($data[$x] == ""){
                continue;
            }

            //splitting $data into username and name_of_user
            // $data_split[0] : username    eg scs/7026/16
            // $data_split[1] : name_of_user    eg vishnu ramesh
            $data_split = explode(" - ",$data[$x]);

            //if the key doesn't exist then add and set count as 1
            if (array_key_exists($data_split[0], $clean) == false){
                //if size of $data_split == 2 then
                //it contains both username and name_of_user 
                if(sizeof($data_split) == 2){
                    //set first index to 1 (count index)
                    $clean[$data_split[0]] = ["count"=>1,"name"=>$data_split[1]]; //[1,$data_split[1]];
                }
                //else if size of $data_split == 1 then
                //it only contains username
                else{
                    $clean[$data_split[0]] = ["count"=>1];
                }

            }
            //else if username already exists
            else {

                //incrementing the count
                $clean[$data_split[0]]["count"] += 1;

                //if size of $data_split == 2 then
                //it contains both username and name_of_user 
                if(sizeof($data_split) == 2){
                    //checking whether this (ie current username) contains name_of_user
                    //if it doesn't then add name_of_user
                    //if size of the key(ie username) == 1
                    //then it doesn't contain name_of_user
                    if(sizeof($clean[$data_split[0]]) == 1){
                        $clean[$data_split[0]]["name"] = $data_split[1];
                    }
                }
            }                	    
    	}

    	echo "Hits : ".countHits($clean)." (doesn't include vishnu's count)";
    	echo "<br><br>";
    	echo "Unique visitors : ".sizeof(array_keys($clean));
    	echo "<br><br>";
    	echo "USERNAMES";
    	echo "<br>";
    	echo "===========";
    	echo "<br>";

        //displaying username hits
        $keys = array_keys($clean);

    	for ($x = 0; $x < sizeof($keys); $x++) {
    	    
    	    echo ($x+1)." . ".$keys[$x]." - ";
            print_r($clean[$keys[$x]]);
    	    echo "<br>";
        }

        echo "<br><br>";

        //#######################################
        //##        TODAY'S HITS SECTION       ##
        //#######################################

        //processing today's hits
        //dictionary for counting hits
        $today_unique = array();
        for ($x = 0; $x < sizeof($date); $x++) {

            //splitting the $date[$x] into three or two
            $username_date_name = explode(" - ",$date[$x]);
            //$username_date_name[0];   //this is the username part
            //$username_date_name[1];   //this is the date part
            //$username_date_name[2];   //this is the name_of_user part

            //check if its today's date
            if ($username_date_name[1] == date("Y/m/d/l")){

                //if this is not seen before (ie unique)
                if(array_key_exists($username_date_name[0], $today_unique) == false){
                    //if size of $username_date_name == 3 then
                    //it contains username, date and name_of_user
                    if(sizeof($username_date_name) == 3){
                        //therefore adding count and name
                        $today_unique[$username_date_name[0]] = ["count"=>1,"name"=>$username_date_name[2]];
                    }
                    //else if size of $username_date_name != 3 then
                    //it contains username or username & date   
                    else{
                        //therefore only adding count
                        $today_unique[$username_date_name[0]] = ["count"=>1];
                    }
                    
                }
                //if it already exists then increment the count by 1
                else{
                    //increment the count by 1
                    $today_unique[$username_date_name[0]]["count"] += 1;

                    //if size of $username_date_name == 3
                    //then it has name_of_user also
                    if(sizeof($username_date_name) == 3){
                        //and if the current value of key(ie username)
                        //doesn't contain name_of_user then add it
                        if(sizeof($today_unique[$username_date_name[0]]) == 1){
                            $today_unique[$username_date_name[0]]["name"] = $username_date_name[2];
                        }
                    }
                }
            }
        }
        //print_r($today_unique);

        //displaying today's hits
        echo "Today's Hits - ".date("Y/m/d/l");
        echo "<br>";
        echo "======================";
        echo "<br>";
        $today_unique_keys = array_keys($today_unique);
        for ($x = 0; $x < sizeof($today_unique); $x++) {
            //$today_user = explode(" - ",$today_unique_keys[$x]);
            echo ($x+1)." . ".$today_unique_keys[$x]." - ";
            print_r($today_unique[$today_unique_keys[$x]]);
            echo "<br>";
        }    

        echo "<br><br>";
    }

?>

<form method="post" action="">
<input type="password" name="pass">
<input type="submit">
</form>

<?php

    $pass = $_POST["pass"];
    if ($pass == "it's_a_secret"){
        echo "password : True";
        showData();
    }
    else{
        echo "password : False";
    }
    echo "<br><br>";
    //print_r($passwords);
?>










