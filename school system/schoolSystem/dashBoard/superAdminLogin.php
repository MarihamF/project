<?php
require './helpers/dbConnection.php';
require './helpers/functions.php';

/*$password=md5('Ammar_85');

$sql="insert into superadmin (Name,Email,Password) values('ammar','ammar@gmail.com','$password')";
$op=DoQuery($sql);
if($op)
        {
            $message = ['success' => 'Added Successfully'];
      
        }
        else
        {
            $error=['error'=>'error in adding teacher'];
        }*/
# Server Side Code . . . 
if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $password = Clean($_POST['password']);
    $email    = Clean($_POST['email']);


    # Validate ...... 
    $errors = [];



    # validate email 
    if (!Validate($email,'required')) {
        $errors['email'] = "Field Required";
    }
     if (!Validate($email,'email'))
    {
        $errors['email'] = "Invalid Email";
    }


    # validate password 
    if (!Validate($password,'required')) 
    {
        $errors['password'] = "Field Required";
    } 
    if (!Validate($password,'min')) {
        $errors['password'] = "Length Must be >= 6 chars";
    }



    # Check ...... 
    if (count($errors) > 0) {
        // print errors .... 
        $_SESSION['Message'] = $errors;
    } else {

        // Login  cODE . . .
        $password=md5($password); 

        $sql = "select * from superadmin where Email = '$email' and  Password = '$password' ";
        $op=DoQuery($sql);
   
        if (mysqli_num_rows($op) == 1) {
            // login success ....
            $row = mysqli_fetch_assoc($op);
            # Set Session . . . 
            $_SESSION['superAdminData'] = $row;
            print_r( $_SESSION['superAdminData']);
            header('Location:'.url('index.php'));
        } 
        else
         {
            $message=['* Invalid Email or Password'];
        }
        $_SESSION['Message'] = $message;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Page Title - SB Admin</title>
        <link href="<?php echo url('resources/css/styles.css')?>" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">


                                       <?php 
                                          // print Errors . . . 
                                          Message();
                                       ?>


                                        <form   action= "<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="email" placeholder="Enter email address"  name="email"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password"  name="password"/>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                       
                                                <button type="submit" class="btn btn-primary" >Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <!-- <div class="small"><a href="register.html">Need an account? Sign up!</a></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="./resources/js/scripts.js"></script>
    </body>
</html>
