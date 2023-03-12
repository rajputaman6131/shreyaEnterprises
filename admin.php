<?php

session_start();

if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Admin</title>
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
              <li><a href="workDetail.php">Add Work Detail</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- Navbar end -->
    </header>
    <!-- Header end -->


    <div class="container">
      <h2 style="margin-top:90px;">Contact Details</h2>
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Message</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include 'config.php';

            // Number of records per page
            $records_per_page = 5;

            // Get current page
            $page = (isset($_GET["page"]) && $_GET["page"] > 0) ? (int)$_GET["page"] : 1;

            // Calculate start record
            $start_from = ($page - 1) * $records_per_page;

            // Fetch data from contact table with pagination
            $sql = "SELECT * FROM contact LIMIT $start_from, $records_per_page";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["contactNumber"] . "</td>";
                echo "<td>" . $row["message"] . "</td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='4'>No data found</td></tr>";
            }

            // Count total number of records
            $sql = "SELECT COUNT(*) as total_records FROM contact";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $total_records = $row["total_records"];

            // Calculate total pages
            $total_pages = ceil($total_records / $records_per_page);
            // Close connection
            mysqli_close($conn);
          ?>
        </tbody>
      </table>
      <nav aria-label="">
        <ul class="pagination">
          <?php
            for ($i = 1; $i <= $total_pages; $i++) {
              echo "<li class='page-item'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>";
            }
          ?>
        </ul>
      </nav>
    </div>


    <div class="container" style="margin-top:40px; margin-bottom:100px";>
		<h2>Work Details</h2>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Work Type</th>
					<th>Description</th>
					<th>Date</th>
					<th>Image</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php
        
        include 'config.php';


				// Fetch all work details from database
				$sql = "SELECT * FROM work_details";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $row['work_type']; ?></td>
							<td><?php echo $row['description']; ?></td>
							<td><?php echo $row['date']; ?></td>
							<td>
								<a href="<?php echo $row['image']; ?>" target="_blank">
									<img style="width:200px;" src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['work_type']; ?>" width="100">
								</a>
							</td>
							<td>
								<a href="view.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View</a>
								<a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this work detail?')">Delete</a>
							</td>
						</tr>
						<?php
					}
				} else {
					echo '<tr><td colspan="6" class="text-center">No work details found.</td></tr>';
				}
				$conn->close();
				?>
			</tbody>
		</table>
	</div>

  <?php 
include 'footer.php';
  ?>

</body>
</html>