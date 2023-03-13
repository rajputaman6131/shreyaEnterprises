<!DOCTYPE html>
<html>
<head>
	<title>Work Details</title>
	<!-- Bootstrap CSS -->
	 <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Bootstrap JavaScript
    Custom Fonts -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
              <li><a href="index.php">Home</a></li>
              <li><a href="login.php">Login</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- Navbar end -->
    </header>
    <!-- Header end -->


	<section id="services">
    <div class="container">
        <h2>OUR PROJECTS</h2>
        <div class="row">
			<?php
			// Include database configuration file
			include 'config.php';

			// Fetch the project details from the database
			$sql = "SELECT * FROM work_details";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					?>
                    <div class="col-md-4">
            <div class="service_item">
              <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['work_type']; ?>" />
              <h3><?php echo $row['work_type']; ?></h3>
              <p>
                <?php echo substr($row['description'], 0, 100);  ?>
              </p>
              <a href="view.php?id=<?php echo $row['id']; ?>" class="btn know_btn">View Details</a>
            </div>
          </div>
                           
					<?php
				}
			} else {
				echo '<p>No project details found.</p>';
			}
			$conn->close();
			?>
		 </div>
    </div>
</section>
<?php
include 'footer.php';
?>
</body>
</html>



          
       
