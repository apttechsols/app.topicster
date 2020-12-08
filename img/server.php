<?php 
	// connect to database
	$db = mysqli_connect("localhost", "root", "", "ckeditor-images");

	// retrieve posts from database
	$result = mysqli_query($db, "SELECT * FROM posts");
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<?php

// if 'upload image' buttton is clicked
if (isset($_POST['uploading_file'])) {
	// Get image name
  	$image = $_FILES['post_image']['name'];
    
  	// image file directory
  	$target = basename($image);

  	if (move_uploaded_file($_FILES['post_image']['tmp_name'], $target)) {
  		echo "http://localhost/img/" . $target;
  		exit();
  	}else{
  		echo "Failed to upload image";
  		exit();
  	}
}
?>