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
				//load xml file
				$xml = simplexml_load_file('booklist.xml');
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
				
				<!-- for each 'item' element within the XML assign it to the variable $book. Assign the link element within book to the $link variable. 
					 echo each result in a table row displaying title, author, descition, published and external link-->
			<?php foreach ($xml->channel->item as $book) :
				$link = $book->link?>
					<tr> 
						<td><?php echo $book->title ?></td>
						<td><?php echo $book->author ?></td>
						<td><?php echo $book->description ?></td>
						<td><?php echo $book->yearPublished ?></td>
						<td><?php echo "<a href = '".$link."'>Buy</a>";?></td>
						
					</tr> 
		
			<?php endforeach; ?>
			
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
