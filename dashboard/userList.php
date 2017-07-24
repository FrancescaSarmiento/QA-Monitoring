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

	<title>NTU | QA Monitor</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="assets/css/style.css" rel="stylesheet" type="text/css">

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
                
                <a href=dashboard.php class="simple-text">
                    Quality Assurance Monitoring
                </a>
                
            </div>

            <ul class="nav">
                <li>
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
                <?php
                    if($type == 'Super Admin'){
                       echo "<li class='active'>
                                <a href='userList.php'>
                                    <i class='ti-view-list-alt'></i>
                                    <p>Agents Information</p>
                                </a>
                            </li>"; 
                    }
                ?>
                
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
                    <a class="navbar-brand" href="#">Results Summary</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                             <?php
                                echo "<a href='editAccount?id=$id' class='simple-text'>";
                                    echo "<strong>Hello, </strong>";

                                    echo "<strong> ". $name . "!</strong>";

                                echo "</a>";
                            ?>
                            
                        </li>
                        <li>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <button type="submit" name="Logout" class="btn btn-link logout" style="text-decoration: none;"><strong>Logout</strong></button>
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
                <div class="row font">
                    <div class="col-lg-12">
                        <ul  class="nav nav-tabs ">
                            <!-- N E E D     M O D I F I C A T I O N -> <-->
                                <li class="active" > <a href="#all" data-target="#all" data-toggle="tab"><strong>All</strong></a>  </li>
                                <li  ><a  href="#OPS1" data-target="#OPS1" data-toggle="tab"><strong>OPS1</strong></a> <li> 
                                <li  ><a  href="#OPS2" data-target="#OPS2" data-toggle="tab"><strong>OPS2</strong></a> <li>
                                <li  ><a  href="#OPS3" data-target="#OPS3" data-toggle="tab"><strong>OPS3</strong></a> <li>
                            <li  ><a  href="#OPS4" data-target="#OPS4" data-toggle="tab"><strong>OPS4</strong></a> <li>
                            <li  ><a  href="#OPS5" data-target="#OPS5" data-toggle="tab"><strong>OPS5</strong></a> <li>
                            <!-- E N D   O F   N E E D E D   M O D I F I C A T I O N - > <-->

                        </ul> 
                        <div class="tab-content clearfix">
                            <div class="tab-pane fade in active" id="all">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-responsive table-striped">
                                            <thead class="topper font">
                                                <tr class="font">
                                                    <th class="text-center font" style="width: 10%;" >Full Name</th>
                                                    <th class="text-center font" style="width: 4%;" >Area</th>
                                                    <th class="text-center font" style="width: 4%;" >Team</th>
                                                    <th class="text-center font" style="width: 10%;" >Evaluator</th>
                                                    <th class="text-center font" style="width: 5%;" >Date</th>
                                                    <th class="text-center font" style="width: 4%;" >Score</th>
                                                </tr>
                                            </thead>


                                                <?php

                                                    $agent="SELECT CONCAT(lastname, ', ', firstname)'name', team, area, score, evaluator, dateCompleted FROM agentinfo ORDER BY area ASC, lastname ASC ";

                                                    if ($result=mysqli_query($db, $agent)) {
                                                        if(mysqli_num_rows($result) > 0) {
                                                           while ($row=mysqli_fetch_assoc($result)) {
                                                                echo "<tr>";
                                                                echo "<td class='text-center font'>".$row['name']."</td>";
                                                                echo "<td class='text-center font'>".$row['area']."</td>";
                                                                echo "<td class='text-center font'>".$row['team']."</td>";
                                                                echo "<td class='text-center font'>".$row['evaluator']."</td>";
                                                                echo "<td class='text-center font'>".$row['dateCompleted']."</td>";
                                                                echo "<td class='text-center font'><strong>".$row['score']."</strong></td>";
                                                                echo "</tr>";
                                                            }
                                                        }
                                                    }

                                                ?>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade  "id="OPS1">
                                 <div class="col-lg-12">
                                     <div class="table-responsive">
                                        <table class="table table-responsive table-hover table-striped">
                                            <thead class="topper">
                                                <tr class="font">
                                                    <th class="text-center font" style="width: 20%;" >Full Name</th>
                                                    <th class="text-center font" style="width: 15%;" >Area</th>
                                                    <th class="text-center font" style="width: 15%;" >Team</th>
                                                    <th class="text-center font" style="width: 10%;" >Evaluator</th>
                                                    <th class="text-center font" style="width: 10%;" >Date</th>
                                                    <th class="text-center font" style="width: 10%;" >Score</th>


                                                </tr>
                                            </thead>


                                                <?php

                                                     $agent="SELECT CONCAT(lastname, ', ', firstname)'name', team, area, score, evaluator, dateCompleted FROM agentinfo WHERE area = 'OPS1' ORDER BY idCA ASC, lastname ASC ";

                                                    if ($result=mysqli_query($db, $agent)) {
                                                        if(mysqli_num_rows($result) > 0) {
                                                           while ($row=mysqli_fetch_assoc($result)) {
                                                                echo "<tr>";
                                                                echo "<td class='text-center font'>".$row['name']."</td>";
                                                                echo "<td class='text-center font'>".$row['area']."</td>";
                                                                echo "<td class='text-center font'>".$row['team']."</td>";
                                                                echo "<td class='text-center font'>".$row['evaluator']."</td>";
                                                                echo "<td class='text-center font'>".$row['dateCompleted']."</td>";
                                                                echo "<td class='text-center font'><strong>".$row['score']."</strong></td>";
                                                                echo "</tr>";
                                                            }
                                                        }
                                                    }

                                                ?>

                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="tab-pane fade  "id="OPS2">
                                 <div class="col-lg-12">
                                      <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead class="topper">
                                                <tr class="font">
                                                    <th class="text-center font" style="width: 20%;" >Full Name</th>
                                                    <th class="text-center font" style="width: 15%;" >Area</th>
                                                    <th class="text-center font" style="width: 15%;" >Team</th>
                                                    <th class="text-center font" style="width: 10%;" >Evaluator</th>
                                                    <th class="text-center font" style="width: 10%;" >Date</th>
                                                    <th class="text-center font" style="width: 10%;" >Score</th>
                                                </tr>
                                            </thead>


                                                <?php

                                                    
                                                     $agent="SELECT CONCAT(lastname, ', ', firstname)'name', team, area, score, evaluator, dateCompleted FROM agentinfo WHERE area = 'OPS2' ORDER BY idCA ASC, lastname ASC ";

                                                    if ($result=mysqli_query($db, $agent)) {
                                                        if(mysqli_num_rows($result) > 0) {
                                                           while ($row=mysqli_fetch_assoc($result)) {
                                                                echo "<tr>";
                                                                echo "<td class='text-center font'>".$row['name']."</td>";
                                                                echo "<td class='text-center font'>".$row['area']."</td>";
                                                                echo "<td class='text-center font'>".$row['team']."</td>";
                                                                echo "<td class='text-center font'>".$row['evaluator']."</td>";
                                                                echo "<td class='text-center font'>".$row['dateCompleted']."</td>";
                                                                echo "<td class='text-center font'><strong>".$row['score']."</strong></td>";
                                                                echo "</tr>";
                                                            }
                                                        }
                                                    }

                                                ?>

                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="tab-pane fade  "id="OPS3">
                                 <div class="col-lg-12">
                                      <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead class="topper">
                                                <tr class="font">
                                                    <th class="text-center font" style="width: 20%;" >Full Name</th>
                                                    <th class="text-center font" style="width: 15%;" >Area</th>
                                                    <th class="text-center font" style="width: 15%;" >Team</th>
                                                    <th class="text-center font" style="width: 10%;" >Evaluator</th>
                                                    <th class="text-center font" style="width: 10%;" >Date</th>
                                                    <th class="text-center font" style="width: 10%;" >Score</th>
                                                </tr>
                                            </thead>


                                                <?php

                                                    
                                                     $agent="SELECT CONCAT(lastname, ', ', firstname)'name', team, area, score, evaluator, dateCompleted FROM agentinfo WHERE area = 'OPS3' ORDER BY idCA ASC, lastname ASC ";

                                                    if ($result=mysqli_query($db, $agent)) {
                                                        if(mysqli_num_rows($result) > 0) {
                                                           while ($row=mysqli_fetch_assoc($result)) {
                                                                echo "<tr>";
                                                                echo "<td class='text-center font'>".$row['name']."</td>";
                                                                echo "<td class='text-center font'>".$row['area']."</td>";
                                                                echo "<td class='text-center font'>".$row['team']."</td>";
                                                                echo "<td class='text-center font'>".$row['evaluator']."</td>";
                                                                echo "<td class='text-center font'>".$row['dateCompleted']."</td>";
                                                                echo "<td class='text-center font'><strong>".$row['score']."</strong></td>";
                                                                echo "</tr>";
                                                            }
                                                        }
                                                    }

                                                ?>

                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="tab-pane fade  "id="OPS4">
                                 <div class="col-lg-12">
                                      <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead class="topper">
                                                <tr>
                                                    <th class="text-center font" style="width: 20%;" >Full Name</th>
                                                    <th class="text-center font" style="width: 15%;" >Area</th>
                                                    <th class="text-center font" style="width: 15%;" >Team</th>
                                                    <th class="text-center font" style="width: 10%;" >Evaluator</th>
                                                    <th class="text-center font" style="width: 10%;" >Date</th>
                                                    <th class="text-center font" style="width: 10%;" >Score</th>
                                                </tr>
                                            </thead>


                                                <?php

                                                    
                                                     $agent="SELECT CONCAT(lastname, ', ', firstname)'name', team, area, score, evaluator, dateCompleted FROM agentinfo WHERE area = 'OPS4' ORDER BY idCA ASC, lastname ASC ";

                                                    if ($result=mysqli_query($db, $agent)) {
                                                        if(mysqli_num_rows($result) > 0) {
                                                           while ($row=mysqli_fetch_assoc($result)) {
                                                                echo "<tr>";
                                                                echo "<td class='text-center font'>".$row['name']."</td>";
                                                                echo "<td class='text-center font'>".$row['area']."</td>";
                                                                echo "<td class='text-center font'>".$row['team']."</td>";
                                                                echo "<td class='text-center font'>".$row['evaluator']."</td>";
                                                                echo "<td class='text-center font'>".$row['dateCompleted']."</td>";
                                                                echo "<td class='text-center font'><strong>".$row['score']."</strong></td>";
                                                                echo "</tr>";
                                                            }
                                                        }
                                                    }

                                                ?>

                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="tab-pane fade  "id="OPS5">
                                 <div class="col-lg-12">
                                      <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead class="topper">
                                                <tr>
                                                    <th class="text-center font" style="width: 20%;" >Full Name</th>
                                                    <th class="text-center font" style="width: 15%;" >Area</th>
                                                    <th class="text-center font" style="width: 15%;" >Team</th>
                                                    <th class="text-center font" style="width: 10%;" >Evaluator</th>
                                                    <th class="text-center font" style="width: 10%;" >Date</th>
                                                    <th class="text-center font" style="width: 10%;" >Score</th>
                                                </tr>
                                            </thead>


                                                <?php

                                                    
                                                     $agent="SELECT CONCAT(lastname, ', ', firstname)'name', team, area, score, evaluator, dateCompleted FROM agentinfo WHERE area = 'OPS5' ORDER BY idCA ASC, lastname ASC ";

                                                    if ($result=mysqli_query($db, $agent)) {
                                                        if(mysqli_num_rows($result) > 0) {
                                                           while ($row=mysqli_fetch_assoc($result)) {
                                                                echo "<tr>";
                                                                echo "<td class='text-center font'>".$row['name']."</td>";
                                                                echo "<td class='text-center font'>".$row['area']."</td>";
                                                                echo "<td class='text-center font'>".$row['team']."</td>";
                                                                echo "<td class='text-center font'>".$row['evaluator']."</td>";
                                                                echo "<td class='text-center font'>".$row['dateCompleted']."</td>";
                                                                echo "<td class='text-center font'><strong>".$row['score']."</strong></td>";
                                                                echo "</tr>";
                                                            }
                                                        }
                                                    }

                                                ?>

                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>  
                    </div>
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                
                <div class="copyright pull-right">
                    &copy;Saint Louis University - SCIS. All Rights Reserved. made with <i class="fa fa-heart heart"></i> by OJT-Interns <script>document.write(new Date().getFullYear())</script>.
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
