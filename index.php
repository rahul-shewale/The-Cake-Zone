<?php 
	
	//1.connect  to databse
	include('config/db_connect.php');
	//2.write query for all cakes
	$sql = 'SELECT title, ingredients, id FROM cakes ORDER BY created_at';

	//3.make query & get result
	$result = mysqli_query($conn, $sql);

	//4.fetch the resulting rows as an array
	$cakes = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//free result from the query.
	mysqli_free_result($result);

	//5.close the connection
	mysqli_close($conn);

	//explode(',',$cakes[0]['ingredients']));

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Cakes!</h4>

	<div class="container">
		<div class="row">
			<?php foreach($cakes as $cake): ?>

				<div class="col s6 md3">
					<div class="card z-depth-0">
					<img src="img/cake.svg" class="cake">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($cake['title']); ?></h6>
							<ul>
								<?php foreach(explode(',', $cake['ingredients']) as $ing): ?>
									<li> <?php echo htmlspecialchars($ing); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="card-action rigth-align">
							<a class="brand-text" href="details.php?id=<?php echo $cake['id'] ?>">more info</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>
		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>




<!-- ---------------index.php---------------
<!DOCTYPE html>
<html>
<?php
// include('templates/header.php');
// include('templates/footer.php');
?>
</html>
------------------templates/header.php---------------------
<head>
<title>Cake Zone</title>
</head>
<body>
---------------------templates/footer.php------------------
<footer> </footer>
</body> -->