<?php
	include('functions.php');
	$db = getConnection();	
	
	//recieve input from email and password inputs on login.php page
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	//select statement pulling details from database
	 $sql = "SELECT memberID, email, name, password FROM members WHERE email = :email";
        
        if($stmt = $db->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = $_POST["email"];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
				
                // Check if username exists in members table, if yes then verify hashed password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["memberID"];
                        $email = $row["email"];
						$name = $row["name"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
							
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["name"] = $name;                           
							
							//Set current time and date of login
							$login = date('Y-m-d H:i:s'); 
							
							//Update statement to add $login to users row in members table
							$update = "UPDATE members SET lastLogin = :login WHERE memberID = $id"; 
							
							$update2 = $db->prepare($update); 
							
							//Bind variables to the prepared statement as parameters
							$update2->bindParam(":login", $login);
							
							//execute update
							$update2->execute(); 
							
                            // Redirect user to members homepage page
                            header("location: membersHomepage.php"); 
							
                        } else{
                            // redirect user back to login page if password was incorrect
							echo" incorrect password";
							header("location: Login.php");
                        }
                    }
                } 
				else{
                    // Redirect user back to login page if username was not found in databse
					echo "incorrect username";
					header("location: Login.php");
                }
            } else{
					// redirect user back to login if the prepared statement fails to execute
				header("location: Login.php");
            }
		}
	
?>
