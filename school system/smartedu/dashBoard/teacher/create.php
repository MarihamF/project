<?php
include "../helpers/dbConnection.php";
include "../helpers/functions.php";
include "../helpers/checkAdminLogin.php";
$sql="select * from subject";
$subjectObj=DoQuery($sql);

#server side code....
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $name=Clean($_POST['name']);
    $email=Clean($_POST['email']);
    $password=Clean($_POST['password']);
    $phone=Clean($_POST['phone']);
    $id=$_SESSION['userData']['AdminId'];
    $subjectId=Clean($_POST['subjectId']);
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
    if(!Validate($phone,'phone'))
    {
        $errors['phone']="the phone format is wrong";
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
    else{
        #saving the data in the database
        $password=md5($password);
        $sql="insert into teacher (Name,Email,Password,Phone,AdminId,SubjectId,Image) values('$name','$email','$password','$phone',$id,$subjectId,'$imageName')";
        $op=DoQuery($sql);
        if($op)
        {
            $message = ['success' => 'teacher Added Successfully'];
            header('location:index.php');
        }
        else
        {
            $error=['error'=>'error in adding teacher'];
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
        <h1 class="mt-4">Dashboard / teacher</h1>
        <ol class="breadcrumb mb-4">
           
          <?php 
              Message('teacher/Create');
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
            <div class="form-group">
                <label for="exampleInputPhone">Phone</label>
                <input type="text" class="form-control" required id="exampleInputPhone" name="phone" placeholder="enter a Phone">
            </div>
            <div class="form-group">
        <label for="exampleInputPassword">subject</label>
        <select class="form-control" required name="subjectId">

          <?php
          while ($data = mysqli_fetch_assoc($subjectObj)) {
          ?>

            <option value="<?php echo $data['SubjectId']; ?>"><?php echo $data['Title']; ?></option>

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