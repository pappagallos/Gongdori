<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gongdori";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->query("set session character_set_connection=utf8;");
$conn->query("set session character_set_results=utf8;");
$conn->query("set session character_set_client=utf8;");
?>