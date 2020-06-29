<?php 

session_start(); 

	//checks if sessions loggedin variable is NOT true, if no variable exists direct user to index.php 
	if (!isset($_SESSION["loggedin"])) 
	{
		header("location: index.php");
	}
	
	//Assign session variables
    $id = $_SESSION["id"]; 
	$name = $_SESSION["name"];

	//Database connection
	include('functions.php');
	$db = getConnection();
 ?>
 
<!DOCTYPE html>
<html lang="en">
		<head>
				<meta charset="utf-8">
				<title>Your Booklist</title>
				<link rel="stylesheet" href="CSS/booklist.css">
		</head>
		
		<header> 
					
					<div class="navigation-bar">
						<h1>
							<?php 
								echo "Welcome " . $name . " to your Booklist." 
							?>
							<br>
							View your current booklist below or remove books you no longer need!
						</h1>
						<ul>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</div>
		</header>	
		
		<body>
				<!--Button to return to homepage -->
				<form action="membersHomepage.php">
						<input type="submit" value="Homepage" />
				</form>

		<!--Form to run deleteBook php file on form submit-->
		<form action="deleteBook.php" method ="post">
		<table> 
			<thead> 
				<tr>
					<th>Title</th>
					<th>Author</th>
					<th>Description</th>
					<th>Year Published</th>
					<th>Buy Now</th>
					<th>Selected</th>

				</tr>
			</thead>
			
			<tbody> 
			<?php 
					//Query to select all saved books from the database that match the logged in users ID
					$query = "SELECT bookID, bookTitle, author, description, link, yearPublished FROM saved_books WHERE memberID = $id";
					
					$result = $db->query($query); 
					
					//Display all results in a table matching the rest of the system
					while ($row = $result->fetchObject())
					{
						echo "<tr>";
						echo "<td>". $row->bookTitle . "</td>";
						echo "<td>". $row->author . "</td>";
						echo "<td>". $row->description . "</td>";
						echo "<td>". $row->yearPublished . "</td>";
						echo "<td><a href = " . $row->link .">Buy</a></td>";
						echo "<td><button type = 'submit' name='bookid' value=". $row->bookID . ">Remove from List</button>
							 </td>";
						echo "</tr>"; 
					}
			?>
			</tbody>
			
		</table> 
		</form> 
		</body>
		
		<footer>
				<!--Generic sitewide footer -->
				<div class="footer">
						<h2>Ben Rowell - 19032995</h2>
						<h3> KV6034 - Web Assignment</h3>
				<div>
				
		</footer>
</html>
