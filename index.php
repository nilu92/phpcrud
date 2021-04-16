<!DOCTYPE html>
<html>
<head>
	<title>PHP Crud</title>
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>
<body>
	<?php require_once 'process.php'; ?>
	
	<?php

	if(isset($_SESSION['message'])): ?>

		<div class="alert alert-<?=$_SESSION['msg_type']?>">

			<?php 
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			 ?>
			</div>
		<?php endif  ?>
	<div class="container">
	<?php
		$mysqli = new mysqli('localhost','root','','crud') or die(mysql_error($mysqli));
		$res = $mysqli->query("SELECT * FROM data") or die(mysqli->error);
		//pre_r($res);
		//pre_r($res ->fetch_assoc());
		?>
		<div class="row justify-content-center">
			<table class="table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Location</th>
						<th colspan="2">Action</th>
					</tr>
				</thead>
				<?php
				while ($row = $res->fetch_assoc()): ?>
					<tr>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['location']; ?></td>
						<td>
							<a href="index.php?edit=<?php echo$row['id']; ?>" 
								class="btn btn-info">Edit</a>
								<a href="process.php?delete=<?php echo $row['id']; ?>"
									class="btn btn-danger">Delete</a>
						</td>
					</tr>
				<?php endwhile; ?>
				
			</table>
		</div>
		<?php
		function pre_r($array)
		{
			echo'<pre>';
			print_r($array);
			echo '</pre>';
		}
	?>
	<div class="d-flex align-items-center flex-column justify-content-center h-100 ">
	<form method="POST" action="process.php">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="form-group">
		<label>Name</label>
		<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter your name">
		</div>
		<div class="form-group">
		<label>Location</label>
		<input type="text" name="location" class="form-control"  value="<?php echo $location; ?> "placeholder="enter your location">
		</div>
		<div class="form-group">
		<?php
		if($update == true):
		?>
		<button type="submit" class="btn btn-info" name="update">Update</button>
		<?php else:  ?>
		<button type="submit" class="btn btn-primary" name="save">Save</button>
	<?php endif;  ?>
		</div>
	</form>
	</div>
	</div>
</body>
</html>