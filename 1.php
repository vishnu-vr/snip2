<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles.css">
        <script src="button.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>SNIP</title>
        <!--<script data-main = "scripts/main" src='node_modules/requirejs/require.js'></script>-->
    </head>
      
    <body>
          
        <?php

            $username = $_POST["username"];
            $username = strtoupper($username);
            $password = $_POST["password"];
            
        ?>

        <div class="lds-hourglass" id="lds-hourglass" style="padding: 25% 20% 20% 40%;">
        </div>
        <div id="body" class="hideme">
        <button style="display: none;" id="btn" onclick="clicked()">fetch data</button>
        <br>
        <p id="name_of_user" style="text-align: center;
                    font-weight: 700;">null</p>
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Subject</th>
                <th scope="col">Percentage</th>
                <th scope="col">Snip</th>
                <th scope="col">Duty</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td id="sub1">null</td>
                <td id="per1">null</td>
                <td id="snip1">null</td>
                <td id="duty1">null</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td id="sub2">null</td>
                <td id="per2">null</td>
                <td id="snip2">null</td>
                <td id="duty2">null</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td id="sub3">null</td>
                <td id="per3">null</td>
                <td id="snip3">null</td>
                <td id="duty3">null</td>
              </tr>
              <tr>
                <th scope="row">4</th>
                <td id="sub4">null</td>
                <td id="per4">null</td>
                <td id="snip4">null</td>
                <td id="duty4">null</td>
              </tr>
              <tr>
                <th scope="row">5</th>
                <td id="sub5">null</td>
                <td id="per5">null</td>
                <td id="snip5">null</td>
                <td id="duty5">null</td>
              </tr>
              <tr id="extra1" class="hideme">
                <th scope="row">6</th>
                <td id="sub6">null</td>
                <td id="per6">null</td>
                <td id="snip6">null</td>
                <td id="duty6">null</td>
              </tr>
              <tr id="extra2" class="hideme">
                <th scope="row">7</th>
                <td id="sub7">null</td>
                <td id="per7">null</td>
                <td id="snip7">null</td>
                <td id="duty7">null</td>
              </tr>              
              <tr id="extra3" class="hideme">
                <th scope="row">8</th>
                <td id="sub8">null</td>
                <td id="per8">null</td>
                <td id="snip8">null</td>
                <td id="duty8">null</td>
              </tr>
              <tr id="extra4" class="hideme">
                <th scope="row">9</th>
                <td id="sub9">null</td>
                <td id="per9">null</td>
                <td id="snip9">null</td>
                <td id="duty9">null</td>
              </tr>
              <tr id="extra5" class="hideme">
                <th scope="row">10</th>
                <td id="sub10">null</td>
                <td id="per10">null</td>
                <td id="snip10">null</td>
                <td id="duty10">null</td>
              </tr>         
            </tbody>
          </table>
          
          <hr style="border: 23px solid #343a40;">
          <p style="color:black;
                    font-weight:bold;
                    padding-left:10px;">**NOTE**</p>
          <p style="color:black;
                    font-weight:bold;
                    padding-left:10px;">Negative number represents amount of classes needed to make it 75</p>
          <p style="color:green;
                    font-weight:bold;
                    padding-left:10px;">GREEN : Ottum Scene ila</p>
          <p style="color:orange;
                    font-weight:bold;
                    padding-left:10px;">ORANGE : Velya Scene ila</p>
          <p style="color:red;
                    font-weight:bold;
                    padding-left:10px;">RED : Sookshicho</p>
        </div>

        <script>
            var username = <?php echo json_encode($username); ?>;
            var password = <?php echo json_encode($password); ?>;

            console.log(username);
            console.log(password);

            //******************for testing*****************

            function testing(){
                var htmlcontainer = document.getElementById("container");
                htmlcontainer.innerHTML = "<h1 align='center'>haha it worked</h1>";
            }

            //******************for testing*****************
            var loaded = false;
            var g = "value not received!"; //global variable for testing purposes
            //var d;
            //function to update cells of html document
            function doThingsWithData(data){
                g = data;
                //console.log(data);  //testing
                //var htmltag = document.getElementById("name");
                //htmltag.innerHTML = data[0]["subject"];

                //htmlcontainer.innerHTML = "<h1 align='center'>haha it worked</h1>";

                //***************loading**************
                const htmlbody = document.getElementById("body");
                htmlbody.removeAttribute("class");
                const spinner = document.getElementById("lds-hourglass");
                spinner.setAttribute("class","hideme");
                //***************loading**************
                
                //**********sync for loop************
                const syncForLoop = async _ => {
                    //console.log('Start')
                    
                    for (let i = 0; i < data.length; i++) {
                        id_for_sub = "sub"+(i+1);
                        id_for_per = "per"+(i+1);
                        id_for_snip = "snip"+(i+1);
                        id_for_duty = "duty"+(i+1);

                        var sub = document.getElementById(id_for_sub);
                        var per = document.getElementById(id_for_per);
                        var snip = document.getElementById(id_for_snip);
                        var duty = document.getElementById(id_for_duty);

                        var atten_class = data[i]['atten_class'];   //p
                        var total_class = data[i]['total_class'];   //t

                        //duty calculations
                        var d = Math.ceil((0.75*total_class) - atten_class);
                
                        //snip calculations
                        var snip_class = Math.ceil(((0.75*total_class) - atten_class) / 0.25);
                        snip_class = snip_class*-1;

                        //********double checking************
                        //if snip_class is positive (this much classes can be snipped)
                        if (snip_class > 0){
                            var test = (atten_class - snip_class) / (total_class - snip_class);
                            //if attendance is less than 0.75 then this much class cannot be snipped
                            if (test < 0.75){
                                snip_class -= 1;
                            }
                        }
                        //if snip_class is negative (this much classes has to be attended)
                        else if (snip_class < 0){
                            var test = (atten_class - snip_class) / (total_class - snip_class);
                            //if attendance is less than 0.75 more classess has to be attended
                            if (test < 0.75){
                                snip_class -= 1;
                            }
                        }
                        //********double checking************

                        if (d < 0){
                            d = "0";
                        }

                        //console.log(d);
                        //console.log(data);

                        if (data[i]['percentage'] >= 75){
                            per.setAttribute("class", "morethan75");
                        }
                        else if (data[i]['percentage'] < 75 && data[i]['percentage'] > 70){
                            per.setAttribute("class", "lessthan75");
                        }
                        else if(data[i]['percentage'] > 65 && data[i]['percentage'] < 70){
                            per.setAttribute("class", "lessthan70");
                        }
                        else if(data[i]['percentage'] < 65){
                            per.setAttribute("class", "lessthan65");
                        }

                        if (snip_class < 0) {
                            snip.innerHTML = snip_class;
                            snip.setAttribute("style", "background-color: #797474;");
                        }
                        else {
                            snip.innerHTML = snip_class;                            
                        }

                        sub.innerHTML = data[i]['subject'];
                        per.innerHTML = data[i]['percentage'];
                        duty.innerHTML = d;
                        //console.log(i);
                    }
                    //htmlcontainer.innerHTML = tags;
                    //console.log('End')
                }

                //name_of_user
                var name_of_user = document.getElementById("name_of_user");
                name_of_user.innerHTML = data[0]['name_of_user'];
                console.log("Welcome "+data[0]['name_of_user']);
                //name_of_user


                syncForLoop();
                //**********sync for loop************


                //**********************************
                //**    calling the dpupdate api **
                //**********************************
                console.log("logging user info");
                var db_update_url = "dpupdate.php?username="+username+"&name_of_user="+data[0]['name_of_user'];
                fetch(db_update_url).then((res) =>res.json())
                .then(response => {
                    console.log(response);
                })
                .catch(error => console.log(error));
                //console.log("below the fetch call");
                //**********************************
                //**    calling the dpupdate api **
                //**********************************

            }

            //code from mozila documentations (MDN)
            //TODO : check url and data for null cases to avoid errors
            async function postData(url = '', data = {}) {


                //***************loading**************
                const htmlbody = document.getElementById("body");
                htmlbody.setAttribute("class", "hideme");
                //***************loading**************

                //wait for 30 seconds otherwise discard and reload
                setTimeout(() => {if(!loaded){alert("moonji! something went wrong!");
                                  window.location.href = "index.php";}}, 30000);

                // Default options are marked with *
                const response = await fetch(url, {
                    method: 'POST', // *GET, POST, PUT, DELETE, etc.
                    mode: 'cors', // no-cors, *cors, same-origin
                    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                    credentials: 'same-origin', // include, *same-origin, omit
                    headers: {
                    'Content-Type': 'application/json'
                    // 'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    redirect: 'follow', // manual, *follow, error
                    referrerPolicy: 'no-referrer', // no-referrer, *client
                    body: JSON.stringify(data) // body data type must match "Content-Type" header
                });
                return await response.json(); // parses JSON response into native JavaScript objects
            }

            //url = 'http://ssetapi.herokuapp.com/v1/profile/attendance';   //rameez salim api
            url = 'https://ssetvishnuapi.herokuapp.com/attendance';     //enabled cors support
            //url = 'http://localhost:1234/attendance';      //local api for development
            //toSend =  { username: "SCS/7026/16", password : "7026" };
            toSend =  { "username": username, "password" : password };
            //console.log(toSend);

            //onclick function from html button
            function clicked(){
                //if username or password == null then redirect to index
                if(toSend['username'] == "" || toSend['password'] == ""){
                    alert("username and password poyi type chey!");
                    window.location.href = "index.php";
                }
                //checking for the pattern SCS/7033/16
                if(toSend['username'].includes('P') == true){
                    alert("incorrect username. Username has to be in the format SCS/1234/16");
                    window.location.href = "index.php";                
                }
                //const h1tag = document.getElementById("name");
                //h1tag.innerHTML = "button-clicked";
                postData(url, toSend)
                .then((data) => {
                    loaded = true;
                    console.log("subject count:",data.length); // JSON data parsed by `response.json()` call
                    //for students otherthan s8
                    if (data.length > 5){
                        console.log("extra rows added");
                        for (var i=0; i<data.length-5; i++){
                            var extra = document.getElementById("extra"+(i+1));
                            extra.removeAttribute("class");
                        }
                    }
                    doThingsWithData(data); //callback function
                });
            }

            clicked();
            /*
            //const puppeteer = require('puppeteer');
            async function sset(){
                // Create browser instance, and give it a first tab
                const browser = await puppeteer.launch();
                const page = await browser.newPage();

                // Allows you to intercept a request; must appear before
                // your first page.goto()
                await page.setRequestInterception(true);

                // Request intercept handler... will be triggered with 
                // each page.goto() statement
                page.on('request', interceptedRequest => {

                    // Here, is where you change the request method and 
                    // add your post data
                    var data = {
                        'method': 'POST',
                        'postData': JSON.stringify({ username: "SCS/7026/16", password : "7026" })
                    };

                    // Request modified... finish sending! 
                    interceptedRequest.continue(data);
                });

                // Navigate, trigger the intercept, and resolve the response
                const response = await page.goto('http://ssetapi.herokuapp.com/v1/profile/attendance');     
                const responseBody = await response.JSON();
                console.log(responseBody);

                // Close the browser - done! 
                await browser.close();
            }
            sset();
            */
        </script>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<div class="footer">
  <!-- Use a button to open the snackbar -->
  <button style="background-color:grey;" onclick="myFunction()">&#128519;</button>

  <!-- The actual snackbar -->
    <div id="snackbar">https://github.com/vishnu-vr/snip2</div>
</div>
</body>
</html>