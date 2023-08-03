<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style type="text/css">
    body {
      font-family: Arial, sans-serif;
    }

    h1 {
      text-align: center;
    }

    div {
      min-width: 70%;
      max-width: 90%;
      margin: auto;
      padding-bottom: 20px;
    }

    table {
      width: 100%;
      margin: auto;
      text-align: center;
      border-collapse: collapse;
      border: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
      height: 50px;
      font-weight: bold;
      color: #555;
    }

    td form {
      height: 40px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #f2f2f2;
    }

    .add-button {
      text-align: center;
      margin-top: 20px;
    }

    .add-button button {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .add-button button:hover {
      background-color: #45a049;
    }

    .update-button,
    .delete-button {
      display: inline-block;
      padding: 6px 12px;
      font-size: 12px;
      font-weight: bold;
      text-transform: uppercase;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .update-button {
      background-color: #2196F3;
      color: white;
      border: none;
      margin-right: 4px;
    }

    .delete-button {
      background-color: #F44336;
      color: white;
      border: none;
    }

    .update-button:hover,
    .delete-button:hover {
      background-color: #0b7dda;
    }
  </style>
</head>

<body>

  <?php
  // include the createTable.php file
  include 'createTable.php';

  if (!$conn) {
    die('There is a problem with the connection: ' . mysqli_connect_error());
  }
  $sql = "SELECT * FROM USERS";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die('There is a problem with the query: ' . mysqli_connect_error());
  }

  ?>
  <div>
    <h1>List of Registered Users</h1>
    <table>
      <tr>
        <th>User ID</th>
        <th>User NAME</th>
        <th>User PASSWORD</th>
        <th>User EMAIL</th>
        <th>User MOBILE#</th>
        <th>Actions</th>
      </tr>
      <?php
      while ($user = mysqli_fetch_array($result)) {
      ?>
        <tr>
          <td><?php echo $user['USERID']; ?></td>
          <td><?php echo $user['USERNAME']; ?></td>
          <td><?php echo $user['PASSWORD']; ?></td>
          <td><?php echo $user['EMAIL']; ?></td>
          <td><?php echo $user['TEL_NR']; ?></td>
          <td class="action-buttons">
            <form action="update.php" method="POST">
              <input type="hidden" name="userid" value="<?php echo $user['USERID']; ?>">
              <button type="submit" name="submit" class="update-button">Update</button>
            </form>
            <form action="delete.php" method="POST">
              <input type="hidden" name="userid" value="<?php echo $user['USERID']; ?>">
              <button type="submit" name="submit" class="delete-button">Delete</button>
            </form>
          </td>
        </tr>
      <?php
      }
      ?>
    </table>
    <div class="add-button">
      <button onclick="location.href='insert.php'">Add User</button>
    </div>
  </div>

</body>

</html>