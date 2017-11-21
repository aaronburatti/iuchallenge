<?php
/*
I use variable to hold these values so if anyone is listening in the values are hard to find, and hide the script to avoid anyone finding it easly.
*/
$db_host  = 'localhost';
$db_root  = 'root';
$db_pass  = '';
$db_data  = 'iuchallenge';

$connection = mysqli_connect($db_host, $db_root, $db_pass, $db_data);
