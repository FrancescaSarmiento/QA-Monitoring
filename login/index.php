

<?php
    session_start();
     
?>



<!DOCTYPE html>

<?php
    $db = new mysqli("localhost", "root", "", "ntu_monitoring");
        // Check connection
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
?>

<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Log In Page</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel ="icon" href="assets/ico/logo.png">



    </head>

    <body>
        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <img src="../image/ntulogo.png" class="logo">
                            <h1 class="page-header"><strong>QA Monitoring</strong> | Login </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<br>
                                    <p>Enter your e-mail and password to log on:</p>
                                    
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock" aria-hidden="true"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="index.php" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="form-username" placeholder="Email..." class="form-username form-control" id="form-username" autofocus>
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="form-password" placeholder="Password..." class="form-password form-control" id="form-password" autofocus>
			                        </div>
                                    
                                    <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
                                        <button type="submit" name="submit" class="btn" ><strong>Log in</strong></button>
			                        </div>
                                    
			                    </form>
                                
                                <?php
                                    if(isset($_POST['submit'])){
                                        $email = $_POST['form-username'];
                                        $pwd = $_POST['form-password'];
                                        
                                        if(!empty($email) && !empty($pwd)){
                                            $queryUser = mysqli_query($db, "SELECT * FROM user WHERE email = '$email'"); 
                                            if(mysqli_num_rows($queryUser) > 0) {

                                                $_SESSION['loggedin'] = true;
                                                $_SESSION['username'] = $email;
                                                header("Location: ../dashboard/dashboard.php");

                                            }else{
                                                    $errorMsg = "Incorrect email or password!";
                                                    mysqli_free_result($queryUser);

                                            }
                                        }
                                        
                                    }
                                
                                
                                ?>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
       

    </body>

</html>