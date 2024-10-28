<?php

$conn =  new mysqli("localhost", "root", "", "attendance");
if ($conn->error){
   die("Connection failed: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="design.scss">
</head>