<?php
include "../helpers/dbConnection.php";
include "../helpers/functions.php";
include "../helpers/checkAdminLogin.php";
$sql="select * from class";
$classObj=DoQuery($sql);

print_r($_SESSION['userData']);
#server side code....
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $title=Clean($_POST['title']);
    $content=Clean($_POST['content']);
    $classId=Clean($_POST['classId']);
    $id=$_SESSION['userData']['AdminId'];


    #errors...
    $errors=[];

    #validate name
    if(!Validate($title,'required'))
    {
        $errors['title']="please enter a title";
    }
    if(!Validate($title,'char'))
    {
        $errors['title']="please enter letters only";
    }

    if(!Validate($content,'max',60))
    {
        $errors['content']="the content must be less than 30 characters";
    }
    if (!Validate($_FILES['image']['name'], 'required')) {
        $errors['Image'] = "Field Required";
      } elseif (!Validate($_FILES['image']['type'], 'image')) {
        $errors['Image'] = "Invalid Extension";
      }
    #checking the errors
    if(count($errors)>0)
    {
        $_SESSION['Message'] = $errors;
    }

    else
    {
        $imageName = Upload($_FILES);

    if ($imageName == false) {

      $message = ["Error" => "Error Uploading File"];
    }
    else
    {
        #saving the data in the database

        $sql="insert into subject (title,content,AdminId,ClassId,Image) values('$title','$content',$id,$classId,'$imageName')";
        $op=DoQuery($sql);
        if($op)
        {
            $message = ['success' => 'Subject Added Successfully'];
            header('location:index.php');
        }
        else
        {
            $error=['error'=>'error in adding admin'];
        }
        $_SESSION['Message'] = $message;
    }
    }
}

require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>

<main>
    <main class="container-fluid">
        <h1 class="mt-4">Dashboard / subjects</h1>
        <ol class="breadcrumb mb-4">
           
          <?php 
              Message('subject/Create');
          ?>

        </ol>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="title" placeholder="Enter title">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Content</label>
                <input type="text" class="form-control" required id="exampleInputEmail" aria-describedby="emailHelp" name="content" placeholder="Enter content">
            </div>

            <div class="form-group">
        <label for="exampleInputPassword">Class</label>
        <select class="form-control" required name="classId">

          <?php
          while ($data = mysqli_fetch_assoc($classObj)) {
          ?>

            <option value="<?php echo $data['ClassId']; ?>"><?php echo $data['ClassName']; ?></option>

          <?php } ?>

        </select>
      </div>
      
      <div class="form-group">
        <label for="exampleInputPassword">Image</label>
        <input type="file" name="image">
      </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</main>
<?php
require '../layouts/footer.php';
?>