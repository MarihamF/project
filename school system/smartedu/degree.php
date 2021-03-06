<?php
require './dashBoard/helpers/functions.php';
require './dashBoard/helpers/dbConnection.php';

$sql = "select * from degree";
$op  = DoQuery($sql);
$degreeData=mysqli_fetch_assoc($op);
/* the name of the student */
$studentId=$degreeData['StudentId'];
$sql1="select Name from student where StudentId=$studentId";
$op1=DoQuery($sql1);
$studentName=mysqli_fetch_assoc($op1);
/* the name of the subject */
$subjectId=$degreeData['SubjectId'];
$sql2="select title from subject where SubjectId=$subjectId";
$op2=DoQuery($sql2);
$subjectName=mysqli_fetch_assoc($op2);
/* the name of the teacher */
$teacherId=$degreeData['TeacherId'];
$sql3="select Name from teacher where TeacherId=teacherId";
$op3=DoQuery($sql3);
$teacherName=mysqli_fetch_assoc($op3);
/* the name of the parent */
$parentId=$degreeData['ParentId'];
$sql4="select Name from parent where ParentId=parentId";
$op4=DoQuery($sql4);
$parentName=mysqli_fetch_assoc($op4);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>SmartEDU - Education</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="resources/images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="resources/images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="resources/style.css">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="resources/css/versions.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="resources/css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="resources/css/custom.css">

    <!-- Modernizer for Portfolio -->
    <script src="resources/js/modernizer.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="host_version">
	<!-- Modal -->
	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header tit-up">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Customer Login</h4>
              </div>
              <div class="modal-body customer-box">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs">
                      <li><a class="active" href="#Login" data-toggle="tab">Login</a></li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                      <div class="tab-pane active" id="Login">
                          <form role="form" class="form-horizontal">
                              <div class="form-group">
                                  <div class="col-sm-12">
                                      <input class="form-control" id="exampleInputPassword1" placeholder="Email" type="email">
                                  </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-12">
                                    <input class="form-control" id="email1" placeholder="password" type="text">
                                </div>
                            </div>
                              <div class="row">
                                  <div class="col-sm-10">
                                      <button type="submit" class="btn btn-light btn-radius btn-brd grd1">
                                          Submit
                                      </button>
                                      <a class="for-pwd" href="javascript:;">Forgot your password?</a>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
     <!-- LOADER -->
	<div id="preloader">
		<div class="loader-container">
			<div class="progress-br float shadow">
				<div class="progress__item"></div>
			</div>
		</div>
	</div>
	<!-- END LOADER -->	
    <!-- Start header -->
    <header class="top-navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="resources/images/logo.png" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbars-host">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item active"><a class="nav-link" href="about.php">About Us</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">subject</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-a">
                            <a class="dropdown-item" href="course-grid-2.php">primary one</a>
                            <a class="dropdown-item" href="course-grid-3.php">primary two</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">Blog </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-a">
                            <a class="dropdown-item" href="blog.php">Blog </a>
                            <a class="dropdown-item" href="blog-single.php">Blog single </a>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="teachers.php">Teachers</a></li>
                    <li class="nav-item"><a class="nav-link" href="degree.php">degree</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="hover-btn-new log mr-2" href="#" data-toggle="modal" data-target="#login"><span>parent</span></a></li>
                    <li><a class="hover-btn-new log" href="#" data-toggle="modal" data-target="#login"><span>student</span></a></li>
                </ul>
            </div>
        </div>
    </nav>
    </header>
    <!-- End header -->
    <div class="all-title-box">
		<div class="container text-center">
			<h1>degree<span class="m_1">Lorem Ipsum dolroin gravida nibh vel velit.</span></h1>
		</div>
	</div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>name of the student</th>
                            <th>name of the subject</th>
                            <th>degree</th>
                            <th>name of the teacher</th>
                            <th>name of the parent</th>
                        </tr>    
                    </thead>
                    <tfoot>
                    <tr>
                            <th>#</th>
                            <th>name of the student</th>
                            <th>name of the subject</th>
                            <th>degree</th>
                            <th>name of the teacher</th>
                            <th>name of the parent</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>

            </div>
        </div>
    </div>
    <tbody>
    <?php while($data=mysqli_fetch_assoc($op)) {?>
        <tr>
            <td><?php echo $data['DegreeId']?></td>
            <td><?php echo $studentName['Name'] ?></td>
            <td><?php echo $subjectName['title'] ?></td>
            <td><?php echo $data['degree'] ?></td>
            <td><?php echo $teacherName['Name'] ?></td>
           <td><?php echo $parentName['Name'] ?></td> 
           <td> <a href='edit.php?id=<?php echo $data['DegreeId'];?>' class='btn btn-primary m-r-1em'>Edit</a> </td>
            <td> <a href='delete.php?id=<?php echo $data['DegreeId'];?>' class='btn btn-danger m-r-1em'>Delete</a> </td> 
        </tr>
<?php }?>

</tbody>

</table>



    <div class="parallax section dbcolor">
        <div class="container">
            <div class="row logos">
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="resources/images/logo_01.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="resources/images/logo_02.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="resources/images/logo_03.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="resources/images/logo_04.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="resources/images/logo_05.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="resources/images/logo_06.png" alt="" class="img-repsonsive"></a>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end section -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>About US</h3>
                        </div>
                        <p> Integer rutrum ligula eu dignissim laoreet. Pellentesque venenatis nibh sed tellus faucibus bibendum. Sed fermentum est vitae rhoncus molestie. Cum sociis natoque penatibus et magnis dis montes.</p>
                        <div class="footer-right">
							<ul class="footer-links-soi">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-github"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
							</ul>
                            <!-- end links -->
						</div>
                    </div>
                    <!-- end clearfix -->
                </div>
                <!-- end col -->

				<div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Information Link</h3>
                        </div>
                        <ul class="footer-links">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Pricing</a></li>
							<li><a href="#">About</a></li>
							<li><a href="#">Contact</a></li>
                        </ul>
                        <!-- end links -->
                    </div>
                    <!-- end clearfix -->
                </div>
                <!-- end col -->
				
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Contact Details</h3>
                        </div>

                        <ul class="footer-links">
                            <li><a href="mailto:#">info@yoursite.com</a></li>
                            <li><a href="#">www.yoursite.com</a></li>
                            <li>PO Box 16122 Collins Street West Victoria 8007 Australia</li>
                            <li>+61 3 8376 6284</li>
                        </ul>
                        <!-- end links -->
                    </div>
                    <!-- end clearfix -->
                </div>
                <!-- end col -->
				
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </footer>
    <!-- end footer -->
    <div class="copyrights">
        <div class="container">
            <div class="footer-distributed">
                <div class="footer-center">                   
                    <p class="footer-company-name">All Rights Reserved. &copy; 2018 <a href="#">SmartEDU</a> Design By :Mariham & Salma</p>
                </div>
            </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end copyrights -->

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    <script src="js/all.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/custom.js"></script>

</body>
</html>