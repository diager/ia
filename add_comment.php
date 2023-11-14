<?php
$servername = "localhost";
$username = "diana";
$password = "123";
$dbname = "ai";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idvideo = $_POST["idvideo"];
    $idusuario = $_POST["idusuario"];
    $texto = $_POST["texto"];

    $insertCommentSql = "INSERT INTO comentarios (idusuario, texto) VALUES ('$idusuario', '$texto')";
    if ($conn->query($insertCommentSql) === TRUE) {
        $commentId = $conn->insert_id;
        $insertVideosComentariosSql = "INSERT INTO videoscomentarios (idvideo, idcomentario) VALUES ('$idvideo', '$commentId')";
        
        if ($conn->query($insertVideosComentariosSql) === TRUE) {
            echo "Comment added successfully.";
        } else {
            echo "Error: " . $insertVideosComentariosSql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $insertCommentSql . "<br>" . $conn->error;
    }
}
echo '<br><br><a href="http://localhost/lab4/display_all_videos.php">Display all videos</a>';

$conn->close();
?>
