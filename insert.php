<?php
// include the createTable.php file
include 'createTable.php';

if (!$conn) {
  die('There is a problem with the connection: ' . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
  $userid = $_POST['userid'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];
  $tel_nr = $_POST['tel_nr'];

  if ($userid != '') {
    // Update existing user data in the database
    $sql = "UPDATE USERS SET USERNAME='$username', PASSWORD='$password', EMAIL='$email', TEL_NR='$tel_nr' WHERE USERID='$userid'";
  } else {
    // Insert new user data into the database
    $sql = "INSERT INTO USERS (USERNAME, PASSWORD, EMAIL, TEL_NR) VALUES ('$username', '$password', '$email', '$tel_nr')";
  }

  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die('There is a problem saving user data: ' . mysqli_connect_error());
  }
  header('Location: retriveData.php');
  exit;
}

// If the 'userid' parameter is provided in the URL, fetch the user data for updating
if (isset($_GET['userid'])) {
  $userid = $_GET['userid'];
  $sql = "SELECT * FROM USERS WHERE USERID='$userid'";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die('There is a problem retrieving user data: ' . mysqli_connect_error());
  }
  $user = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
} else {
  $user = [
    'USERID' => '',
    'USERNAME' => '',
    'PASSWORD' => '',
    'EMAIL' => '',
    'TEL_NR' => ''
  ];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo ($user['USERID'] != '') ? 'Update User' : 'Add User'; ?></title>
  <style type="text/css">
    div {
      min-width: 70%;
      max-width: 90%;
      margin: auto;
    }

    form {
      width: 100%;
      margin: auto;
      text-align: center;
      background-color: #ddd;
      padding: 20px;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    input[type="tel"] {
      width: 100%;
      padding: 5px;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div>
    <h1><?php echo ($user['USERID'] != '') ? 'Update User' : 'Add User'; ?></h1>
    <form action="" method="POST">
      <input type="hidden" name="userid" value="<?php echo $user['USERID']; ?>">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" value="<?php echo $user['USERNAME']; ?>" required>

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" value="<?php echo $user['PASSWORD']; ?>" required>

      <label for="email">Email:</label>
      <input type="email" name="email" id="email" value="<?php echo $user['EMAIL']; ?>" required>

      <label for="tel_nr">Mobile#:</label>
      <input type="tel" name="tel_nr" id="tel_nr" value="<?php echo $user['TEL_NR']; ?>" required>

      <input type="submit" name="submit" value="<?php echo ($user['USERID'] != '') ? 'Update' : 'Add'; ?>">
    </form>
  </div>
</body>

</html>