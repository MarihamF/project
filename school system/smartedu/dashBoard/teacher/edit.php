<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
if(!isset($_SESSION['userData']))
{
    header("location:/group14/schoolSystem/dashBoard/adminLogIn.php");
    exit;
}
################################################################################################################
# Fetch Raw Data . . . 
$id = $_GET['id'];
$sql = "select * from teacher where TeacherId = $id ";
$op  = DoQuery($sql);
$data = mysqli_fetch_assoc($op);
################################################################################################################


// Logic . . .

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = Clean($_POST['name']);
    $email = Clean($_POST['email']);
    $phone = Clean($_POST['phone']);
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


    if(!Validate($phone,'phone'))
    {
        $errors['phone']="the phone format is wrong";
    }
    if (Validate($_FILES['image']['name'], 'required')) {
        $errors['Image'] = "Field Required";
      if (!Validate($_FILES['image']['type'], 'image')) {
        $errors['Image'] = "Invalid Extension";
      }
    }

    # Check if there are any errors . . .
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } 
    else {
        // co
        if (Validate($_FILES['image']['name'], 'required')) {
            # Upload File . . . 
            $imageName = Upload($_FILES);
        } 
        else 
        {
            $imageName = $data['Image'];
        }
    
        $sql = "update teacher set Name = '$name', Email='$email', Password='$password',Image='$imageName', Phone='$phone' WHERE TeacherId = $id";
        $op  = DoQuery($sql);

        if ($op) {
            $message = ['success' => 'teacher Updated Successfully'];
            $_SESSION['Message'] = $message;
            header("Location: index.php");
             exit(); // stop the script

        } else {
            $message = ['error' => 'Error Updating teacher , Try Again '];
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
        <h1 class="mt-4">Dashboard /teacher</h1>
        <ol class="breadcrumb mb-4">

            <?php
            Message('parent/Edit');
            ?>

        </ol>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) .'?id='.$data['TeacherId']; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">name</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="name" value="<?php echo $data['Name']; ?>" placeholder="Enter name">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="text" class="form-control" required id="exampleInputEmail" aria-describedby="emailHelp" value="<?php echo $data['Email']; ?>" name="email" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputPhone">Phone</label>
                <input type="text" class="form-control" required id="exampleInputPhone" value="<?php echo $data['Phone']; ?>" name="phone" placeholder="enter a Phone">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" name="image">
            </div>
            <p>
                <img src="uploads/<?php echo $data['Image']; ?>" alt="" height="250px" width="250px">
            </p>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


</main>


<?php
require '../layouts/footer.php';
?>