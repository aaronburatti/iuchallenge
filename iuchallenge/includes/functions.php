<?php
session_start();//this is used for token generation discussed at length below

/******************************DB Functions************************************/


//this brings in the db info from a hidden place
require "db/db.php";



  /****************************Helper functions*********************************/

//this is quicker to type. the function prevents Xsite scripting by handling html characters safely
function clean($string){

    return htmlentities($string);

  }

//quicker to tuype. this function will disable SQL injection by handling any not allowing SQL queries into
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
application this value can be stored in the db validate

it can also be used for id purposes, generally.
*/
  function token_generator(){

    $token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    return $token;
  }


/****************************Form Functions************************************/




  if (isset($_POST['submit'])){

    $bp           = escape(clean($_POST['bp']));
    $dp           = escape(clean($_POST['dp']));
    $id           = escape(clean($_POST['id']));
    $letter       = escape(clean($_POST['letter']));//at this point the variable should always be empty.
                                                    //since it comes from an HTML element... better safe than sorry.
    $link         = escape(clean($_POST['link']));
    $mp           = escape(clean($_POST['mp']));
    $name         = escape(clean($_POST['name']));
    $school       = escape(clean($_POST['school']));

    $first = substr($school, 0, 1);//find the first letter of the school input field data
    $letter = strtoupper($first);//capitalize the letter. save it as variable to be put

    $qry = "INSERT INTO degree( bp, dp, id, letter, link, mp, name, school)
            VALUES ('$bp', '$dp', '$id', '$letter', '$link', '$mp', '$name', '$school')";


    $result =  mysqli_query($connection, $qry);
    confirm($result);

    header('Location:../index.php?source=display_db');

  }




/*********************************Read XML Feed Function***********************************/


if(isset($_GET['read'])){

$url = "http://www.iu.edu/~iubweb/academic/majors/xml/degree-list.xml";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);

$data = curl_exec($ch);
curl_close ($ch);
$xml = fopen('degrees.xml', 'w');
fwrite($xml, $data);

}

/*
$query = "INSERT INTO 'degrees'('user_id', 'bp', 'dp', 'id', 'letter', 'link', 'mp', 'name', 'school')
          VALUES ('$user_id', '$bp', '$dp', '$id', '$letter', '$link', '$mp', '$name', '$school')";
*/
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


function xml_display(){

if(isset($_GET['xml'])){



  }

}

/********************************Dump DB Functions*******************************************/

if(isset($_GET['dump'])){
    global $connection;

  $sql = "TRUNCATE TABLE degree";
  $result = mysqli_query($connection, $sql);
  confirm($result);
  header("Location: ../index.php?source=dump_db");
}

 ?>
