<?php 	

	session_start(); 
	
		//database connection
		require_once('functions.php');
		$db = getConnection();

		//assign variables from bookID input, Session variable and current time and date	
		$ID = $_POST['bookID'];
		$membID = $_SESSION['id'];
		$upload = date('Y-m-d H:i:s');


	//Load XML file and query for any book ID matching the passed variable
	$xmlfile = simplexml_load_file('booklist.xml');
	$qry = "channel/item[bookid = '$ID']";
	$xml = $xmlfile->xpath($qry);
	
	//for each result matched assign each element to a variable
	foreach ($xml as $value) {
		
		$link = $value->link;
		$bookID = $value->bookid;
		$bookTitle = $value->title;
		$author = $value->author;
		$desc = $value->description;
		$yearPublished = $value->yearPublished;
	}

	//insert statement to insert values of the selected book into database
	$sql = "INSERT INTO saved_books(bookID, memberID, bookTitle, author, description, link, yearPublished, dateSaved)
		VALUES (?,?,?,?,?,?,?,?)";
	$stmt= $db->prepare($sql);
	$stmt->execute([$ID, $membID, $bookTitle, $author, $desc, $link, $yearPublished, $upload]);
	header('location:membersHomepage.php');
?>			
	






















