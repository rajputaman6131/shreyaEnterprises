
<?php

session_start();

if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Construction Site Work Details</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
     <!-- Custom Fonts -->
    <link rel="stylesheet" href="custom-font/fonts.css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <!-- Bootsnav -->
    <link rel="stylesheet" href="css/bootsnav.css" />
    <!-- Fancybox -->
    <link
      rel="stylesheet"
      type="text/css"
      href="css/jquery.fancybox.css?v=2.1.5"
      media="screen"
    />
    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="css/custom.css" />
</head>
<body>

    <!-- Header -->
    <header>
      <!-- Top Navbar -->
      <div class="top_nav">
        <div class="container">
          <ul class="list-inline info">
            <li>
              <a href="#"><span clas="fa fa-phone"></span>9517013939</a>
            </li>
            <li>
              <a href="#"
                ><span class="fa fa-envelope"></span>
                rajputaman0302@gmail.com</a
              >
            </li>
            <li>
              <a href="#"
                ><span class="fa fa-clock-o"></span> Mon - Sat 9:00 - 19:00</a
              >
            </li>
          </ul>
          <ul class="list-inline social_icon">
            <li>
              <a href=""><span class="fa fa-facebook"></span></a>
            </li>
            <li>
              <a href=""><span class="fa fa-twitter"></span></a>
            </li>
            <li>
              <a href=""><span class="fa fa-behance"></span></a>
            </li>
            <li>
              <a href=""><span class="fa fa-dribbble"></span></a>
            </li>
            <li>
              <a href=""><span class="fa fa-linkedin"></span></a>
            </li>
            <li>
              <a href=""><span class="fa fa-youtube"></span></a>
            </li>
          </ul>
        </div>
      </div>
      <!-- Top Navbar end -->

      <!-- Navbar -->
      <nav class="navbar bootsnav">
        <!-- Top Search -->
        <div class="top-search">
          <div class="container">
            <div class="input-group">
              <span class="input-group-addon"
                ><i class="fa fa-search"></i
              ></span>
              <input type="text" class="form-control" placeholder="Search" />
              <span class="input-group-addon close-search"
                ><i class="fa fa-times"></i
              ></span>
            </div>
          </div>
        </div>

        <div class="container">
          <!-- Atribute Navigation -->
       
          <!-- Header Navigation -->
          <div class="navbar-header">
            <button
              type="button"
              class="navbar-toggle"
              data-toggle="collapse"
              data-target="#navbar-menu"
            >
              <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href=""
              ><img
                class="logo"
                style="max-width: 150px"
                src="images/logo.png"
                alt=""
            /></a>
          </div>
          <!-- Navigation -->
          <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav menu">
              <li><a href="admin.php">Admin</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- Navbar end -->
    </header>
    <!-- Header end -->


	<div class="container" style="margin-top:50px;">
		<h2>Construction Site Work Details</h2>

		<?php
		include 'config.php';

		// Process form data when submitted
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Escape user inputs for security
			$work_type = mysqli_real_escape_string($conn, $_POST['work_type']);
			$description = mysqli_real_escape_string($conn, $_POST['description']);
			$date = mysqli_real_escape_string($conn, $_POST['date']);

			// Upload image
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$uploadOk = 1;
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					echo '<div class="alert alert-danger" role="alert">Error: File is not an image.</div>';
					$uploadOk = 0;
				}
			}
			// Check if file already exists
			if (file_exists($target_file)) {
				echo '<div class="alert alert-danger" role="alert">Error: File already exists.</div>';
				$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 5000000) {
				echo '<div class="alert alert-danger" role="alert">Error: File is too large. Maximum size is 5MB.</div>';
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				echo '<div class="alert alert-danger" role="alert">Error: Only JPG, JPEG, PNG & GIF files are allowed.</div>';
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo '<div class="alert alert-danger" role="alert">Error: Image upload failed.</div>';
			}
			else {
				// if everything is ok, try to upload file
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$image_name = basename( $_FILES["fileToUpload"]["name"]);

					// Insert data into database
					$sql = "INSERT INTO work_details (work_type, description, date, image) VALUES ('$work_type', '$description', '$date', '$image_name')";
					if ($conn->query($sql) === TRUE) {
						echo '<div class="alert alert-success" role="alert">Work details added successfully.</div>';
                    
					} else {
						echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
					}
				} else {
					echo '<div class="alert alert-danger" role="alert">Error: There was an error uploading your file.</div>';
				}
			}
		}
		$conn->close();
		?>

		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="work_type">Work Type:</label>
				<input type="text" class="form-control" id="work_type" name="work_type" required>
			</div>
			<div class="form-group">
				<label for="description">Description:</label>
				<textarea class="form-control" id="description" name="description" rows="3" required></textarea>
			</div>
			<div class="form-group">
				<label for="date">Date:</label>
				<input type="date" class="form-control" id="date" name="date" required>
			</div>
			<div class="form-group">
				<label for="fileToUpload">Image:</label>
				<input type="file" class="form-control-file" id="fileToUpload" name="fileToUpload" required>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</body>
</html>
