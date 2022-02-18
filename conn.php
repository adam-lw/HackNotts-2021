<?php 


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$conn = new mysqli("localhost", "ewanr_admin", "photography2020", "ewanr_spotifyquiz");

// Check connection
if ($conn->connect_error) {

die("Connection failed: " . $conn->connect_error);

}

function check_query($conn, $query) {
  if(!$query)
  {
      echo mysqli_error($conn);
      die();
  }
  else
  {
      echo "Query succesfully executed!";
  } 
}

?>