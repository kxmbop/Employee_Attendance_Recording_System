<?php

$conn =  new mysqli("localhost", "root", "", "attendance");
if ($conn->error){
   die("Connection failed: " . $conn->error);
}

?>