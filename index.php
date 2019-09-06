<?php 

	// connect to the db
	$connection = mysqli_connect('localhost', 'alex', '123456789', 'users');

	// checking the connection
	if(!$connection) {
		echo "Connection error: " . mysqli_connect_error();
	}

	// quering for all the users in the db
	$sql = "SELECT * FROM users";
	$result = mysqli_query($connection, $sql);

	// fetching the resulting rows as an array
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// cleaning up the result and closing the connection
	mysqli_free_result($result);
	mysqli_close($connection);

	// loading OMDb API PHP Wrapper
	require 'vendor\autoload.php';

	$omdb = new Rooxie\OMDb('4f1e48cb');

	//print_r($users);

// you may also consider to include a header.php for a submission and delete forms
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Favourite movies</title>
 </head>
 <body>
 	<h1><a href="add.php">Click here to manage entries</a></h1><br>
 	<h1>Here's the list of favourite movies of all the users:</h1>
 	<div>
 		<?php foreach ($users as $user) { ?>
 			
 			<div>
 				<h2><?php echo '<u>' . $user['firstName'] . " " . $user['lastName'] . '</u>'; ?></h2>
 				<?php $id_values = explode(',', $user['favourite_movies']); 
 				 
 				// use foreach again to go through all the values to get the title and everything else?>
 				<?php foreach ($id_values as $value) { ?>
 					<div>
 						<?php $movie = $omdb->getByImdbId($value);
 							echo '<h3>' . $movie->getTitle() . '</h3><br>';
 							echo $movie->getPlot() . '<br><br>';
 							$array = $movie->toArray();
 							$posterURL = $array['Poster'];
 							echo '<img src="' . $posterURL . '">';
 						?>
 					</div>
 				<?php } ?>
 			</div>

 		<?php } ?><br>
 	</div>
 </body>
 </html>