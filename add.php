<?php 

	// connect to the db
	$connection = mysqli_connect('localhost', 'alex', '123456789', 'users');

		// quering for all the users in the db
	$sql = "SELECT * FROM users";
	$result = mysqli_query($connection, $sql);

	// fetching the resulting rows as an array
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// checking the connection
	if(!$connection) {
		echo "Connection error: " . mysqli_connect_error();
	}

	// if the button for adding a movie was clicked
	if(isset($_POST['submit_movie'])) {
		$id = $_POST['imdbid'];
		$name = explode('_', $_POST['user_name']);
		echo $name[0] . ' ' . $name[1];

		$sql = "UPDATE users SET favourite_movies = CONCAT(favourite_movies, ',$id') WHERE firstName='$name[0]' AND lastName='$name[1]'"; 
		$result = mysqli_query($connection, $sql);

		header("Location: index.php");
	}

	// if the button for deleting movie was clicked
	if(isset($_POST['delete_movie'])) {
		// explode and foreach, than append every id which is not matching the input, then update
		$id = $_POST['select_movie'];
		$name = explode('_', $_POST['select_user']);

		$sql = "SELECT favourite_movies FROM users WHERE firstName='$name[0]' AND lastName='$name[1]'";
		$result = mysqli_query($connection, $sql);
		$str = mysqli_fetch_array($result);
		$movies = explode(',', $str[0]);

		// creating new string to replace existing string in a favourite_movies cell
		$newValue = '';

		for($i = 0; $i < count($movies); $i++) {

		}

		// going throug each movie id and check if there is a match; if there is, we don't append it to the resulting string
		foreach ($movies as $movie) {
			if($movie != $id) {
				if($newValue == '') {
					$newValue = $newValue . $movie;
				}
				else {
					$newValue = $newValue . ',' . $movie;
				}
			}
		}
		// update the record in the database
		$sql = "UPDATE users SET favourite_movies = '$newValue' WHERE firstName='$name[0]' AND lastName='$name[1]'"; 
		$result = mysqli_query($connection, $sql);

		header("Location: index.php");
	}


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Managing entries</title>
 </head>
 <body>
 	<table>

 		<tr>
		 	<th><h1>Add a movie to a user</h1></th>
		</tr>

		<tr>
			<td>
					User:<br>
					<form action="add.php" method="POST">
						
						<select name="user_name">
							<?php 
								foreach ($users as $user):
									echo '<option value="'.$user['firstName'].'_'.$user['lastName'].'">'.$user['firstName'].' '.$user['lastName'].'</option>';
								endforeach;
							 ?>
						</select><br>
						IMDB id:<br>
				  		<input type="text" name="imdbid">
				  		<input type="submit" name="submit_movie" value="Add new movie">
			  		</form>
			</td>
		</tr>
		<tr>
			<th><h1>Delete a movie from the user's list</h1></th>
		</tr>
		<tr>

			<td>
				<form action="add.php" method="POST">
					<!-- select for a user -->
					User:<br>
					<select name="select_user">
						<?php 
							foreach ($users as $user):
								echo '<option value="'.$user['firstName'].'_'.$user['lastName'].'">'.$user['firstName'].' '.$user['lastName'].'</option>';
							endforeach;
						 ?>
					</select><br>
					<!-- select for a movie from the user list -->
					Movie id:<br>
					<!-- was trying to get all the movies for a selected user from dropdown, but haven't succeed yet.
						For now, user needs to type in the imdb id manually

					<select name="select_movie">
						<?php 
							//$username = explode('_', $_POST['select_user']);
							//$sql = "SELECT favourite_movies FROM users WHERE firstName='$username[0]' AND lastName='$username[1]'";
							//$result = mysqli_query($connection, $sql);
							//$movie = mysqli_fetch_all($result, MYSQLI_ASSOC);
							//echo '<option value="' . $movie . '">' . $movie . '</option>';
						 ?>
					</select>
					-->
					<input type="text" name="select_movie">
			  		<input type="submit" name="delete_movie" value="Delete movie">
				</form>
			</td>
		</tr>

	</table>
	<br>
	<h2><a href="index.php"><-- Go back</a></h2>
 </body>
 </html>