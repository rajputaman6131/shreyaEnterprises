<?php
// Include database configuration file
include 'config.php';

// Get the project ID from the URL parameter
$id = $_GET['id'];

// Delete the project from the database
$sql = "DELETE FROM work_details WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo '<div class="container" style="margin-top:20px;"><p class="alert alert-success">Work detail deleted successfully.</p></div>';
} else {
    echo '<div class="container"><p class="alert alert-danger">Error deleting work detail: ' . $conn->error . '</p></div>';
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete Project Detail</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<div class="container" >
		<a href="admin.php" class="btn btn-default">Back to Work Details</a>
	</div>
</body>
</html>

