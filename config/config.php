<?php
  $db_host = 'localhost';
  $db_user = 'root';
  $db_password = 'root';
  $db_db = 'crudapp';
  $db_port = 8889;

  $con = new mysqli($db_host, $db_user, $db_password, $db_db);
	
  if ($con->connect_error) {
    echo 'Errno: '.$con->connect_errno;
    echo '<br>';
    echo 'Error: '.$con->connect_error;
    exit();
  }

  echo 'Success: A proper connection to MySQL was made.';
  echo '<br>';
  echo 'Host information: '.$con->host_info;
  echo '<br>';
  echo 'Protocol version: '.$con->protocol_version;

//   $mysqli->close();
?>