<?php
    session_start();
    ob_start();
     
    if ($_SESSION['loggedin'] == false ) {
        header('Location: ../login/index.php');
    }else{
        
    }
?>

<?php
    $db = new mysqli("localhost", "root", "", "ntu_monitoring");
        // Check connection
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
?>
<?php
    $email = $_SESSION['username'];
    $queryName = mysqli_query($db, "SELECT CONCAT(firstname, ' ' ,lastname) as name, userId, type FROM user WHERE email = '$email'");
    $rowUser = $queryName->fetch_assoc();
    $name = $rowUser['name'];
    $id = $rowUser['userId'];
    $type = $rowUser['type'];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>QA Monitoring</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>



    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">
    <link rel="icon" href="../login/assets/ico/logo.png">

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                
                <a href="#" class="simple-text">
                    QA Monitoring
                </a>
                
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="dashboard.php">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php
                    if($type == 'Super Admin'){
                       echo "<li>
                                <a href='user.php'>
                                    <i class='ti-view-list-alt'></i>
                                    <p>Manage User</p>
                                </a>
                            </li>"; 
                    }
                
                
                
                    if($type != 'Regular'){
                        echo "<li>
                                <a href='cat.php'>
                                    <i class='ti-write'></i>
                                    <p>Category</p>
                                </a>
                            </li>";
                        
                    }
                    
                ?>
                <li>
                    <a href="eval.php">
                        <i class="ti-file"></i>
                        <p>Evaluation Form</p>
                    </a>
                </li>
                
                
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                             <?php
                                echo "<a href='editAccount?id=$id' class='simple-text'>";
                                    echo "<strong>Hello, </strong>";

                                    echo "<strong> <em>". $name . " </em></strong>";

                                echo "</a>";
                            ?>
                            
                        </li>
                        <li>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <button type="submit" name="Logout" class="btn btn-link" style="text-decoration: none;"><strong>Logout</strong></button>
                            </form>
                            <?php
                                if(isset($_POST['Logout'])) {
                                    $_SESSION['loggedin'] = false;
                                    session_destroy();
                                    header("Location: ../login/index.php");
                                } 
                            ?>
                        </li>
                        
                    </ul>

                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <p>Meow</p>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                
                <div class="copyright pull-right">
                    &copy; OJT-Interns <script>document.write(new Date().getFullYear())</script>. Saint Louis University - SCIS. All Rights Reserved, made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>
                </div>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>


    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="assets/js/paper-dashboard.js"></script>

	

	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'ti-gift',
            	message: "Welcome to <b>Paper Dashboard</b> - a beautiful Bootstrap freebie for your next project."

            },{
                type: 'success',
                timer: 4000
            });

    	});
	</script>

</html>
