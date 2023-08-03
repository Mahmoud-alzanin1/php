<?php
$username = 'root';
$password = '';
$server = 'localhost';
$conn = mysqli_connect($server, $username, $password);
if (!$conn) {
    die("connection error");
}
$sql = 'CREATE DATABASE IF NOT EXISTS USERSYSTEM;';
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("There is a probleam");
}
$result = mysqli_select_db($conn, "USERSYSTEM");
if (!$result) {
    echo "There is a probleam";
}
$sql = 'CREATE TABLE IF NOT EXISTS USERS (USERID INT(4) AUTO_INCREMENT PRIMARY KEY,
                USERNAME VARCHAR(25) NOT NULL,
                PASSWORD VARCHAR(25) NOT NULL,
                EMAIL VARCHAR(30) NOT NULL,
                TEL_NR VARCHAR(16) NOT NULL)';
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "There is a probleam";
}
