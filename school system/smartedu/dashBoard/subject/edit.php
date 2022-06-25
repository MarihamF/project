<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkAdminLogin.php';
# Fetch Raw Data . . . 
$id = $_GET['id'];
$sql = "select * from subject where SubjectId = $id ";
$op  = DoQuery($sql);
$data = mysqli_fetch_assoc($op);
################################################################################################################


// Logic . . .

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = Clean($_POST['title']);
    $content = Clean($_POST['content']);

    # Validate Input . . . 
    $errors = [];

    if(!Validate($title,'required'))
    {
        $errors['title']="please enter a title";
    }
    if(!Validate($title,'char'))
    {
        $errors['title']="please enter letters only";
    }

    if(!Validate($content,'max',30))
    {
        $errors['content']="the content must be less than 30 characters";
    }



    # Check if there are any errors . . .
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } 
    else {
        // code . . . 
        if (Validate($_FILES['image']['name'], 'required')) {
            # Upload File . . . 
            $imageName = Upload($_FILES);
        } else {
            $imageName = $data['image'];
        }

        $sql = "update subject set title = '$title', content='$content',image='$imageName'  WHERE SubjectId = $id";
        $op  = DoQuery($sql);

        if ($op) {
            $message = ['success' => 'subject Updated Successfully'];
            $_SESSION['Message'] = $message;
            header("Location: index.php");
             exit(); // stop the script

        } else {
            $message = ['error' => 'Error Updating subject  , Try Again '];
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
            Message('subject/Edit');
            ?>

        </ol>



        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) .'?id='.$data['AdminId']; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">title</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="title" value="<?php echo $data['Title']; ?>" placeholder="Enter name">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail">content</label>
                <input type="text" class="form-control" required id="exampleInputEmail" aria-describedby="emailHelp" value="<?php echo $data['Content']; ?>" name="content" placeholder="Enter content">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" name="image">
            </div>
            <p>
                <img src="uploads/<?php echo $data['Image']; ?>" alt="" height="250px" width="250px">
            </p>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>


</main>


<?php
require '../layouts/footer.php';
?>