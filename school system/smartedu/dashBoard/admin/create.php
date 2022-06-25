<?php
include "../helpers/dbConnection.php";
include "../helpers/functions.php";



#server side code....
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $name=Clean($_POST['name']);
    $email=Clean($_POST['email']);
    $password=Clean($_POST['password']);


    #errors...
    $errors=[];

    #validate name
    if(!Validate($name,'required'))
    {
        $errors['name']="please enter a name";
    }
    if(!Validate($name,'char'))
    {
        $errors['name']="please enter letters only";
    }

    #validate email
    if(!Validate($email,'required'))
    {
        $errors['email']="please enter an email";
    }
    if(!validate($email,'email')) {
        $errors['email'] = "Invalid Email";
    }
    #validate password
    if(!Validate($password,'required'))
    {
        $errors['password']="please enter a password";
    }
    if(!Validate($password,'max',10))
    {
        $errors['password']="length of the password must be less than 10 characters";
    }

    #checking the errors
    if(count($errors)>0)
    {
        $_SESSION['Message'] = $errors;
    }

    else
    {
        #saving the data in the database
        $password=md5($password);
        $sql="insert into admin (name,email,password) values('$name','$email','$password')";
        $op=DoQuery($sql);
        if($op)
        {
            $message = ['success' => 'admin Added Successfully'];
        }
        else
        {
            $error=['error'=>'error in adding admin'];
        }
        $_SESSION['Message'] = $message;
    }

}

require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>

<main>
    <main class="container-fluid">
        <h1 class="mt-4">Dashboard / admins</h1>
        <ol class="breadcrumb mb-4">
           
          <?php 
              Message('admin/Create');
          ?>

        </ol>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="name" placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="text" class="form-control" required id="exampleInputEmail" aria-describedby="emailHelp" name="email" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Password</label>
                <input type="password" class="form-control" required id="exampleInputPassword" name="password" placeholder="Password">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</main>
<?php
require '../layouts/footer.php';
?>