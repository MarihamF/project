<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
################################################################################################################
# Fetch Raw Data . . . 
$id = $_GET['id'];
$sql = "select * from admin where AdminId = $id ";
$op  = DoQuery($sql);
$data = mysqli_fetch_assoc($op);
################################################################################################################


// Logic . . .

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = Clean($_POST['name']);
    $email = Clean($_POST['email']);
    $password = Clean($_POST['password']);
    # Validate Input . . . 
    $errors = [];

    if (!Validate($name, 'required')) {
        $errors['name'] = "Field Required";
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




    # Check if there are any errors . . .
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } 
    else {
        // code . . . 

        $sql = "update admin set name = '$name', email='$email', password='$password'  WHERE AdminId = $id";
        $op  = DoQuery($sql);

        if ($op) {
            $message = ['success' => 'Role Updated Successfully'];
            $_SESSION['Message'] = $message;
            header("Location: index.php");
             exit(); // stop the script

        } else {
            $message = ['error' => 'Error Updating Role  , Try Again '];
            $_SESSION['Message'] = $message;
        }
    }
}



################################################################################################################


require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard / admin</h1>
        <ol class="breadcrumb mb-4">

            <?php
            Message('admin/Edit');
            ?>

        </ol>



        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) .'?id='.$data['AdminId']; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">name</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="name" value="<?php echo $data['Name']; ?>" placeholder="Enter name">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="text" class="form-control" required id="exampleInputEmail" aria-describedby="emailHelp" value="<?php echo $data['Email']; ?>" name="email" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Password</label>
                <input type="password" class="form-control" required id="exampleInputPassword" name="password" value="<?php echo $data['Password']; ?>" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


</main>


<?php
require '../layouts/footer.php';
?>