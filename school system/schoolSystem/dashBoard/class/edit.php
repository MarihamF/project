<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkAdminLogin.php';
# Fetch Raw Data . . . 
$id = $_GET['id'];
$sql = "select * from class where ClassId = $id";
$op  = DoQuery($sql);
$data = mysqli_fetch_assoc($op);



// Logic . . .

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = Clean($_POST['name']);
    $number = Clean($_POST['Number']);

    # Validate Input . . . 
    $errors = [];

    if(!Validate($name,'required'))
    {
        $errors['name']="please enter a name";
    }
    if(!Validate($name,'char'))
    {
        $errors['name']="please enter letters only";
    }

    if(!Validate($c,'max',30))
    {
        $errors['content']="the content must be less than 30 characters";
    }
    if(!Validate($number,'maxNum',30))
    {
        $errors['number']="the number of the students in the class must be less than 30 students";
    }

    # Check if there are any errors . . .
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } 
    else {
        // code . . . 

        $sql = "update class set ClassName='$name', StudentsNo='$number' where ClassId = $id";
        $op  = DoQuery($sql);

        if ($op) {
            $message = ['success' => 'class Updated Successfully'];
            $_SESSION['Message'] = $message;
            header("Location: index.php");
             exit(); // stop the script

        } else {
            $message = ['error' => 'Error Updating class  , Try Again '];
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
            Message('class/Edit');
            ?>

        </ol>



        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) .'?id='.$data['ClassId']; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">the name of the class</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="name" value="<?php echo $data['ClassName']; ?>" placeholder="Enter the class name">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail">the number of the students</label>
                <input type="text" class="form-control" required id="exampleInputEmail" aria-describedby="emailHelp" value="<?php echo $data['StudentsNo']; ?>" name="Number" placeholder="Enter the number of the students ">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>


</main>


<?php
require '../layouts/footer.php';
?>