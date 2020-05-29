<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// connect to database
$conn = mysqli_connect('localhost', 'app', 'qbg6E8', 'beefbouquet');
// check connection
if(!$conn){
    echo 'Error - Unable to connect to database: ' . mysqli_connect_error();
}

?>
