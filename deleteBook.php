<?php 	

	session_start(); 
		
		//Database connection
		require_once('functions.php');
		$db = getConnection();
	
		//Assign selected button value to $ID varible		
		$ID = $_POST['bookid'];
		
		//Assign session variable
		$membID = $_SESSION['id'];	


		//Delete statement to delete selected book from database where bookID matches selected book ID and member ID matches logged in member
		$sql = "DELETE FROM saved_books WHERE bookID = :id AND memberID = :membID";
		$stmt = $db->prepare($sql); 

		//Bind parameters
		$stmt->bindParam(':id', $ID);
		$stmt->bindParam(':membID', $membID);
 
		$stmt->execute(); 


		header('location:booklist.php');



?>			
	






















