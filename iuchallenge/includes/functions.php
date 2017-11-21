<?php
session_start();//this is used for token generation discussed at length below

/******************************DB Functions************************************/


//this brings in the db info from a hidden place
require "db/db.php";



  /****************************Helper functions*********************************/

//this function prevents Xsite scripting by handling html characters safely
function clean($string){

    return htmlentities($string);

  }

//this function will disable SQL injection by not allowing SQL queries into
//the db by user input
  function escape($string){

  global $connection;
  return mysqli_real_escape_string($connection, $string);

  }


//this is to hide all error messages from being displayed
function confirm($result) {

  global $connection;
  if(!$result){
    die("query failed" . mysqli_error($connection));
    }
  }


/*this function generates a random token upon every click of the submit button.
this is done to partly for security; it would be very difficult for any software
to mimic the unique token.

This is also why it is simultaneously stored in a session (or alterantively as a cookie). In a larger
application this value can be stored in the db and used as email or general validation

*/
  function token_generator(){

    $token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    return $token;
  }


/****************************Form Functions************************************/




  if (isset($_POST['submit'])){//when the submit button is pushed
//these use the helper functions above to sanitize the data before putting it in the db
    $bp           = escape(clean($_POST['bp']));
    $dp           = escape(clean($_POST['dp']));
    $id           = escape(clean($_POST['id']));
    $letter       = escape(clean($_POST['letter']));//the variable should always be empty since the element is hidden.
                                                    //since it comes from an HTML element... better safe than sorry.
    $link         = escape(clean($_POST['link']));
    $mp           = escape(clean($_POST['mp']));
    $name         = escape(clean($_POST['name']));
    $school       = escape(clean($_POST['school']));

      
    //This function reduces user error and automates monotonous typing
    $first = substr($school, 0, 1);//find the first letter of the school input field data
    $letter = strtoupper($first);//capitalize the letter. save it as variable

    $qry = "INSERT INTO degree( bp, dp, id, letter, link, mp, name, school)
            VALUES ('$bp', '$dp', '$id', '$letter', '$link', '$mp', '$name', '$school')";


    $result =  mysqli_query($connection, $qry);
    confirm($result);

    header('Location:../index.php?source=display_db');

  }




/*********************************Read XML Feed Function***********************************/

/*
This was going to be an automatic xml feed reader. It is somewhat functioning. It will go and get the feed, put it into a file and add the reference to the stylesheet. However, no matter how I tried to finesse
it, "<?xml version="1.0" encoding="utf-8" ?>" was always placed after "<?xml-stylesheet type="text/xsl" href="degrees.xslt" ?>". Having a deadline, I implemented other functionality.

The function below is a general version out of nearly 100 I tried to give some hint at my thought process. Ultimately, I rolled back the functionality to just link to the already completed XML/XSLT sheet.
*/

if(isset($_GET['read'])){//read the parameter sent by the link

$url = "http://www.iu.edu/~iubweb/academic/majors/xml/degree-list.xml";//store the url
$ch = curl_init();//this is the cURL initializer
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);// give the return value as a string
curl_setopt($ch, CURLOPT_URL, $url);// sets the url to fetch

$data = curl_exec($ch);// execute and store in a variable
curl_close ($ch);// end the cURL connection    
$xml = fopen('degrees.xml', 'r+'); //create a new XML file    
fwrite($xml, '<?xml-stylesheet type="text/xsl" href="degrees.xslt" ?>'); // add the stylesheet reference
fwrite($xml, $data);// add the data
    

header('Location:degrees.xml');//take the user to the page

}

/********************************Display DB Funcitons***************************************/

function html_display(){

if(isset($_GET['html'])){

  global $connection;

  $qry = "SELECT * FROM degree";
  $result =  mysqli_query($connection, $qry);
  confirm($result);

  while( $row = mysqli_fetch_assoc($result)) {

    $user_id      = $row['user_id'];
    $bp           = $row['bp'];
    $dp           = $row['dp'];
    $id           = $row['id'];
    $letter       = $row['letter'];
    $link         = $row['link'];
    $mp           = $row['mp'];
    $name         = $row['name'];
    $school       = $row['school'];

$html_display = <<<DELIMETER
<table>
  <tr>
    <th>user id</th>
    <th>batchelor</th>
    <th>doctorate</th>
    <th>id</th>
    <th>letter</th>
    <th>link</th>
    <th>masters</th>
    <th>name</th>
    <th>school</th>
  </tr>
  <tr>
    <td>$user_id</td>
    <td>$bp</td>
    <td>$dp</td>
    <td>$id</td>
    <td>$letter</td>
    <td>$link</td>
    <td>$mp</td>
    <td>$name</td>
    <td>$school</td>
  </tr>
</table>

DELIMETER;

echo $html_display;

    }//closes the while loop

  }//closes the if block

}//closes the function


/********************************Dump DB Functions*******************************************/

if(isset($_GET['dump'])){
    global $connection;

  $sql = "TRUNCATE TABLE degree";//this deletes and resets the table. Faster than deleting rows
  $result = mysqli_query($connection, $sql);
  confirm($result);
  header("Location: ../index.php?source=dump_db");//redirect to the same page
}

 ?>
