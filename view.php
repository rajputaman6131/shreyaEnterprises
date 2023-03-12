<!DOCTYPE html>
<html>
<head>
	<title>View Project Details</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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

        <div class="container"  >
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
              <li><a href="workDetail.php">Add Work Detail</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- Navbar end -->
    </header>
    <!-- Header end -->


	<div class="container" style="margin-top:60px; margin-bottom:60px;">
		<?php
		// Include database configuration file
		include 'config.php';

		// Get the project ID from the URL parameter
		$id = $_GET['id'];

		// Fetch the project details from the database
		$sql = "SELECT * FROM work_details WHERE id = $id";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			?>
			<center>
                <img style="width:400px;" src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['work_type']; ?>" >
            </center>
			<h2 style="margin-top:20px;"><?php echo $row['work_type']; ?></h2>

			<p><strong>Date:</strong> <?php echo $row['date']; ?></p>
			<p><strong>Description:</strong> <?php echo $row['description']; ?></p>
			<!-- <p><strong>Image:</strong></p> -->
			<?php
		} else {
			echo '<p>No project details found.</p>';
		}
		$conn->close();
		?>
		<a href="projects.php" class="btn btn-default">Back to Projects</a>
	</div>
  <?php 
  include 'footer.php';
  ?>
</body>
</html>
