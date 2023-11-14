<?php
$servername = "localhost";
$username = "diana";
$password = "123";
$dbname = "ai";
//mysqli is a php class, to interact with a mysql db, it has the property connect_error
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

/*$_FILES is a superglobal associative array in php, which contains information about
all files that are uploaded in a POST form with enctype=multipart/data*/
$image_file = $_FILES["image"];
$image_name = $image_file["name"];
$image_path = "pics/" . $image_name; //new path

//The input from the form, which can be accessed via the $_POST array
$title = $_POST["title"];
$country = $_POST["country"];

//image_file should contain information about the image uploaded, if it is not set, no file is uploaded
if(!isset($image_file)) {
	die("No file uploaded");
}

//The filesize of $image_file should be bigger than 0, it checks if a non zero file is uploaded
if(filesize($image_file["tmp_name"]) <=0){
	die("Uploaded file has no content");
}

//function exif_imagetype checks image type, if it is not set it's not an image
$image_type = exif_imagetype($image_file["tmp_name"]);
if(!$image_type){
		die("Uploaded file is not an image");
}

//move file from tmp location to pics/...
move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);

// Insert the new video into the database
$sql = "INSERT INTO videos (titulo, pais, urlfoto) VALUES ('$title', '$country', '$image_path')";
if ($conn->query($sql) === TRUE) {
	echo "Video added successfully!";
	echo "<br><br> Image name: ";
	print_r($_FILES["image"]["name"]);
	echo "<br><br>";
	echo '<a href="http://localhost/lab4/display_all_videos.php">all videos</a>';

} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>