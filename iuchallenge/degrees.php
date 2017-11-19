<?php

/******************************DB Functions************************************/

$db['db_host']  = 'localhost';
$db['db_user']  = 'root';
$db['db_pass']  = '';
$db['db_data']  = 'iuchallenge';

foreach ($db as $key => $value) {
  define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATA);

function escape($string){

global $connection;
return mysqli_real_escape_string($connection, $string);

}

function query($query) {

  global $connection;
  mysqli_query($connection, $query);

}

function fetch_array($result) {

  global $connection;
  mysqli_fetch_array($result);

}

function confirm($result) {

  global $connection;
  if(!$result){
    die("query failed" . mysqli_error($connection));
  }
  }

  /****************************Helper functions*********************************/
  function clean($string){

    return htmlentities($string);

  }


  function token_generator(){

    $token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    return $token;
  }


  //Do this with the javascript version
  function first_letter($school_string){

    $first_letter = $substr($school_string, 0, 1);
    $first_letter = strtoupper($school_string);

    return $first_letter;
  }


/****************************Form Functions************************************/


if($_SERVER['REQUEST_METHOD'] === 'POST'){

  if(isset($_POST)){

    $bp           = escape(clean($_POST['bp']));
    $dp           = escape(clean($_POST['dp']));
    $id           = escape(clean($_POST['id']));
    $letter       = escape(clean($_POST['letter']));
    $link         = escape(clean($_POST['link']));
    $mp           = escape(clean($_POST['mp']));
    $name         = escape(clean($_POST['name']));
    $school       = escape(clean($_POST['school']));


  }

}




/*********************************Get XML Feed***********************************/

//this is a nifty curl function I've used before written by David Walsh

  function get_data($url) {
    	$ch = curl_init();
    	$timeout = 5;
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    	$data = curl_exec($ch);
    	curl_close($ch);
    	return $data;
    }

    $returned_content = get_data('http://www.iu.edu/~iubweb/academic/majors/xml/degree-list.xml');
    $file = 'file.txt';
    $handle = fopen($file, 'w');
    fwrite($handle , $returned_content);




 ?>
