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
				<title>Booklist Homepage</title>
				<link rel="stylesheet" href="CSS/index.css">
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
				//load XML file
				$xmlfile = simplexml_load_file('booklist.xml');
				
				//Assign the input from searchBar to the $serchterm variable
				$searchTerm = $_POST["searchbar"];
		?>
		
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
				<?php	
					//Search the XML for any author or book title within item that contains the inputted $searchTerm variable
					$qry = "channel/item[contains(author, '$searchTerm') or contains(title, '$searchTerm')]";
					$xml = $xmlfile->xpath($qry);
	
						//for each result from the above qry assign their values to the below variables
						foreach ($xml as $value) 
						{
							$link = $value->link;
							$bookID = $value->bookid;
							$bookTitle = $value->title;
							$author = $value->author;
							$desc = $value->description;
							$yearPublished = $value->yearPublished;
		
						// echo the variables in a table matching the original index.php page
						echo "<tr>";
							echo "<td>". $bookTitle . "</td>";
							echo "<td>". $author. "</td>";
							echo "<td>". $desc . "</td>";
							echo "<td>". $yearPublished . "</td>";
							echo "<td><a href = " . $link .">Buy</a></td>";
							echo '<td><button type ="submit" name="bookID" value="'.$bookID.'">Add to List</button>
							 </td>';
						echo "</tr>";
						}
				?>
			
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
