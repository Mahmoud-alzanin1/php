<?php
// include the createTable.php file
include 'createTable.php';

if (!$conn) {
  die('There is problem Connection .. ' . mysqli_connect_error());
}
if (isset($_POST['submit'])) {
  $userid = $_POST['userid'];
  $sql = "DELETE FROM USERS WHERE USERID='$userid'";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die('There is problem IN deleting user .. ' . mysqli_connect_error());
  }
  header('location: retriveData.php');
}
