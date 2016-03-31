<!DOCTYPE html>

<html>
	<head> 
	</head>
	
	<body>     
		<?php 
		$name = $email = $password = $country ="";
		$nameErr = $emailErr = $passErr = $countryErr =  "";
		$lid = $lpassword= "";
		$lidErr= $lpassErr = "";
		$loginCheck="";
		//Variables for database.
		$servername = "localhost";
		$username = "root";
		$dbpassword = "";
		$dbname ="Store_db";
		$forSignUp = "Sign Up";
		$forLogIn = "LogIn";
		
		if($_SERVER["REQUEST_METHOD"] == "POST")
			{
			if($forSignUp == $_POST["submit"])
			{
				if(empty($_POST["name"])){
					$nameErr = "Kindly Enter Name Properly";
				}
				else{				
					$name = test_input($_POST["name"]);
					 if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
					 {
					   $nameErr = "Only letters and white space allowed"; 
					 }
				}
				
				if(empty($_POST["email"])){
					$emailErr = "Kindly Enter email Properly";
				}
				else{				
					$email = test_input($_POST["email"]);
				 if (!filter_var($email, FILTER_VALIDATE_EMAIL))
				 {
						$emailErr = "Invalid email format"; 
				 }
				}
				
				if(empty($_POST["password"])){
					$passErr = "password length should be 8-13 characters";
				}
				else{				
					$password = test_input($_POST["password"]);
				}
				
				if(empty($_POST["country"])){
					$countryErr = "Mention the Country";
				}
				else{				
					$country = test_input($_POST["country"]);
				}
				
				if(preg_match("/^[a-zA-Z ]*$/",$name) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($_POST["password"]) && !empty($_POST["country"]) )
				{
					$conn = new mysqli($servername, $username, $dbpassword, $dbname);
					if ($conn ->connect_error) 
					{
					die("Database connection failed: " . $conn->connect_error);
					}

					$sql  = "INSERT INTO PracticeTable(username,userpassword, useremail,usercountry)
							VALUES ('$name', '$password', '$email', '$country')";
					if(mysqli_query($conn,$sql))
					{
						echo "record added";
					}
					else
					{
						echo "error".$sql. "<br>". mysql_error($conn);
					}
					mysqli_close($conn);
		
						
					}
			
			}
			
			if($forLogIn == $_POST["submit"])
			{
				if(empty($_POST["myid"])){
					$lid = "Kindly Enter email Properly";
				}
				else{				
					$lid = test_input($_POST["myid"]);
				 if (!filter_var($lid, FILTER_VALIDATE_EMAIL))
				 {
						$lidErr = "Invalid email format"; 
				 }
				}
				
				if(empty($_POST["myPassword"])){
					 $lpassErr = "password length should be 8-13 characters";
				}
				else{				
					$lpassword = test_input($_POST["myPassword"]);
				}
				$conn = mysqli_connect($servername, $username, $dbpassword, $dbname);
					if ($conn ->connect_error) 
					{
					die("Database connection failed: " . $conn->connect_error);
					}
					
				   $sql= "SELECT * from PracticeTable WHERE useremail='$lid'";
					if($result = mysqli_query($conn,$sql))
					{
					$numrows = mysqli_num_rows($result);
						if($numrows !=0)
						{
							while($row = mysqli_fetch_assoc($result))
							{
								$dbusername = $row['useremail']; 
								$dbpassword = $row['userpassword'];
							}
							
							// verifiying pasword and email
							if($lid == $dbusername && $lpassword == $dbpassword)
							{
								echo"password correct";
							}
							else	
							{
								echo "Incorect Password";
							}
						}
						else
						{
							die("User Doesn't Exist");
						}
					mysqli_free_result($result);
					}
			}
		}
		function test_input($data)
		{
			$data = trim($data);
			$data = stripcslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		?>
    
	
		 <form name='registration' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

		<fieldset>
                    <legend id="mylegend"><b>Get Registered</b></legend>
                    <ul>
                        <li><input id="x" type="date" class="inputs" /></li>   
						<li><input id="x" type="text"  class="inputs " name="name" value="<?php echo $name; ?>" placeholder="User Name" /> </li>
                        <span class="error"> <?php echo $nameErr; ?> </span>
  					    <li><input id="x" type="email" class="inputs" name="email" value="<?php echo $email; ?>" placeholder="Email" /> </li>
                        <span class="error"> <?php echo $emailErr; ?> </span>
						<li><input id="x" type="password" class="inputs" name="password" value="<?php echo $password; ?>" placeholder="Password" /> </li>
                        <span class="error"> <?php echo $passErr; ?> </span>
						<li><input id="x" type="text" class="inputs" name="country" value="<?php echo $country; ?>" placeholder="Country" />  </li>
                        <li><input id="x" type="submit" class="inputs" name="submit"  value="Sign Up"/> </li>
						<li><a href="#myModal">logIn</a></li>
						<span class="error"> <?php echo $loginCheck; ?> </span>
					
                    </ul>    
                </fieldset>
		</form> 
		
		
		     <div class="modal fade" id="myModal">
				<div class="modal-dialog">
				  <div class="modal-content">
					  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						  <h4 class="modal-title">Log-in</h4>
						</div>
						<div class="modal-body">
							
								  <div class="form-group">
									<label for="InputEmail1">Email address</label>
									<input class="form-control" id="exampleInputEmail" name="myid" placeholder="Enter email" value="<?php echo $lid; ?>" type="email">
									<span class="error"> <?php echo $lidErr ; ?> </span>
								  </div>
								  <div class="form-group">
									<label for="InputPassword1">Password</label>
									<input class="form-control" id="InputPassword" name="myPassword" placeholder="Password" type="password">
									<span class="error"> <?php echo $lpassErr;  ?> </span>
								  </div>
						</div>
						<div class="modal-footer">     
						  <a href="#" data-dismiss="modal" class="btn">Close</a>
						  <a href="#" ><input id="x" type="submit" class="inputs" name="submit"  value="LogIn" action="#"/></a>
						</div>
					 </form>		
				  </div>
				</div>
		</div> 
		
	</body>
</html>