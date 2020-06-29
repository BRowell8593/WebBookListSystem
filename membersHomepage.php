<?php 
	session_start(); 

	//checks if sessions loggedin variable is NOT true, if no variable exists direct user to index.php 
	if (!isset($_SESSION["loggedin"])) 
	{
		header("location: index.php");
	}
	
	//Set session variables created in authenticate.php to useable variables within page
    $id = $_SESSION["id"]; 
	$name = $_SESSION["name"];
	
	//databse connection
	include('functions.php');
	$db = getConnection();
 
 ?>
 
<!DOCTYPE html>
<html lang="en">
		<head>
				<meta charset="utf-8">
				<title>Members Homepage</title>
				<link rel="stylesheet" href="CSS/membersHomepage.css">
		</head>
		
		<header> 
					
					<div class="navigation-bar">
						<h1> 
							<?php 
								echo "Welcome " . $name . " to the Booklist System." 
							?>
							<br>
							View your booklist or add new books to your list!
						</h1>
						
							<ul>
								<li><a href="logout.php">Logout</a></li>
							</ul>
					</div>
		</header>	
		
		<body>
				<!-- search bar and search button creation-->
				<form id = "searchBar" action = "homepageSearch.php" method = "post" > 
					<input type="text" name="searchbar" placeholder="   Search here: ">
					<input type="submit" name="search" value="Search">
				</form>
				
				<!--button to direct user to their booklist -->
				<form action="booklist.php">
						<input type="submit" value="View Booklist" />
				</form>
						
		<?php
				//Load XML file
				$xml = simplexml_load_file('booklist.xml');
		?>
		
		<!--Create form that holds all book details within a table. Each button on the form runs the insertBook.php-->
		<form action="insertBook.php" method ="post">
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
				
			<!-- for each 'item' element within the XML assign it to the variable $book. Assign each element within each 'item' to variable. -->
			<?php foreach ($xml->channel->item as $book) :
			
				$link = $book->link;
				$bookID = $book->bookid;
				$title = $book->title;
				$author = $book->author; 
				$desc = $book->description; 
				$yearPublished = $book->yearPublished; 
				?>
				
					<!-- echo each result from the above for each loop in a table row. Assigning the link to a external link-->
					<tr> 
						<td><?php echo $title ?></td>
						<td><?php echo $author?></td>
						<td><?php echo $desc ?></td>
						<td><?php echo $yearPublished ?></td>
						<td><?php echo "<a href = '".$link."'>Buy";?></td>
						<td><?php echo 
								//assign the $bookID variable to the value of the button when pressed, allowing the bookID to be passed to insertBook.php
								'<button type ="submit" name="bookID" value="'.$bookID.'">Add to List</button>
							 </td>'; 
							?>
					</tr> 
				
				<?php endforeach; ?>
			
			</tbody>
		</table> 
		</form>
		</body>
		
		<footer>
				<!-- generic sitewide footer -->
				<div class="footer">
						<h2>Ben Rowell - 19032995</h2>
						<h3> KV6034 - Web Assignment</h3>
				<div>
				
		</footer>
</html>


