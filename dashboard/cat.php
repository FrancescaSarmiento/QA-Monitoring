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
                       echo "<li>
                                <a href='user.php'>
                                    <i class='ti-view-list-alt'></i>
                                    <p>Manage User</p>
                                </a>
                            </li>"; 
                    }
                
                
                
                    if($type != 'Regular'){
                        echo "<li class='active'>
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
                    <a class="navbar-brand" href="#">Category</a>
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

        <?php
            $category =mysqli_query($db, "SELECT ifnull(COUNT(idCat), 0 ) 'c' FROM category");
            $rowCount = $category->fetch_assoc();
            $c = $rowCount['c'];
           
        ?>
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="header">
                        <h4 class="title"><?php
                        
                            if($c == 0){
                                echo "Create A Category";
                            }else{
                                echo "Add Another Category";
                            }
                        
                        ?> </h4>
                        <small class="description">User can create or add a category for the Evaluation Form</small>
                    </div>
                    <div class="content">
                       <?php
                            $n="SELECT catNum from category ORDER BY catNum DESC LIMIT 1";
                            $r = mysqli_query($db, $n);
                            $rowN = $r->fetch_assoc();
                            $number = $rowN["catNum"];

                            if($number ==  0 || $number ==  null ){
                                $number = 0 + 1;
                            }else{
                                $number++;
                            }
                        
                        ?> 
                        
                        <form action ="cat.php" method="post">
                            <div class="form-top">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label><strong>Skill Category <?php echo $number; ?></strong></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        
                                            
                                        <div class="col-md-6">
                                            <input type="text" name ='cat' class="form-control border-input" placeholder="Enter A Category">
                                        
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <button type="submit" class="btn btn-info btn-fill" name="create">Add Sub-Category</button>
                                        
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="clearfix"></div>
                            
                        </form>
                        
                        <?php
                            if(isset($_POST['create'])){
                                $cat = $_POST['cat'];
                                if(!empty($cat)){
                                    $insert = "INSERT INTO category (txtCat, catNum) VALUES ('$cat', '$number')"; 
                                    mysqli_query($db,$insert);

                                    $lastRow = mysqli_query($db, "SELECT idCat FROM category ORDER BY idCat DESC LIMIT 1");
                                    $rowLast = $lastRow->fetch_assoc();
                                    $idLast = $rowLast['idCat'];

                                    header("Location: ../dashboard/subCat.php?id=$idLast");
                                    
                                }else{
                                    
                                }
                                
                                
                            }
                        
                        ?>
                        
                    </div>
                </div>
                
                <div class="card">
                    <div class="header">
                        <div class="title">
                            <h4>Category Created!</h4>
                        </div>
                    </div>
                    <div class="content">
                        <?php

                            $queryCat="SELECT txtCat, idCat, catNum FROM category";

                            if ($result=mysqli_query($db, $queryCat)) {
                                if(mysqli_num_rows($result) > 0) {
                                    echo "<div class='panel panel-info'>";
                                    while ($row=mysqli_fetch_assoc($result)) {
                                        $txtC = $row['txtCat'];
                                        $cId = $row['idCat'];
                                        $numC = $row['catNum'];
                         ?> 
                            <div class='clearfix'></div>
                                
                                        <div class="panel-heading">
                                            <strong> Skill Category <?php echo $numC; ?> : <em><?php echo $txtC; ?></em> </strong>
                                                <!-- button for the modal delete and edit -->
                                                <a href="#delete<?php echo $cId;?>" data-toggle="modal" class="pull-right"><button type="button" class='btn btn-danger btn-sm btn-fill'> <i class='ti-trash' aria-hidden="true"></i></button></a>
                                            
                                                <a href="#edit<?php echo $cId;?>" data-toggle="modal" class="pull-right"><button type="button" class='btn btn-info btn-sm btn-fill'> <i class='ti-pencil' aria-hidden="true"></i></button></a>
                                               
                                        </div>
                                        <!-- modal for delete  -->
                                        <div id="delete<?php echo $cId;?>" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="false">
                                            <form action="cat.php" method="post">
                                                <div class="modal-dialog" >
                                                    <div class="modal-content">
                                                        <div class="modal-header ">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Delete Category</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Do really want to delete</strong> <em>Skill Category <?php echo $numC; ?>: <?php echo $txtC; ?> </em> ?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="row">
                                                                <div class="col-sm-1">
                                                                    <input type="hidden" name="delId" value=<?php echo $cId;?>>
                                                                    <button type="submit" name="del" class="btn btn-danger btn-fill" >Yes</button>    
                                                                </div>
                                                                <div class="col-sm-11">
                                                                    <button type="button" class="btn btn-warning  btn-fill" data-dismiss="modal">No</button>   
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div> 
                                            </form>
                                        </div>
                        
                                <div class='clearfix'></div>       
                        <?php          
                                        $querySub = "SELECT txtSub, idSub, subCatNum FROM subcategory WHERE idCat='$cId'";
                                        if($resultSub=mysqli_query($db, $querySub)){
                                            if($rowSub=mysqli_num_rows($resultSub) > 0){
                                                echo "<div class='panel-body'>";
                                                while($rowSub=mysqli_fetch_assoc($resultSub)){
                                                    $txtS = $rowSub['txtSub'];
                                                    $numS = $rowSub['subCatNum'];
                                                    $sId = $rowSub['idSub'];
                                                    echo "<div class='row'><div class='col-md-8'><strong>$numS. <em>$txtS</em></strong></div></div>";
                                                    
                                                    
                                                    $queryV ="SELECT txtViolation, idViolation, intensity FROM violation WHERE idSub ='$sId' ";
                                                    
                                                    if($resultV=mysqli_query($db, $queryV)){
                                                        if($rowV=mysqli_num_rows($resultV) > 0){
                                                            
                                                            while($rowV=mysqli_fetch_assoc($resultV)){
                                                                $txtV = $rowV['txtViolation'];
                                                                $vId = $rowV['idViolation'];
                                                                $intensity =$rowV['intensity'];
                                                                echo "<div class='row'><div class='col-md-8'><sup>*</sup><strong> $txtV <em> ($intensity)</em></strong></div></div>";
                                                            }
                                                        }
                                                    }
                                                    
                                                }
                                                echo "</div>";
                                              
                                            }
                                            
                                           
                                        }
                                        
                                    }
                                    echo "</div>";   
                                    
                                    echo "<br>";
                                }else{
                                    
                                    echo "<center><div class='row'><h4>There are No Category Stored in the Database</h4></div>  <div class='row'><img src='../image/crying.png' alt='crying image' style='height:30%; width:30%;'></div> </center>";
                                                       
                                    
                                                        
                                }
                                
                            }
                                   
                       
                        ?>
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
    
	
	
   
	

</html>
