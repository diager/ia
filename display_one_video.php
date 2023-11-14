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
//DB connection
$servername = "localhost";
$username = "diana";
$password = "123";
$dbname = "ai";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_GET["id"];
//echo "id: $id <br><br>";

$sql = "SELECT id, titulo, descripcion, pais, urlfoto FROM videos WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . "<br>";
        echo "Title: " . $row["titulo"] . "<br>";
        echo "Description: " . $row["descripcion"] . "<br>";
        echo "Country: " . $row["pais"] . "<br>";
        echo "Photo: <img src='" . $row["urlfoto"] . "' alt='Photo'><br>";
    }
} else {
    echo "0 results";
}

echo "<br><br>";

// $sql = "SELECT idvideo, idcomentario FROM videoscomentarios WHERE idvideo=$id";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $comentarioId = $row['idcomentario'];
//         $comentarioSql = "SELECT id, idusuario, texto FROM comentarios WHERE id=$comentarioId";
//         $comentarioResult = $conn->query($comentarioSql);

//         if ($comentarioResult->num_rows > 0) {
//             while ($comentarioRow = $comentarioResult->fetch_assoc()) {
//                 echo 'id: ' . $comentarioRow['id'] . '<br>';
//                 echo 'idusuario: ' . $comentarioRow['idusuario'] . '<br>';
//                 echo '<b>texto: ' . $comentarioRow['texto'] . '</b><br>';
//             }
//         } else {
//             echo "0 results for comentarios";
//         }
//     }
// } else {
//     echo "0 results for videoscomentarios";
// }

// SELECT * FROM comentarios AS c, usuarios as u
// WHERE c.idusuario=u.dni

$sql = "SELECT vc.idvideo, vc.idcomentario, c.idusuario, c.texto, u.nick FROM videoscomentarios vc
        JOIN comentarios c ON vc.idcomentario = c.id
        JOIN usuarios u ON c.idusuario = u.dni
        WHERE vc.idvideo=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo 'id: ' . $row['idcomentario'] . '<br>';
        echo 'idusuario/DNI: ' . $row['idusuario'] . '<br>';
        echo 'Usuario Nick: ' . $row['nick'] . '<br>';
        echo '<b>texto: ' . $row['texto'] . '</b><br>';
    }
} else {
    echo "0 results for comentarios";
}

echo '<br><br><a href="http://localhost/lab4/display_all_videos.php">Display all videos</a>';

echo '<br><br><h3>Add a Comment</h3>';
echo '<form action="add_comment.php" method="post">';
echo '<input type="hidden" name="idvideo" value="' . $id . '">';
echo 'User ID: <input type="text" name="idusuario" required><br><br>';
echo 'Comment: <textarea name="texto" required></textarea><br>';
echo '<input type="submit" value="Submit Comment">';
echo '</form>';


?>
</body>
</html>