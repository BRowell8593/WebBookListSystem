<?php include('functions.php');
$db = getConnection();
 ?>
 
<!DOCTYPE html>
<html lang="en">
		<head>
				<meta charset="utf-8">
				<title>Booklist Homepage</title>
				<link rel="stylesheet" href="CSS/index.css">
		</head>
		<body>
		<header> 
					
					<div class="navigation-bar">
						<h1>
							Welcome to the Booklist System
							<br>
							Please login to view and create your personal booklist!
						</h1>
						<ul>
							<li><a href="Login.php">Login</a></li>
						</ul>
					</div>
		</header>	
	
		<!-- search bar and search button creation-->
		<form id = "searchBar" action = "indexSearch.php" method = "post" > 
		<input type="text" name="searchbar" placeholder="   Search here: ">
        <input type="submit" name="search" value="Search">
		</form> 

		<?php
				$xmlfile = simplexml_load_file('booklist.xml');
				$searchTerm = $_POST["searchbar"];
		?>
		
		
		<table> 
			<thead> 
				<tr>
					<th>Title</th>
					<th>Author</th>
					<th>Description</th>
					<th>Year Published</th>
					<th>Buy Now</th>
				</tr>
			</thead>
			
			<tbody> 
			<?php	
			// search the XML for any author or book title within item that contains the inputted $searchTerm variable
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
					echo "</tr>";
			}
			?>
			</tbody>
		</table> 
		
		
		<footer>
				<!-- generic sitewide footer -->
				<div class="footer">
				<h2>Ben Rowell - 19032995</h2>
				<h3> KV6034 - Web Assignment</h3>
				</div>
		</footer>
		</body>
</html>
