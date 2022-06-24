<?php
include "../helpers/dbConnection.php";
include "../helpers/functions.php";
include "../helpers/checkAdminLogin.php";

#server side code....
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $name=Clean($_POST['name']);
    $number=Clean($_POST['number']);
    $id=$_SESSION['userData']['AdminId'];


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

    if(!Validate($number,'maxNum',30))
    {
        $errors['number']="the number of the students in the class must be less than 30 students";
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
        $sql="insert into class (ClassName,StudentsNo,AdminId) values('$name','$number',$id)";
        $op=DoQuery($sql);
        if($op)
        {
            $message = ['success' => 'class Added Successfully'];
            header('location:index.php');
        }
        else
        {
            $error=['error'=>'error in adding class'];
        }
        $_SESSION['Message'] = $message;
    }

}

require '../layouts/header.php';
//require '../layouts/nav.php';
//require '../layouts/sidNav.php';
?>

<main>
    <main class="container-fluid">
        <h1 class="mt-4">Dashboard / subjects</h1>
        <ol class="breadcrumb mb-4">
           
          <?php 
              Message('class/Create');
          ?>

        </ol>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">name of the class</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="name" placeholder="Enter the name of the class">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">number of the students</label>
                <input type="number" class="form-control" required id="exampleInputEmail" aria-describedby="emailHelp" name="number" placeholder="Enter the number of the students">
            </div>

            

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</main>
<?php
require '../layouts/footer.php';
?>