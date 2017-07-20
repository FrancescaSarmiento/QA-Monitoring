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
                <li >
                    <a href="dashboard.php">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php
                    if($type == 'Super Admin'){
                       echo "<li class = 'active'>
                                <a href='user.php' >
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
                    <a class="navbar-brand" href="#">Edit Profile</a>
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
               <div class="row">
                  <div class="card">
                         <div class="header">
                            <h4 class="title">Edit Profile</h4>
                        </div>
                         <div class="content">
                            <?php
                                $id = $_GET['id'];
                                $queryList="SELECT firstname, lastname, email, position, type, username, userId FROM user WHERE userId = '$id' ";

                                if ($result=mysqli_query($db, $queryList)) {
                                    if(mysqli_num_rows($result) > 0) {
                                        echo "<form action='editStat?id=$id' method='post'>";
                                            while ($row=mysqli_fetch_assoc($result)) {
                                                $i = $row['userId'];
                                                $f = $row['firstname'];
                                                $l = $row['lastname'];
                                                $e = $row['email'];
                                                $p = $row['position'];
                                                $t = $row['type'];
                                                $u = $row['username'];
    
                                                
                            ?>     
                                <div class="row">
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name ="meow" class="form-control border-input" placeholder="<?php echo $u; ?>" value="<?php echo $u; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="email" name ="e" class="form-control border-input" placeholder="<?php echo $e; ?>" value="<?php echo $e; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name ="fn" class="form-control border-input" placeholder="<?php echo $f; ?>" value="<?php echo $f; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" name ="ln" class="form-control border-input" placeholder="<?php echo $e; ?>" value="<?php echo $l; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Position</label>
                                                <select name="position" class="form-control border-input">
                                                    <?php
                                                        if($p == 'QA'){
                                                            echo "<option><strong> QA </strong></option>";
                                                            echo "<option>Coach</option>";
                                                        }else if($p == 'Coach'){
                                                            echo "<option><strong> Coach </strong></option>";
                                                            echo "<option> QA </option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select name="role" class="form-control border-input">
                                                    <?php
                                                        if($t == 'Regular'){
                                                            echo "<option><strong> Regular </strong></option>";
                                                            echo "<option> Super Admin </option>";
                                                            echo "<option> Admin </option>";
                                                        }else if($t == 'Admin'){
                                                            echo "<option><strong> Admin </strong></option>";
                                                             echo "<option> Super Admin </option>";
                                                             echo "<option> Regular </option>";
                                                        }else if($t == 'Super Admin'){
                                                            echo "<option><strong> Super Admin </strong></option>";
                                                            echo "<option> Admin </option>";
                                                            echo "<option> Regular </option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-10">
                                             <a href="user.php"><button type="button"  class="btn btn-danger btn-fill btn-wd">Cancel</button></a>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit"  name ="submit" class="btn btn-info btn-fill btn-wd">Update Profile</button>
                                            </div>
                                    </div>
                                    <div class="clearfix"></div>
                                
                                
                                
                                
                                
                                <?php
                                            }
                                            echo " </form>";
                                        }
                                    }

                                ?>
                             <!-- Update User-->
                             <?php
                                if(isset($_POST['submit'])){
                                    $role = $_POST['role'];
                                    $position = $_POST['position'];
                                    
                                    
                                    if($role != $t  || $position != $p){
                                        mysqli_query($db, "UPDATE user SET type ='$role', position = '$position' WHERE userId = '$i' ");
                                        header("Location: ../dashboard/user.php");
                                    }
                                    
                                    
                                    
                                }
                             
                             ?>
                               
                         </div>
                     </div>
                </div>
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
