<!DOCTYPE html>
<html>
<head>
  <title>Display Videos</title>
  <style>
    img {
    width: 100px;
}
  </style>
</head>
<body>
<?php
$servername = "localhost";
$username = "diana";
$password = "123";
$dbname = "ai";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
#echo "Connected successfully";


// Select data from movie table
$sql = "SELECT id, titulo, pais, urlfoto FROM videos";
$result = $conn->query($sql);

// Create HTML table to display data
echo "<table>";
echo "<tr><th>ID</th><th>Title</th><th>Country</th><th>Photo</th></tr>";
while($row = $result->fetch_assoc()) {
  echo "<tr>";
  echo "<td>" . $row["id"] . "</td>";
  // echo "<td>" . $row["titulo"] . "</td>";
  // echo '<td><a href="http://localhost/lab4/display_one_video.php">$row["titulo"]</a></td>';
  //echo '<td><a href="http://localhost/lab4/display_one_video.php">' . $row["titulo"] . '</a></td>';
  echo '<td><a href="http://localhost/lab4/display_one_video.php?id=' . $row["id"] . '">' . $row["titulo"] . '</a></td>';
  echo "<td>" . $row["pais"] . "</td>";
  echo "<td><img src='" . $row["urlfoto"] . "'></td>";
  echo "</tr>";
}
echo "</table>";
echo "<a href='http://localhost/lab4/add_video.html'>ADD video</a>";
?>

</body>
</html>